<?php

namespace App\Libraries;

use App\Models\InstagramModel;

class InstagramSyncService
{
    private const MAX_POSTS = 20;

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
        $retainedInstagramIds = [];

        while ($nextUrl && count($retainedInstagramIds) < self::MAX_POSTS) {
            $halaman++;
            $ch = curl_init();

            curl_setopt_array($ch, [
                CURLOPT_URL => $nextUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CONNECTTIMEOUT => 5,
                CURLOPT_TIMEOUT => 20,
                CURLOPT_SSL_VERIFYPEER => true,
            ]);

            $response = curl_exec($ch);
            $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlError = curl_error($ch);
            curl_close($ch);

            if ($response === false) {
                return [
                    'status' => false,
                    'message' => 'Gagal menghubungi Instagram API.',
                    'error' => $curlError,
                    'halaman_terakhir' => $halaman,
                ];
            }

            $result = json_decode($response, true);

            if ($httpCode !== 200) {
                return [
                    'status' => false,
                    'message' => 'Instagram API mengembalikan error.',
                    'httpCode' => $httpCode,
                    'halaman' => $halaman,
                    'response' => $result,
                ];
            }

            if (!is_array($result)) {
                return [
                    'status' => false,
                    'message' => 'Respons Instagram API tidak valid.',
                    'halaman' => $halaman,
                ];
            }

            foreach ($result['data'] ?? [] as $post) {
                $instagramId = (string) ($post['id'] ?? '');

                if ($instagramId === '') {
                    continue;
                }

                $existing = $model
                    ->where('instagram_id', $instagramId)
                    ->first();

                $retainedInstagramIds[] = $instagramId;

                $localThumbnail = $this->downloadThumbnail($post, $instagramId);

                if ($localThumbnail === null && $existing) {
                    $localThumbnail = $existing['thumbnail'] ?? null;
                }

                $caption = (string) ($post['caption'] ?? '');
                $judul = trim(preg_replace('/\s+/', ' ', $caption));

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

                $data = [
                    'judul' => $judul,
                    'thumbnail' => $localThumbnail,
                    'instagram_url' => $post['permalink'] ?? null,
                    'tanggal_post' => $tanggalPost,
                    'caption' => $caption,
                    'instagram_id' => $instagramId,
                    'media_url' => $post['media_url'] ?? null,
                    'thumbnail_url' => $post['thumbnail_url'] ?? null,
                    'permalink' => $post['permalink'] ?? null,
                    'media_type' => $post['media_type'] ?? 'IMAGE',
                    'posted_at' => $postedAt,
                ];

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

            if (count($retainedInstagramIds) >= self::MAX_POSTS) {
                break;
            }

            $nextUrl = $result['paging']['next'] ?? null;
        }

        $staleQuery = $model->where('instagram_id IS NOT NULL', null, false);

        if ($retainedInstagramIds !== []) {
            $staleQuery->whereNotIn('instagram_id', $retainedInstagramIds);
        }

        $stalePosts = $staleQuery->findAll();
        $staleIds = array_column($stalePosts, 'id');
        $jumlahDihapus = 0;

        if ($staleIds !== []) {
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
                            unlink($thumbnailPath);
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

    private function hasChanges(array $existing, array $data): bool
    {
        foreach ($data as $key => $value) {
            if ((string) ($existing[$key] ?? '') !== (string) ($value ?? '')) {
                return true;
            }
        }

        return false;
    }

    private function downloadThumbnail(array $post, string $instagramId): ?string
    {
        $mediaType = $post['media_type'] ?? '';
        $url = null;

        if ($mediaType === 'IMAGE') {
            $url = $post['media_url'] ?? null;
        } elseif ($mediaType === 'VIDEO') {
            $url = $post['thumbnail_url'] ?? null;
        } elseif ($mediaType === 'CAROUSEL_ALBUM') {
            $firstChild = $post['children']['data'][0] ?? [];
            $url = ($firstChild['media_type'] ?? '') === 'VIDEO'
                ? ($firstChild['thumbnail_url'] ?? null)
                : ($firstChild['media_url'] ?? null);
        }

        return $this->downloadInstagramImage($url, $instagramId);
    }

    private function downloadInstagramImage(?string $url, string $instagramId): ?string
    {
        if (empty($url)) {
            return null;
        }

        $uploadPath = FCPATH . 'uploads/instagram/';

        if (!is_dir($uploadPath) && !mkdir($uploadPath, 0777, true) && !is_dir($uploadPath)) {
            return null;
        }

        $safeId = preg_replace('/[^A-Za-z0-9_-]/', '', $instagramId);
        $fileName = $safeId . '.jpg';
        $filePath = $uploadPath . $fileName;

        if (is_file($filePath) && filesize($filePath) > 0) {
            return $fileName;
        }

        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (compatible; DinsosInstagramSync/1.0)',
            CURLOPT_HTTPHEADER => ['Accept: image/*'],
        ]);

        $image = curl_exec($ch);
        $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($image === false || $httpCode !== 200 || $image === '') {
            log_message('error', 'Gagal mengunduh thumbnail Instagram: ' . $curlError);
            return null;
        }

        if ($contentType && strpos($contentType, 'image/') !== 0) {
            log_message('error', 'Respons thumbnail Instagram bukan gambar: ' . $contentType);
            return null;
        }

        if (file_put_contents($filePath, $image) === false) {
            log_message('error', 'Gagal menyimpan thumbnail Instagram: ' . $filePath);
            return null;
        }

        return $fileName;
    }
}