<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KegiatanModel;
use App\Models\FotoKegiatanModel;

class AdminKegiatan extends BaseController
{
    protected $kegiatanModel;
    protected $fotoModel;

    public function __construct()
    {
        $this->kegiatanModel = new KegiatanModel();
        $this->fotoModel = new FotoKegiatanModel();
    }


    // =====================================================
    // INDEX
    // =====================================================

    public function index()
    {
        $data = [

            'title' => 'Data Kegiatan',

            'kegiatan' => $this->kegiatanModel
                ->orderBy('tanggal', 'DESC')
                ->paginate(10),

            'pager' => $this->kegiatanModel->pager,

        ];

        return view(
            'admin/Kegiatan/index',
            $data
        );
    }


    // =====================================================
    // CREATE
    // =====================================================

    public function create()
    {
        return view(
            'admin/Kegiatan/create',
            [
                'title' => 'Tambah Kegiatan'
            ]
        );
    }

    // =====================================================
// IMPORT KEGIATAN - HALAMAN FORM
// =====================================================

public function import()
{
    return view(
        'admin/Kegiatan/import',
        [
            'title' => 'Import Data Kegiatan'
        ]
    );
}

// =====================================================
// IMPORT KEGIATAN - PROSES
// =====================================================

public function importProcess()
{
    // =================================================
    // 1. AMBIL FILE
    // =================================================

    $excel = $this->request->getFile('excel');
    $zip   = $this->request->getFile('zip');


    // =================================================
    // 2. VALIDASI EXCEL
    // =================================================

    if (!$excel || !$excel->isValid()) {

        return redirect()
            ->back()
            ->with(
                'error',
                'File Excel belum dipilih atau tidak valid.'
            );
    }


    $excelExtension =
        strtolower(
            $excel->getClientExtension()
        );


    if (!in_array(
        $excelExtension,
        ['xlsx', 'xls']
    )) {

        return redirect()
            ->back()
            ->with(
                'error',
                'File Excel harus berupa XLSX atau XLS.'
            );
    }


    // =================================================
    // 3. VALIDASI ZIP
    // =================================================

    if (!$zip || !$zip->isValid()) {

        return redirect()
            ->back()
            ->with(
                'error',
                'File ZIP belum dipilih atau tidak valid.'
            );
    }


    if (
        strtolower(
            $zip->getClientExtension()
        ) !== 'zip'
    ) {

        return redirect()
            ->back()
            ->with(
                'error',
                'File gambar harus berupa ZIP.'
            );
    }


    try {

        // =================================================
        // 4. BACA EXCEL
        // =================================================

        $spreadsheet =
            \PhpOffice\PhpSpreadsheet\IOFactory::load(
                $excel->getTempName()
            );


        $sheet =
            $spreadsheet->getActiveSheet();


        $rows =
            $sheet->toArray(
                null,
                true,
                true,
                true
            );


        // =================================================
        // 5. BUKA ZIP
        // =================================================

        $zipArchive =
            new \ZipArchive();


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


        // =================================================
        // 6. FOLDER UPLOAD
        // =================================================

        $thumbnailPath =
            FCPATH .
            'uploads/kegiatan/thumbnail/';


        $dokumentasiPath =
            FCPATH .
            'uploads/kegiatan/dokumentasi/';


        if (!is_dir($thumbnailPath)) {

            mkdir(
                $thumbnailPath,
                0777,
                true
            );
        }


        if (!is_dir($dokumentasiPath)) {

            mkdir(
                $dokumentasiPath,
                0777,
                true
            );
        }


        // =================================================
        // 7. COUNTER
        // =================================================

        $berhasil = 0;
        $dilewati = 0;
        $gagal    = 0;

        $errors = [];


        // =================================================
        // 8. PROSES EXCEL
        // =================================================

        foreach (
            $rows as $index => $row
        ) {

            // Header
            if ($index == 1) {
                continue;
            }


            // =================================================
            // SESUAIKAN DENGAN EXCEL KAMU
            // =================================================

            $kode =
                trim(
                    (string) ($row['A'] ?? '')
                );


            $judul =
                trim(
                    (string) ($row['B'] ?? '')
                );


            $tanggalRaw =
                trim(
                    (string) ($row['C'] ?? '')
                );


            $namaThumbnail =
                trim(
                    (string) ($row['D'] ?? '')
                );


            // =================================================
            // BARIS KOSONG
            // =================================================

            if (
                $kode === '' &&
                $judul === '' &&
                $tanggalRaw === '' &&
                $namaThumbnail === ''
            ) {

                continue;
            }


            $rowErrors = [];


            // =================================================
            // VALIDASI
            // =================================================

            if ($kode === '') {

                $rowErrors[] =
                    'Kode kegiatan kosong.';
            }


            if ($judul === '') {

                $rowErrors[] =
                    'Nama kegiatan kosong.';
            }


            if ($tanggalRaw === '') {

                $rowErrors[] =
                    'Tanggal kegiatan kosong.';
            }


            if ($namaThumbnail === '') {

                $rowErrors[] =
                    'Nama thumbnail kosong.';
            }


            // =================================================
            // KONVERSI TANGGAL
            // =================================================

            $tanggal = '';


            if ($tanggalRaw !== '') {

                try {

                    // Jika Excel menyimpan sebagai angka
                    if (is_numeric($tanggalRaw)) {

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

                        // Format Excel kamu: YYYY-MM-DD
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

                            // Coba format DD-MM-YYYY
                            $date =
                                \DateTime::createFromFormat(
                                    'd-m-Y',
                                    $tanggalRaw
                                );


                            if ($date) {

                                $tanggal =
                                    $date->format(
                                        'Y-m-d'
                                    );
                            }
                        }
                    }

                } catch (
                    \Throwable $e
                ) {

                    $tanggal = '';
                }
            }


            if ($tanggal === '') {

                $rowErrors[] =
                    'Tanggal tidak valid.';
            }


            // =================================================
            // TAHUN OTOMATIS DARI TANGGAL
            // =================================================

            $tahun = '';


            if ($tanggal !== '') {

                $tahun =
                    date(
                        'Y',
                        strtotime($tanggal)
                    );
            }


            // =================================================
            // FOLDER ZIP
            // =================================================

            $folderKegiatan =
                'Kegiatan/' .
                $kode .
                '/';


            // =================================================
            // CARI THUMBNAIL
            // =================================================

            $thumbnailZipPath = null;


            for (
                $i = 0;
                $i < $zipArchive->numFiles;
                $i++
            ) {

                $zipName =
                    $zipArchive->getNameIndex(
                        $i
                    );


                if (!$zipName) {
                    continue;
                }


                $zipName =
                    str_replace(
                        '\\',
                        '/',
                        $zipName
                    );


                if (
                    strcasecmp(
                        basename($zipName),
                        $namaThumbnail
                    ) === 0
                    &&
                    str_starts_with(
                        $zipName,
                        $folderKegiatan
                    )
                ) {

                    $thumbnailZipPath =
                        $zipName;

                    break;
                }
            }


            if (!$thumbnailZipPath) {

                $rowErrors[] =
                    'Thumbnail "' .
                    $namaThumbnail .
                    '" tidak ditemukan dalam folder ' .
                    $folderKegiatan;
            }


            // =================================================
            // VALIDASI GAGAL
            // =================================================

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


            // =================================================
            // CEK DUPLIKAT
            // =================================================

            $slug =
                url_title(
                    $judul,
                    '-',
                    true
                );


            $existing =
                $this->kegiatanModel
                    ->where(
                        'slug',
                        $slug
                    )
                    ->first();


            if ($existing) {

                $dilewati++;

                continue;
            }


            // =================================================
            // AMBIL THUMBNAIL
            // =================================================

            $thumbnailContent =
                $zipArchive->getFromName(
                    $thumbnailZipPath
                );


            if (
                $thumbnailContent === false
            ) {

                $gagal++;


                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' => [
                        'Thumbnail tidak dapat dibaca.'
                    ]

                ];


                continue;
            }


            // =================================================
            // EXTENSION THUMBNAIL
            // =================================================

            $extension =
                strtolower(
                    pathinfo(
                        $namaThumbnail,
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
                        'Format thumbnail tidak diperbolehkan.'
                    ]

                ];


                continue;
            }


            // =================================================
            // NAMA THUMBNAIL BARU
            // =================================================

            $namaThumbnailBaru =
                uniqid(
                    'kegiatan_',
                    true
                )
                . '.' .
                $extension;


            // =================================================
            // SIMPAN THUMBNAIL
            // =================================================

            $saved =
                file_put_contents(
                    $thumbnailPath .
                    $namaThumbnailBaru,
                    $thumbnailContent
                );


            if ($saved === false) {

                $gagal++;


                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' => [
                        'Thumbnail gagal disimpan.'
                    ]

                ];


                continue;
            }


            // =================================================
            // INSERT KEGIATAN
            // =================================================

            try {

                $inserted =
                    $this->kegiatanModel->insert([

                        'judul' =>
                            $judul,

                        'slug' =>
                            $slug,

                        'deskripsi' =>
                            null,

                        'thumbnail' =>
                            $namaThumbnailBaru,

                        'tanggal' =>
                            $tanggal,

                        'tahun' =>
                            $tahun,

                    ]);

            } catch (
                \Throwable $e
            ) {

                if (
                    file_exists(
                        $thumbnailPath .
                        $namaThumbnailBaru
                    )
                ) {

                    unlink(
                        $thumbnailPath .
                        $namaThumbnailBaru
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


            if (!$inserted) {

                if (
                    file_exists(
                        $thumbnailPath .
                        $namaThumbnailBaru
                    )
                ) {

                    unlink(
                        $thumbnailPath .
                        $namaThumbnailBaru
                    );
                }


                $gagal++;


                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' => [
                        'Data kegiatan gagal disimpan.'
                    ]

                ];


                continue;
            }


            // =================================================
            // AMBIL ID KEGIATAN
            // =================================================

            $kegiatanId =
                $this->kegiatanModel
                    ->getInsertID();


            // =================================================
            // CARI SEMUA DOKUMENTASI
            // =================================================

            for (
                $i = 0;
                $i < $zipArchive->numFiles;
                $i++
            ) {

                $zipName =
                    $zipArchive->getNameIndex(
                        $i
                    );


                if (!$zipName) {
                    continue;
                }


                $zipName =
                    str_replace(
                        '\\',
                        '/',
                        $zipName
                    );


                // Harus berada di folder kegiatan
                if (
                    !str_starts_with(
                        $zipName,
                        $folderKegiatan
                    )
                ) {

                    continue;
                }


                // Abaikan folder
                if (
                    str_ends_with(
                        $zipName,
                        '/'
                    )
                ) {

                    continue;
                }


                // Jangan masukkan thumbnail
                if (
                    strcasecmp(
                        basename($zipName),
                        $namaThumbnail
                    ) === 0
                ) {

                    continue;
                }


                // =================================================
                // EXTENSION
                // =================================================

                $extension =
                    strtolower(
                        pathinfo(
                            $zipName,
                            PATHINFO_EXTENSION
                        )
                    );


                if (
                    !in_array(
                        $extension,
                        [
                            'jpg',
                            'jpeg',
                            'png',
                            'webp'
                        ]
                    )
                ) {

                    continue;
                }


                // =================================================
                // AMBIL FILE
                // =================================================

                $imageContent =
                    $zipArchive->getFromName(
                        $zipName
                    );


                if (
                    $imageContent === false
                ) {

                    continue;
                }


                // =================================================
                // NAMA FILE BARU
                // =================================================

                $namaFoto =
                    uniqid(
                        'kegiatan_',
                        true
                    )
                    . '.' .
                    $extension;


                // =================================================
                // SIMPAN FOTO
                // =================================================

                $saved =
                    file_put_contents(
                        $dokumentasiPath .
                        $namaFoto,
                        $imageContent
                    );


                if ($saved === false) {

                    continue;
                }


                // =================================================
                // INSERT FOTO
                // =================================================

                $this->fotoModel->insert([

                    'kegiatan_id' =>
                        $kegiatanId,

                    'foto' =>
                        $namaFoto,

                    'created_at' =>
                        date(
                            'Y-m-d H:i:s'
                        ),

                ]);
            }


            // =================================================
            // BERHASIL
            // =================================================

            $berhasil++;
        }


        // =================================================
        // TUTUP ZIP
        // =================================================

        $zipArchive->close();


        // =================================================
        // HASIL
        // =================================================

        $pesan =
            'Import selesai. ' .
            $berhasil .
            ' kegiatan berhasil';


        if ($dilewati > 0) {

            $pesan .=
                ', ' .
                $dilewati .
                ' kegiatan dilewati karena sudah ada';
        }


        if ($gagal > 0) {

            $pesan .=
                ', ' .
                $gagal .
                ' kegiatan gagal';
        }


        $pesan .= '.';


        // =================================================
        // SIMPAN DETAIL ERROR
        // =================================================

        if (!empty($errors)) {

            session()->setFlashdata(
                'import_errors',
                $errors
            );
        }


        // =================================================
        // KEMBALI
        // =================================================

        return redirect()
            ->to(
                base_url(
                    'admin/kegiatan'
                )
            )
            ->with(
                'success',
                $pesan
            );


    } catch (
        \Throwable $e
    ) {

        if (
            isset($zipArchive)
        ) {

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


   // =====================================================
// STORE
// =====================================================

public function store()
{
    // =================================================
    // 1. AMBIL DATA
    // =================================================

    $judul = trim(
        $this->request->getPost('judul')
    );

    $deskripsi = trim(
        $this->request->getPost('deskripsi')
    );

    $tanggalInput = trim(
        $this->request->getPost('tanggal')
    );


    // =================================================
    // 2. VALIDASI JUDUL
    // =================================================

    if ($judul === '') {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Judul kegiatan wajib diisi.'
            );
    }


    // =================================================
    // 3. VALIDASI TANGGAL
    // =================================================

    if ($tanggalInput === '') {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Tanggal kegiatan wajib diisi.'
            );
    }


    // =================================================
    // 4. KONVERSI TANGGAL
    // FORMAT INPUT : DD/MM/YYYY
    // DATABASE      : YYYY-MM-DD
    // =================================================

    $date = \DateTime::createFromFormat(
        'd/m/Y',
        $tanggalInput
    );

    $dateErrors = \DateTime::getLastErrors();

    $hasDateError = is_array($dateErrors)
        && (
            $dateErrors['warning_count'] > 0
            || $dateErrors['error_count'] > 0
        );


    if (
        !$date
        || $hasDateError
        || $date->format('d/m/Y') !== $tanggalInput
    ) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Format tanggal tidak valid. Gunakan DD/MM/YYYY.'
            );
    }


    // =================================================
    // HASIL KONVERSI
    // =================================================

    $tanggal = $date->format('Y-m-d');

    $tahun = $date->format('Y');


    // =================================================
    // 5. SLUG
    // =================================================

    $slug = url_title(
        $judul,
        '-',
        true
    );


    // =================================================
    // 6. CEK DUPLIKAT
    // =================================================

    $existing = $this->kegiatanModel
        ->where('slug', $slug)
        ->first();

    if ($existing) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Kegiatan dengan judul tersebut sudah ada.'
            );
    }


    // =================================================
    // 7. PASTIKAN FOLDER THUMBNAIL
    // =================================================

    $thumbnailPath =
        FCPATH . 'uploads/kegiatan/thumbnail/';

    if (!is_dir($thumbnailPath)) {

        mkdir(
            $thumbnailPath,
            0777,
            true
        );
    }


    // =================================================
    // 8. THUMBNAIL
    // =================================================

    $thumbnail =
        $this->request->getFile('thumbnail');

    $namaThumbnail = null;


    if (
        $thumbnail
        && $thumbnail->isValid()
        && !$thumbnail->hasMoved()
    ) {

        $namaThumbnail =
            $thumbnail->getRandomName();

        $thumbnail->move(
            $thumbnailPath,
            $namaThumbnail
        );
    }


    // =================================================
    // 9. SIMPAN KEGIATAN
    // =================================================

    $inserted = $this->kegiatanModel->insert([

        'judul' =>
            $judul,

        'slug' =>
            $slug,

        'deskripsi' =>
            $deskripsi,

        'thumbnail' =>
            $namaThumbnail,

        'tanggal' =>
            $tanggal,

        'tahun' =>
            $tahun,

    ]);


    if (!$inserted) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Data kegiatan gagal disimpan.'
            );
    }


    // =================================================
    // 10. AMBIL ID KEGIATAN
    // =================================================

    $kegiatanId =
        $this->kegiatanModel->getInsertID();


    // =================================================
    // 11. PASTIKAN FOLDER DOKUMENTASI
    // =================================================

    $dokumentasiPath =
        FCPATH . 'uploads/kegiatan/dokumentasi/';

    if (!is_dir($dokumentasiPath)) {

        mkdir(
            $dokumentasiPath,
            0777,
            true
        );
    }


    // =================================================
    // 12. DOKUMENTASI MULTIPLE
    // =================================================

    $dokumentasi =
        $this->request->getFiles();


    if (
        isset($dokumentasi['dokumentasi'])
        && is_array($dokumentasi['dokumentasi'])
    ) {

        foreach (
            $dokumentasi['dokumentasi']
            as $file
        ) {

            if (
                $file->isValid()
                && !$file->hasMoved()
            ) {

                $namaFoto =
                    $file->getRandomName();


                $file->move(
                    $dokumentasiPath,
                    $namaFoto
                );


                $this->fotoModel->insert([

                    'kegiatan_id' =>
                        $kegiatanId,

                    'foto' =>
                        $namaFoto,

                    'created_at' =>
                        date('Y-m-d H:i:s'),

                ]);
            }
        }
    }


    // =================================================
    // 13. SELESAI
    // =================================================

    return redirect()
        ->to(
            base_url('admin/kegiatan')
        )
        ->with(
            'success',
            'Kegiatan berhasil ditambahkan.'
        );
}


    // =====================================================
    // EDIT
    // =====================================================

    public function edit($id)
    {
        $kegiatan =
            $this->kegiatanModel->find($id);


        if (!$kegiatan) {

            return redirect()
                ->to(
                    base_url('admin/kegiatan')
                )
                ->with(
                    'error',
                    'Data kegiatan tidak ditemukan.'
                );
        }


        $data = [

            'title' =>
                'Edit Kegiatan',

            'kegiatan' =>
                $kegiatan,

            'foto' =>
                $this->fotoModel
                    ->where(
                        'kegiatan_id',
                        $id
                    )
                    ->findAll(),

        ];


        return view(
            'admin/Kegiatan/edit',
            $data
        );
    }


   // =====================================================
// UPDATE
// =====================================================

public function update($id)
{
    // =================================================
    // 1. CARI DATA
    // =================================================

    $kegiatan =
        $this->kegiatanModel->find($id);


    if (!$kegiatan) {

        return redirect()
            ->to(
                base_url('admin/kegiatan')
            )
            ->with(
                'error',
                'Data kegiatan tidak ditemukan.'
            );
    }


    // =================================================
    // 2. AMBIL DATA
    // =================================================

    $judul = trim(
        $this->request->getPost('judul')
    );

    $deskripsi = trim(
        $this->request->getPost('deskripsi')
    );

    $tanggalInput = trim(
        $this->request->getPost('tanggal')
    );


    // =================================================
    // 3. VALIDASI JUDUL
    // =================================================

    if ($judul === '') {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Judul kegiatan wajib diisi.'
            );
    }


    // =================================================
    // 4. VALIDASI TANGGAL
    // =================================================

    if ($tanggalInput === '') {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Tanggal kegiatan wajib diisi.'
            );
    }


    // =================================================
    // 5. KONVERSI TANGGAL
    // FORMAT INPUT : DD/MM/YYYY
    // DATABASE      : YYYY-MM-DD
    // =================================================

    $date = \DateTime::createFromFormat(
        'd/m/Y',
        $tanggalInput
    );

    $dateErrors = \DateTime::getLastErrors();

    $hasDateError = is_array($dateErrors)
        && (
            $dateErrors['warning_count'] > 0
            || $dateErrors['error_count'] > 0
        );


    if (
        !$date
        || $hasDateError
        || $date->format('d/m/Y') !== $tanggalInput
    ) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Format tanggal tidak valid. Gunakan DD/MM/YYYY.'
            );
    }


    // =================================================
    // HASIL KONVERSI
    // =================================================

    $tanggal =
        $date->format('Y-m-d');

    $tahun =
        $date->format('Y');


    // =================================================
    // 6. SLUG
    // =================================================

    $slug = url_title(
        $judul,
        '-',
        true
    );


    // =================================================
    // 7. THUMBNAIL LAMA
    // =================================================

    $namaThumbnail =
        $kegiatan['thumbnail'];


    // =================================================
    // 8. THUMBNAIL BARU
    // =================================================

    $thumbnail =
        $this->request->getFile('thumbnail');


    if (
        $thumbnail
        && $thumbnail->isValid()
        && !$thumbnail->hasMoved()
    ) {

        $thumbnailPath =
            FCPATH .
            'uploads/kegiatan/thumbnail/';


        // ---------------------------------------------
        // HAPUS THUMBNAIL LAMA
        // ---------------------------------------------

        if (
            !empty($kegiatan['thumbnail'])
            && file_exists(
                $thumbnailPath .
                $kegiatan['thumbnail']
            )
        ) {

            unlink(
                $thumbnailPath .
                $kegiatan['thumbnail']
            );
        }


        // ---------------------------------------------
        // UPLOAD THUMBNAIL BARU
        // ---------------------------------------------

        $namaThumbnail =
            $thumbnail->getRandomName();


        $thumbnail->move(
            $thumbnailPath,
            $namaThumbnail
        );
    }


    // =================================================
    // 9. UPDATE KEGIATAN
    // =================================================

    $updated =
        $this->kegiatanModel->update(
            $id,
            [

                'judul' =>
                    $judul,

                'slug' =>
                    $slug,

                'deskripsi' =>
                    $deskripsi,

                'thumbnail' =>
                    $namaThumbnail,

                'tanggal' =>
                    $tanggal,

                'tahun' =>
                    $tahun,

            ]
        );


    if (!$updated) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Data kegiatan gagal diperbarui.'
            );
    }


    // =================================================
    // 10. PASTIKAN FOLDER DOKUMENTASI
    // =================================================

    $dokumentasiPath =
        FCPATH .
        'uploads/kegiatan/dokumentasi/';


    if (!is_dir($dokumentasiPath)) {

        mkdir(
            $dokumentasiPath,
            0777,
            true
        );
    }


    // =================================================
    // 11. TAMBAH DOKUMENTASI BARU
    // =================================================

    $dokumentasi =
        $this->request->getFiles();


    if (
        isset($dokumentasi['dokumentasi'])
        && is_array($dokumentasi['dokumentasi'])
    ) {

        foreach (
            $dokumentasi['dokumentasi']
            as $file
        ) {

            if (
                $file->isValid()
                && !$file->hasMoved()
            ) {

                $namaFoto =
                    $file->getRandomName();


                $file->move(
                    $dokumentasiPath,
                    $namaFoto
                );


                $this->fotoModel->insert([

                    'kegiatan_id' =>
                        $id,

                    'foto' =>
                        $namaFoto,

                    'created_at' =>
                        date('Y-m-d H:i:s'),

                ]);
            }
        }
    }


    // =================================================
    // 12. SELESAI
    // =================================================

    return redirect()
        ->to(
            base_url('admin/kegiatan')
        )
        ->with(
            'success',
            'Data kegiatan berhasil diperbarui.'
        );
}


    // =====================================================
    // DELETE FOTO
    // =====================================================

    public function deleteFoto($id)
    {
        $foto =
            $this->fotoModel->find($id);


        if (!$foto) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Foto tidak ditemukan.'
                );
        }


        $path =
            FCPATH .
            'uploads/kegiatan/dokumentasi/' .
            $foto['foto'];


        if (file_exists($path)) {

            unlink($path);
        }


        $this->fotoModel->delete($id);


        return redirect()
            ->back()
            ->with(
                'success',
                'Foto dokumentasi berhasil dihapus.'
            );
    }


    // =====================================================
    // DELETE KEGIATAN
    // =====================================================

    public function delete($id)
    {
        $kegiatan =
            $this->kegiatanModel->find($id);


        if (!$kegiatan) {

            return redirect()
                ->to(
                    base_url('admin/kegiatan')
                )
                ->with(
                    'error',
                    'Data kegiatan tidak ditemukan.'
                );
        }


        // =================================================
        // HAPUS THUMBNAIL
        // =================================================

        if (
            !empty($kegiatan['thumbnail'])
        ) {

            $thumbnailPath =
                FCPATH .
                'uploads/kegiatan/thumbnail/' .
                $kegiatan['thumbnail'];


            if (file_exists($thumbnailPath)) {

                unlink($thumbnailPath);
            }
        }


        // =================================================
        // AMBIL SEMUA FOTO
        // =================================================

        $foto =
            $this->fotoModel
                ->where(
                    'kegiatan_id',
                    $id
                )
                ->findAll();


        // =================================================
        // HAPUS FILE FOTO
        // =================================================

        foreach ($foto as $item) {

            $fotoPath =
                FCPATH .
                'uploads/kegiatan/dokumentasi/' .
                $item['foto'];


            if (file_exists($fotoPath)) {

                unlink($fotoPath);
            }
        }


        // =================================================
        // HAPUS DATA FOTO
        // =================================================

        $this->fotoModel
            ->where(
                'kegiatan_id',
                $id
            )
            ->delete();


        // =================================================
        // HAPUS DATA KEGIATAN
        // =================================================

        $this->kegiatanModel->delete($id);


        return redirect()
            ->to(
                base_url('admin/kegiatan')
            )
            ->with(
                'success',
                'Kegiatan berhasil dihapus.'
            );
    }

    // =====================================================
// GENERATE NAMA FOTO
// =====================================================

private function generateNamaFoto($extension)
{
    return uniqid(
        'kegiatan_',
        true
    ) . '.' . $extension;
}
}

