<?php

namespace App\Libraries;

use App\Models\InstagramModel;

class InstagramSyncService
{
    /**
     * Jumlah posting Instagram yang dipertahankan di database.
     * Posting lama tetap ada di akun Instagram, hanya tidak disimpan di DB.
     */
    private const MAX_POSTS = 20;

    /**
     * Batas waktu request ke Instagram API.
     */
    private const API_CONNECT_TIMEOUT = 5;
    private const API_TIMEOUT = 20;

    /**
     * Batas waktu download thumbnail.
     * Thumbnail di-download secara paralel agar 20 posting tidak
     * menunggu 20 request secara berurutan.
     */
    private const IMAGE_CONNECT_TIMEOUT = 5;
    private const IMAGE_TIMEOUT = 10;

    public function sync(): array
    {
        if (function_exists('set_time_limit')) {
            @set_time_limit(0);
        }

        $token = env('INSTAGRAM_ACCESS_TOKEN');
        $userId = env('INSTAGRAM_USER_ID');

        if (!$token || !$userId) {
            return [
                'status' => false,
                'message' => 'Instagram Access Token atau User ID belum tersedia.',
            ];
        }

        $fields = implode(',', [
            'id',
            'caption',
            'media_type',
            'media_url',
            'thumbnail_url',
            'permalink',
            'timestamp',
            'children{media_type,media_url,thumbnail_url}',
        ]);

        $nextUrl = 'https://graph.instagram.com/v23.0/me/media?fields='
            . urlencode($fields)
            . '&limit=' . self::MAX_POSTS
            . '&access_token=' . urlencode($token);

        $model = new InstagramModel();
        $jumlahBaru = 0;
        $jumlahUpdate = 0;
        $totalDiproses = 0;
        $halaman = 0;
        $retainedIds = [];
        $postsToProcess = [];

        while ($nextUrl && count($postsToProcess) < self::MAX_POSTS) {
            $halaman++;

            $responseData = $this->requestJson($nextUrl);

            if (!$responseData['success']) {
                return [
                    'status' => false,
                    'message' => $responseData['message'],
                    'error' => $responseData['error'] ?? null,
                    'halaman_terakhir' => $halaman,
                ];
            }

            $result = $responseData['data'];

            foreach ($result['data'] ?? [] as $post) {
                $instagramId = (string) ($post['id'] ?? '');

                if ($instagramId === '' || isset($retainedIds[$instagramId])) {
                    continue;
                }

                $retainedIds[$instagramId] = true;
                $postsToProcess[] = $post;

                if (count($postsToProcess) >= self::MAX_POSTS) {
                    break;
                }
            }

            if (count($postsToProcess) >= self::MAX_POSTS) {
                break;
            }

            $nextUrl = $result['paging']['next'] ?? null;
        }

        if ($postsToProcess === []) {
            return [
                'status' => true,
                'message' => 'Sinkronisasi selesai. Tidak ada posting Instagram yang ditemukan.',
                'posting_baru' => 0,
                'posting_update' => 0,
                'posting_dihapus' => 0,
                'total_diproses' => 0,
                'halaman_diproses' => $halaman,
                'batas_postingan' => false,
            ];
        }

        $preparedPosts = [];
        $thumbnailJobs = [];

        foreach ($postsToProcess as $post) {
            $instagramId = (string) ($post['id'] ?? '');

            $existing = $model
                ->where('instagram_id', $instagramId)
                ->first();

            $caption = (string) ($post['caption'] ?? '');
            $judul = trim((string) preg_replace('/\s+/', ' ', $caption));

            if ($judul === '') {
                $judul = 'Posting Instagram';
            } elseif (strlen($judul) > 255) {
                $judul = substr($judul, 0, 252) . '...';
            }

            $postedAt = null;
            $tanggalPost = null;

            if (!empty($post['timestamp'])) {
                try {
                    $date = new \DateTime($post['timestamp']);
                    $postedAt = $date->format('Y-m-d H:i:s');
                    $tanggalPost = $date->format('Y-m-d');
                } catch (\Exception $exception) {
                    $postedAt = null;
                    $tanggalPost = null;
                }
            }

            $preparedPosts[$instagramId] = [
                'existing' => $existing,
                'data' => [
                    'judul' => $judul,
                    'thumbnail' => $existing['thumbnail'] ?? null,
                    'instagram_url' => $post['permalink'] ?? null,
                    'tanggal_post' => $tanggalPost,
                    'caption' => $caption,
                    'instagram_id' => $instagramId,
                    'media_url' => $post['media_url'] ?? null,
                    'thumbnail_url' => $post['thumbnail_url'] ?? null,
                    'permalink' => $post['permalink'] ?? null,
                    'media_type' => $post['media_type'] ?? 'IMAGE',
                    'posted_at' => $postedAt,
                ],
            ];

            $existingThumbnail = $existing['thumbnail'] ?? null;
            $existingPath = $existingThumbnail
                ? FCPATH . 'uploads/instagram/' . basename($existingThumbnail)
                : null;

            if ($existingPath && is_file($existingPath) && filesize($existingPath) > 0) {
                continue;
            }

            $thumbnailUrl = $this->getThumbnailUrl($post);

            if ($thumbnailUrl) {
                $thumbnailJobs[$instagramId] = $thumbnailUrl;
            }
        }

        $downloadedThumbnails = $this->downloadThumbnailsParallel($thumbnailJobs);

        foreach ($preparedPosts as $instagramId => &$prepared) {
            if (isset($downloadedThumbnails[$instagramId])) {
                $prepared['data']['thumbnail'] = $downloadedThumbnails[$instagramId];
            }
        }
        unset($prepared);

        foreach ($preparedPosts as $prepared) {
            $existing = $prepared['existing'];
            $data = $prepared['data'];

            if ($existing) {
                if ($this->hasChanges($existing, $data)) {
                    $model->update($existing['id'], $data);
                }

                $jumlahUpdate++;
            } else {
                $model->insert($data);
                $jumlahBaru++;
            }

            $totalDiproses++;
        }

        $retainedInstagramIds = array_keys($retainedIds);

        $staleQuery = $model->where('instagram_id IS NOT NULL', null, false)
            ->whereNotIn('instagram_id', $retainedInstagramIds);

        $stalePosts = $staleQuery->findAll();
        $jumlahDihapus = 0;

        if ($stalePosts !== []) {
            $staleIds = array_column($stalePosts, 'id');

            $deleted = db_connect()
                ->table('instagram_posts')
                ->whereIn('id', $staleIds)
                ->delete();

            if ($deleted) {
                $jumlahDihapus = count($staleIds);

                foreach ($stalePosts as $stalePost) {
                    $thumbnail = $stalePost['thumbnail'] ?? null;

                    if ($thumbnail) {
                        $thumbnailPath = FCPATH . 'uploads/instagram/' . basename($thumbnail);

                        if (is_file($thumbnailPath)) {
                            @unlink($thumbnailPath);
                        }
                    }
                }
            }
        }

        return [
            'status' => true,
            'message' => 'Sinkronisasi Instagram berhasil.',
            'posting_baru' => $jumlahBaru,
            'posting_update' => $jumlahUpdate,
            'posting_dihapus' => $jumlahDihapus,
            'total_diproses' => $totalDiproses,
            'halaman_diproses' => $halaman,
            'batas_postingan' => count($retainedInstagramIds) >= self::MAX_POSTS,
        ];
    }

    /**
     * Request JSON ke Instagram Graph API.
     */
    private function requestJson(string $url): array
    {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => self::API_CONNECT_TIMEOUT,
            CURLOPT_TIMEOUT => self::API_TIMEOUT,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_HTTPHEADER => ['Accept: application/json'],
        ]);

        $response = curl_exec($ch);
        $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);

        curl_close($ch);

        if ($response === false) {
            return [
                'success' => false,
                'message' => 'Gagal menghubungi Instagram API.',
                'error' => $curlError,
            ];
        }

        $result = json_decode($response, true);

        if ($httpCode !== 200) {
            return [
                'success' => false,
                'message' => 'Instagram API mengembalikan error.',
                'error' => [
                    'httpCode' => $httpCode,
                    'response' => $result,
                ],
            ];
        }

        if (!is_array($result)) {
            return [
                'success' => false,
                'message' => 'Respons Instagram API tidak valid.',
            ];
        }

        return [
            'success' => true,
            'data' => $result,
        ];
    }

    private function hasChanges(array $existing, array $data): bool
    {
        foreach ($data as $key => $value) {
            if ((string) ($existing[$key] ?? '') !== (string) ($value ?? '')) {
                return true;
            }
        }

        return false;
    }

    /**
     * Menentukan URL thumbnail berdasarkan tipe media.
     */
    private function getThumbnailUrl(array $post): ?string
    {
        $mediaType = $post['media_type'] ?? '';

        if ($mediaType === 'IMAGE') {
            return $post['media_url'] ?? null;
        }

        if ($mediaType === 'VIDEO') {
            return $post['thumbnail_url'] ?? null;
        }

        if ($mediaType === 'CAROUSEL_ALBUM') {
            $firstChild = $post['children']['data'][0] ?? [];

            return ($firstChild['media_type'] ?? '') === 'VIDEO'
                ? ($firstChild['thumbnail_url'] ?? null)
                : ($firstChild['media_url'] ?? null);
        }

        return null;
    }

    /**
     * Download banyak thumbnail secara paralel.
     *
     * @param array<string,string> $jobs [instagramId => imageUrl]
     * @return array<string,string> [instagramId => localFilename]
     */
    private function downloadThumbnailsParallel(array $jobs): array
    {
        if ($jobs === []) {
            return [];
        }

        $uploadPath = FCPATH . 'uploads/instagram/';

        if (
            !is_dir($uploadPath)
            && !mkdir($uploadPath, 0777, true)
            && !is_dir($uploadPath)
        ) {
            return [];
        }

        $multiHandle = curl_multi_init();
        $handles = [];
        $results = [];

        foreach ($jobs as $instagramId => $url) {
            $safeId = preg_replace('/[^A-Za-z0-9_-]/', '', $instagramId);
            $fileName = $safeId . '.jpg';
            $filePath = $uploadPath . $fileName;

            if (is_file($filePath) && filesize($filePath) > 0) {
                $results[$instagramId] = $fileName;
                continue;
            }

            $ch = curl_init($url);

            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_CONNECTTIMEOUT => self::IMAGE_CONNECT_TIMEOUT,
                CURLOPT_TIMEOUT => self::IMAGE_TIMEOUT,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_USERAGENT => 'Mozilla/5.0 (compatible; DinsosInstagramSync/1.0)',
                CURLOPT_HTTPHEADER => ['Accept: image/*'],
            ]);

            curl_multi_add_handle($multiHandle, $ch);

            $handles[$instagramId] = [
                'handle' => $ch,
                'fileName' => $fileName,
                'filePath' => $filePath,
            ];
        }

        if ($handles !== []) {
            $running = null;

            do {
                $status = curl_multi_exec($multiHandle, $running);

                if ($running > 0 && $status === CURLM_OK) {
                    curl_multi_select($multiHandle, 1.0);
                }
            } while ($running > 0 && $status === CURLM_OK);

            foreach ($handles as $instagramId => $job) {
                $ch = $job['handle'];

                $image = curl_multi_getcontent($ch);
                $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

                if (
                    $image !== false
                    && $image !== ''
                    && $httpCode === 200
                    && (!$contentType || strpos($contentType, 'image/') === 0)
                ) {
                    if (file_put_contents($job['filePath'], $image) !== false) {
                        $results[$instagramId] = $job['fileName'];
                    }
                }

                curl_multi_remove_handle($multiHandle, $ch);
                curl_close($ch);
            }
        }

        curl_multi_close($multiHandle);

        return $results;
    }
}