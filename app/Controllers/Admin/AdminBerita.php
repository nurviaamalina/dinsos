<?php

namespace App\Controllers\Admin;



use App\Controllers\BaseController;
use App\Models\BeritaModel;


class AdminBerita extends BaseController
{
    protected $beritaModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
    }

    public function index()
    {
        $data = [

            'title' => 'Berita dan Pengumuman',

            'totalBerita' => $this->beritaModel->countAll(),

            'totalDraft' => $this->beritaModel
                ->where('status', 'draft')
                ->countAllResults(),

            'totalPublik' => $this->beritaModel
                ->where('status', 'publik')
                ->countAllResults(),

            'berita' => $this->beritaModel
                ->orderBy('id', 'DESC')
                ->paginate(5),

           'pager' => $this->beritaModel->pager,

        ];

        return view(
            'Admin/Berita/index',
            $data
        );
    }

     public function create()
    {
        return view('Admin/berita/create', [
            'title' => 'Tambah Berita'
        ]);
    }

    public function import()
{
    return view('Admin/Berita/import', [
        'title' => 'Import Data Berita Lama'
    ]);
}

public function importProcess()
{
    $excel = $this->request->getFile('excel');
    $zip   = $this->request->getFile('zip');


    // ==================================================
    // 1. VALIDASI EXCEL
    // ==================================================

    if (!$excel || !$excel->isValid()) {

        return redirect()
            ->back()
            ->with(
                'error',
                'File Excel belum dipilih atau tidak valid.'
            );
    }


    $excelExtension = strtolower(
        $excel->getClientExtension()
    );


    if (!in_array($excelExtension, ['xlsx', 'xls'])) {

        return redirect()
            ->back()
            ->with(
                'error',
                'File Excel harus XLSX atau XLS.'
            );
    }


    // ==================================================
    // 2. VALIDASI ZIP
    // ==================================================

    if (!$zip || !$zip->isValid()) {

        return redirect()
            ->back()
            ->with(
                'error',
                'File ZIP belum dipilih atau tidak valid.'
            );
    }


    if (
        strtolower($zip->getClientExtension()) !== 'zip'
    ) {

        return redirect()
            ->back()
            ->with(
                'error',
                'File gambar harus berupa ZIP.'
            );
    }


    try {

        // ==================================================
        // 3. BACA EXCEL
        // ==================================================

        $spreadsheet =
            \PhpOffice\PhpSpreadsheet\IOFactory::load(
                $excel->getTempName()
            );


        // Cari sheet BERITA
        $sheet = $spreadsheet->getSheetByName('BERITA');


        if (!$sheet) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Sheet BERITA tidak ditemukan di file Excel.'
                );
        }


        $rows = $sheet->toArray(
            null,
            true,
            true,
            true
        );


        // ==================================================
        // 4. BUKA ZIP
        // ==================================================

        $zipArchive = new \ZipArchive();


        if (
            $zipArchive->open(
                $zip->getTempName()
            ) !== true
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'File ZIP tidak dapat dibuka.'
                );
        }


        // ==================================================
        // 5. INDEX FILE DALAM ZIP
        // ==================================================

        $zipFiles = [];


        for (
            $i = 0;
            $i < $zipArchive->numFiles;
            $i++
        ) {

            $fileName =
                $zipArchive->getNameIndex($i);


            if (!$fileName) {
                continue;
            }


            $fileName =
                str_replace(
                    '\\',
                    '/',
                    $fileName
                );


            // Abaikan folder

            if (
                str_ends_with(
                    $fileName,
                    '/'
                )
            ) {

                continue;
            }


            $zipFiles[] = $fileName;
        }


        // ==================================================
        // 6. MODEL
        // ==================================================

        $beritaModel = $this->beritaModel;


        // ==================================================
        // 7. FOLDER UPLOAD
        // ==================================================

        $uploadPath =
            FCPATH . 'uploads/berita/';


        if (!is_dir($uploadPath)) {

            mkdir(
                $uploadPath,
                0777,
                true
            );
        }


        // ==================================================
        // 8. COUNTER
        // ==================================================

        $berhasil = 0;

        $dilewati = 0;

        $gagal = 0;

        $errors = [];


        // ==================================================
        // 9. PROSES SETIAP BARIS
        // ==================================================

        foreach (
            $rows as $index => $row
        ) {


            // Baris pertama = header

            if ($index == 1) {

                continue;
            }


            // ==================================================
            // AMBIL DATA
            // ==================================================

            $kode =
                trim(
                    $row['A'] ?? ''
                );


            $judul =
                trim(
                    $row['B'] ?? ''
                );


            $isi =
                trim(
                    $row['C'] ?? ''
                );


            $publikator =
                trim(
                    $row['D'] ?? ''
                );


            $tanggalRaw =
                $row['E'] ?? '';


            $namaGambar =
                trim(
                    $row['F'] ?? ''
                );


            // ==================================================
            // LEWATI BARIS KOSONG
            // ==================================================

            if (
                $kode === '' &&
                $judul === '' &&
                $isi === '' &&
                $publikator === '' &&
                $tanggalRaw === '' &&
                $namaGambar === ''
            ) {

                continue;
            }


            $rowErrors = [];


            // ==================================================
            // 10. VALIDASI DATA
            // ==================================================

            if ($judul === '') {

                $rowErrors[] =
                    'Judul berita kosong.';
            }


            if ($isi === '') {

                $rowErrors[] =
                    'Isi berita kosong.';
            }


            if ($publikator === '') {

                $rowErrors[] =
                    'Publikator kosong.';
            }


            if ($namaGambar === '') {

                $rowErrors[] =
                    'Nama gambar kosong.';
            }


            // ==================================================
            // 11. KONVERSI TANGGAL
            // ==================================================

            $tanggal = '';


            if ($tanggalRaw !== '') {

                try {

                    // Excel menyimpan tanggal sebagai angka

                    if (
                        is_numeric(
                            $tanggalRaw
                        )
                    ) {

                        $tanggalObj =
                            \PhpOffice\PhpSpreadsheet\Shared\Date
                            ::excelToDateTimeObject(
                                $tanggalRaw
                            );


                        $tanggal =
                            $tanggalObj->format(
                                'Y-m-d'
                            );

                    } else {

                        $tanggalRaw =
                            trim(
                                (string) $tanggalRaw
                            );


                        // Format Y-m-d

                        $date =
                            \DateTime::createFromFormat(
                                'Y-m-d',
                                $tanggalRaw
                            );


                        if (
                            $date &&
                            $date->format(
                                'Y-m-d'
                            ) === $tanggalRaw
                        ) {

                            $tanggal =
                                $tanggalRaw;

                        } else {

                            // Coba format tanggal lain

                            $timestamp =
                                strtotime(
                                    $tanggalRaw
                                );


                            if (
                                $timestamp !== false
                            ) {

                                $tanggal =
                                    date(
                                        'Y-m-d',
                                        $timestamp
                                    );
                            }
                        }
                    }

                } catch (\Throwable $e) {

                    $tanggal = '';
                }
            }


            if ($tanggal === '') {

                $rowErrors[] =
                    'Tanggal tidak valid.';
            }


            // ==================================================
            // 12. CARI GAMBAR DALAM ZIP
            // ==================================================

            $gambarZipPath = null;


            foreach (
                $zipFiles as $file
            ) {

                if (
                    strtolower(
                        basename($file)
                    )
                    ===
                    strtolower(
                        $namaGambar
                    )
                ) {

                    $gambarZipPath =
                        $file;

                    break;
                }
            }


            if (!$gambarZipPath) {

                $rowErrors[] =
                    'Gambar "' .
                    $namaGambar .
                    '" tidak ditemukan di ZIP.';
            }


            // ==================================================
            // 13. VALIDASI GAGAL
            // ==================================================

            if (!empty($rowErrors)) {

                $gagal++;


                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' =>
                        $rowErrors

                ];


                continue;
            }


            // ==================================================
            // 14. BUAT SLUG
            // ==================================================

            $slug =
                url_title(
                    $judul,
                    '-',
                    true
                );


            // ==================================================
            // 15. CEK DUPLIKAT SLUG
            // ==================================================

            $existing =
                $beritaModel
                    ->where(
                        'slug',
                        $slug
                    )
                    ->first();


            if ($existing) {

                $dilewati++;

                continue;
            }


            // ==================================================
            // 16. AMBIL GAMBAR
            // ==================================================

            $imageContent =
                $zipArchive->getFromName(
                    $gambarZipPath
                );


            if (
                $imageContent === false
            ) {

                $gagal++;


                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' => [
                        'Gambar tidak dapat dibaca dari ZIP.'
                    ]

                ];


                continue;
            }


            // ==================================================
            // 17. VALIDASI EXTENSION
            // ==================================================

            $extension =
                strtolower(
                    pathinfo(
                        $namaGambar,
                        PATHINFO_EXTENSION
                    )
                );


            $allowedExtensions = [

                'jpg',
                'jpeg',
                'png',
                'webp'

            ];


            if (
                !in_array(
                    $extension,
                    $allowedExtensions
                )
            ) {

                $gagal++;


                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' => [
                        'Format gambar tidak diperbolehkan.'
                    ]

                ];


                continue;
            }


            // ==================================================
            // 18. NAMA FILE BARU
            // ==================================================

            $namaFileBaru =
                uniqid(
                    'berita_',
                    true
                )
                . '.'
                . $extension;


            // ==================================================
            // 19. SIMPAN GAMBAR
            // ==================================================

            $saved =
                file_put_contents(
                    $uploadPath .
                    $namaFileBaru,
                    $imageContent
                );


            if ($saved === false) {

                $gagal++;


                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' => [
                        'Gambar gagal disimpan.'
                    ]

                ];


                continue;
            }


            // ==================================================
            // 20. INSERT DATABASE
            // ==================================================

            try {

                $inserted =
                    $beritaModel->insert([

                        'kode' =>
                            $kode,

                        'judul' =>
                            $judul,

                        'slug' =>
                            $slug,

                        'isi' =>
                            $isi,

                        'gambar' =>
                            $namaFileBaru,

                        'publikator' =>
                            $publikator,

                        'tanggal' =>
                            $tanggal,

                        'views' =>
                            0,

                        'status' =>
                            'publik'

                    ]);

            } catch (\Throwable $e) {

                // Hapus gambar jika database gagal

                if (
                    file_exists(
                        $uploadPath .
                        $namaFileBaru
                    )
                ) {

                    unlink(
                        $uploadPath .
                        $namaFileBaru
                    );
                }


                $gagal++;


                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' => [
                        'Database error: ' .
                        $e->getMessage()
                    ]

                ];


                continue;
            }


            // ==================================================
            // 21. CEK INSERT
            // ==================================================

            if (!$inserted) {

                if (
                    file_exists(
                        $uploadPath .
                        $namaFileBaru
                    )
                ) {

                    unlink(
                        $uploadPath .
                        $namaFileBaru
                    );
                }


                $gagal++;


                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' => [
                        'Data gagal disimpan ke database.'
                    ]

                ];


                continue;
            }


            // ==================================================
            // 22. BERHASIL
            // ==================================================

            $berhasil++;
        }


        // ==================================================
        // 23. TUTUP ZIP
        // ==================================================

        $zipArchive->close();


        // ==================================================
        // 24. PESAN HASIL
        // ==================================================

        $pesan =
            'Import selesai. ' .
            $berhasil .
            ' berita berhasil';


        if ($dilewati > 0) {

            $pesan .=
                ', ' .
                $dilewati .
                ' berita dilewati karena sudah ada';
        }


        if ($gagal > 0) {

            $pesan .=
                ', ' .
                $gagal .
                ' berita gagal';
        }


        $pesan .= '.';


        // ==================================================
        // 25. SIMPAN DETAIL ERROR
        // ==================================================

        if (!empty($errors)) {

            session()->setFlashdata(
                'import_errors',
                $errors
            );
        }


        // ==================================================
        // 26. KEMBALI KE INDEX
        // ==================================================

        return redirect()
            ->to(
                base_url(
                    'admin/berita'
                )
            )
            ->with(
                'success',
                $pesan
            );


    } catch (\Throwable $e) {


        if (isset($zipArchive)) {

            $zipArchive->close();
        }


        return redirect()
            ->back()
            ->with(
                'error',
                'Import gagal: ' .
                $e->getMessage()
            );
    }
}
    public function store()
{
    $data = [
        'judul'      => $this->request->getPost('judul'),
        'slug'       => $this->request->getPost('slug'),
        'isi'        => $this->request->getPost('isi'),
        'publikator' => $this->request->getPost('publikator'),
        'tanggal'    => $this->request->getPost('tanggal'),
        'status'     => $this->request->getPost('status'),
    ];

    $this->beritaModel->insert($data);

    return redirect()
        ->to(base_url('admin/berita'))
        ->with('success', 'Berita berhasil disimpan.');
}

public function edit($id)
{
    $berita = $this->beritaModel->find($id);

    if (!$berita) {

        return redirect()
            ->to(base_url('admin/berita'))
            ->with(
                'error',
                'Data berita tidak ditemukan.'
            );
    }

    return view(
        'Admin/Berita/edit',
        [
            'title'  => 'Edit Berita',
            'berita' => $berita
        ]
    );
}

public function update($id)
{
    $berita = $this->beritaModel->find($id);

    if (!$berita) {

        return redirect()
            ->to(base_url('admin/berita'))
            ->with(
                'error',
                'Data berita tidak ditemukan.'
            );
    }


    $data = [

        'judul' => $this->request
            ->getPost('judul'),

        'slug' => $this->request
            ->getPost('slug'),

        'isi' => $this->request
            ->getPost('isi'),

        'publikator' => $this->request
            ->getPost('publikator'),

        'tanggal' => $this->request
            ->getPost('tanggal'),

        'status' => $this->request
            ->getPost('status'),

    ];


    // ==========================================
    // CEK GAMBAR BARU
    // ==========================================

    $gambar = $this->request
        ->getFile('gambar');


    if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {

        $namaGambar = $gambar->getRandomName();

        $gambar->move(
            FCPATH . 'uploads/berita',
            $namaGambar
        );

        $data['gambar'] = $namaGambar;
    }


    // ==========================================
    // UPDATE DATABASE
    // ==========================================

    $this->beritaModel->update(
        $id,
        $data
    );


    return redirect()
        ->to(base_url('admin/berita'))
        ->with(
            'success',
            'Berita berhasil diperbarui.'
        );
}

}