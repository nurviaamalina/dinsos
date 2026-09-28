<?php

namespace App\Controllers;

use App\Models\InstagramModel;

class InstagramSync extends BaseController
{
    public function index()
    {
        // =====================================================
        // 1. AMBIL KONFIGURASI DARI .ENV
        // =====================================================

        $token  = env('INSTAGRAM_ACCESS_TOKEN');
        $userId = env('INSTAGRAM_USER_ID');

        if (!$token || !$userId) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Instagram Access Token atau User ID belum tersedia.'
            ]);
        }


        // =====================================================
        // 2. FIELD YANG AKAN DIAMBIL
        // =====================================================

        $fields = implode(',', [
            'id',
            'caption',
            'media_type',
            'media_url',
            'thumbnail_url',
            'permalink',
            'timestamp'
        ]);


        // =====================================================
        // 3. REQUEST PERTAMA
        // =====================================================

       $nextUrl = 'https://graph.instagram.com/v23.0/me/media?fields='
         . urlencode($fields)
         . '&limit=25'
         . '&access_token='
         . urlencode($token);

        // =====================================================
        // 4. MODEL DATABASE
        // =====================================================

        $model = new InstagramModel();


        // =====================================================
        // 5. COUNTER
        // =====================================================

        $jumlahBaru   = 0;
        $jumlahUpdate = 0;
        $totalDiproses = 0;
        $halaman = 0;


        // =====================================================
        // 6. BATAS PENGAMAN
        // =====================================================

        // Maksimal 100 halaman x 25 posting = 2500 posting
        // Ini mencegah loop tidak berhenti jika API bermasalah.

        $maxPages = 100;


        // =====================================================
        // 7. LOOP PAGINATION
        // =====================================================

        while ($nextUrl && $halaman < $maxPages) {

            $halaman++;


            // =================================================
            // REQUEST KE INSTAGRAM
            // =================================================

            $ch = curl_init();

            curl_setopt_array($ch, [
                CURLOPT_URL            => $nextUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_SSL_VERIFYPEER => true,
            ]);

            $response = curl_exec($ch);

            $httpCode = curl_getinfo(
                $ch,
                CURLINFO_HTTP_CODE
            );

            $curlError = curl_error($ch);

            curl_close($ch);


            // =================================================
            // CEK CURL
            // =================================================

            if ($response === false) {

                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Gagal menghubungi Instagram API.',
                    'error' => $curlError,
                    'halaman_terakhir' => $halaman
                ]);
            }


            // =================================================
            // DECODE JSON
            // =================================================

            $result = json_decode(
                $response,
                true
            );


            // =================================================
            // CEK HTTP
            // =================================================

            if ($httpCode !== 200) {

                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Instagram API mengembalikan error.',
                    'httpCode' => $httpCode,
                    'halaman' => $halaman,

                    // Jangan tampilkan URL karena bisa mengandung token
                    'response' => $result
                ]);
            }


            // =================================================
            // 8. PROSES POSTING
            // =================================================

            foreach ($result['data'] ?? [] as $post) {

                $instagramId = $post['id'] ?? null;

               // ======================================
// DOWNLOAD THUMBNAIL KE SERVER LOKAL
// IMAGE / VIDEO / CAROUSEL
// ======================================

$localThumbnail = null;

$mediaType = $post['media_type'] ?? '';

// --------------------------------------
// IMAGE
// --------------------------------------

if ($mediaType === 'IMAGE') {

    if (!empty($post['media_url'])) {

        $localThumbnail = $this->downloadInstagramImage(
            $post['media_url'],
            $instagramId
        );
    }
}

// --------------------------------------
// VIDEO / REELS
// --------------------------------------

elseif ($mediaType === 'VIDEO') {

    if (!empty($post['thumbnail_url'])) {

        $localThumbnail = $this->downloadInstagramImage(
            $post['thumbnail_url'],
            $instagramId
        );
    }
}

// --------------------------------------
// CAROUSEL
// --------------------------------------

elseif ($mediaType === 'CAROUSEL_ALBUM') {

    $children = $post['children']['data'] ?? [];

    if (!empty($children)) {

        // Gunakan media pertama sebagai thumbnail carousel
        $firstChild = $children[0];

        $childType = $firstChild['media_type'] ?? '';

        // Jika child berupa VIDEO
        if (
            $childType === 'VIDEO' &&
            !empty($firstChild['thumbnail_url'])
        ) {

            $localThumbnail = $this->downloadInstagramImage(
                $firstChild['thumbnail_url'],
                $instagramId
            );
        }

        // Jika child berupa IMAGE
        elseif (
            $childType === 'IMAGE' &&
            !empty($firstChild['media_url'])
        ) {

            $localThumbnail = $this->downloadInstagramImage(
                $firstChild['media_url'],
                $instagramId
            );
        }
    }
}

                // =============================================
                // CAPTION
                // =============================================

                $caption = $post['caption'] ?? '';


                // =============================================
                // JUDUL
                // =============================================

                if ($caption !== '') {

                    $judul = trim(
                        preg_replace(
                            '/\s+/',
                            ' ',
                            $caption
                        )
                    );

                    if (strlen($judul) > 255) {

                        $judul = substr(
                            $judul,
                            0,
                            252
                        ) . '...';
                    }

                } else {

                    $judul = 'Posting Instagram';
                }


                // =============================================
                // TANGGAL POSTING
                // =============================================

                $tanggalPost = null;
                $postedAt = null;

                if (!empty($post['timestamp'])) {

                    try {

                        $date = new \DateTime(
                            $post['timestamp']
                        );

                        $postedAt = $date->format(
                            'Y-m-d H:i:s'
                        );

                        $tanggalPost = $date->format(
                            'Y-m-d'
                        );

                    } catch (\Exception $e) {

                        $postedAt = null;
                        $tanggalPost = null;
                    }
                }


                // =============================================
                // THUMBNAIL
                // =============================================

                $thumbnail = $post['thumbnail_url']
                    ?? $post['media_url']
                    ?? null;


                // =============================================
                // DATA DATABASE
                // =============================================

                $data = [

                    'judul' =>
                        $judul,

                    'thumbnail' =>
                       $localThumbnail,

                    'instagram_url' =>
                        $post['permalink']
                        ?? null,

                    'tanggal_post' =>
                        $tanggalPost,

                    'caption' =>
                        $caption,

                    'instagram_id' =>
                        $instagramId,

                    'media_url' =>
                        $post['media_url']
                        ?? null,

                    'thumbnail_url' =>
                        $post['thumbnail_url']
                        ?? null,

                    'permalink' =>
                        $post['permalink']
                        ?? null,

                    'media_type' =>
                        $post['media_type']
                        ?? 'IMAGE',

                    'posted_at' =>
                        $postedAt,
                ];


                // =============================================
                // CEK POSTING SUDAH ADA
                // =============================================

                $existing = $model
                    ->where(
                        'instagram_id',
                        $instagramId
                    )
                    ->first();


                // =============================================
                // UPDATE
                // =============================================

                if ($existing) {

                    $model->update(
                        $existing['id'],
                        $data
                    );

                    $jumlahUpdate++;

                }


                // =============================================
                // INSERT
                // =============================================

                else {

                    $model->insert($data);

                    $jumlahBaru++;
                }


                $totalDiproses++;
            }


            // =================================================
            // 9. AMBIL PAGINATION.NEXT
            // =================================================

            $nextUrl =
                $result['paging']['next']
                ?? null;
        }


        // =====================================================
        // 10. HASIL AKHIR
        // =====================================================

        return $this->response->setJSON([

            'status' =>
                true,

            'message' =>
                'Sinkronisasi Instagram berhasil.',

            'posting_baru' =>
                $jumlahBaru,

            'posting_update' =>
                $jumlahUpdate,

            'total_diproses' =>
                $totalDiproses,

            'halaman_diproses' =>
                $halaman,

            'pagination_selesai' =>
                $nextUrl === null,

            'batas_halaman' =>
                $halaman >= $maxPages
        ]);
    }

    private function downloadInstagramImage(?string $url, string $instagramId): ?string
{
    if (empty($url)) {
        return null;
    }

    $uploadPath = FCPATH . 'uploads/instagram/';

    // Buat folder jika belum ada
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    // Bersihkan ID untuk nama file
    $safeId = preg_replace('/[^A-Za-z0-9_-]/', '', $instagramId);

    $fileName = $safeId . '.jpg';
    $filePath = $uploadPath . $fileName;

    // Kalau sudah ada, tidak perlu download ulang
    if (file_exists($filePath) && filesize($filePath) > 0) {
        return $fileName;
    }

    $ch = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => true,

        // User-Agent supaya request tidak ditolak server
        CURLOPT_USERAGENT =>
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/151.0 Safari/537.36',

        CURLOPT_HTTPHEADER => [
            'Accept: image/avif,image/webp,image/apng,image/*,*/*;q=0.8',
        ],
    ]);

    $image = curl_exec($ch);

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

    curl_close($ch);

    if (
        $image === false ||
        $httpCode !== 200 ||
        empty($image)
    ) {
        log_message(
            'error',
            'Gagal download gambar Instagram: ' . $url .
            ' HTTP: ' . $httpCode
        );

        return null;
    }

    // Pastikan response memang gambar
    if (
        $contentType &&
        strpos($contentType, 'image/') !== 0
    ) {
        log_message(
            'error',
            'Response bukan gambar Instagram. Content-Type: ' .
            $contentType
        );

        return null;
    }

    if (file_put_contents($filePath, $image) === false) {
        log_message(
            'error',
            'Gagal menyimpan gambar Instagram: ' . $filePath
        );

        return null;
    }

    return $fileName;
}
}