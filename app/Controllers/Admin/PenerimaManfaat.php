<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PenerimaManfaatModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PenerimaManfaat extends BaseController
{
    protected $penerimaModel;


    // =====================================================
    // CONSTRUCTOR
    // =====================================================

    public function __construct()
    {
        $this->penerimaModel = new PenerimaManfaatModel();
    }


    // =====================================================
    // INDEX
    // =====================================================

    public function index()
    {
        // =================================================
        // SEARCH
        // =================================================

        $keyword = trim(
            $this->request->getGet('keyword') ?? ''
        );


        // =================================================
        // TOTAL SELURUH PENERIMA
        // =================================================

        $totalQuery = $this->penerimaModel
            ->selectSum('jumlah');

        if ($keyword !== '') {
            $totalQuery->groupStart()
                ->like('kategori', $keyword)
                ->orLike('periode_tahun', $keyword)
                ->groupEnd();
        }

        $total = $totalQuery->first();

        $totalPenerima = (int) (
            $total['jumlah'] ?? 0
        );


        // =================================================
        // TOTAL PER KATEGORI
        // =================================================

        $kategori = [

            'Penyandang Disabilitas' => 0,

            'Lansia' => 0,

            'Anak' => 0,

            'Keluarga Penerima Manfaat' => 0,

        ];


        $kategoriQuery = $this->penerimaModel
            ->select('kategori')
            ->selectSum('jumlah')
            ->groupBy('kategori');


        if ($keyword !== '') {

            $kategoriQuery
                ->groupStart()
                ->like('kategori', $keyword)
                ->orLike('periode_tahun', $keyword)
                ->groupEnd();

        }


        $kategoriData =
            $kategoriQuery->findAll();


        foreach ($kategoriData as $item) {

            $namaKategori = trim(
                $item['kategori'] ?? ''
            );


            // ---------------------------------------------
            // NORMALISASI NAMA KATEGORI
            // ---------------------------------------------

            $namaKategoriNormal =
                strtolower($namaKategori);


            if (
                $namaKategoriNormal ===
                'penyandang disabilitas'
            ) {

                $kategori['Penyandang Disabilitas'] +=
                    (int) $item['jumlah'];

            } elseif (
                $namaKategoriNormal === 'lansia'
            ) {

                $kategori['Lansia'] +=
                    (int) $item['jumlah'];

            } elseif (
                $namaKategoriNormal === 'anak'
            ) {

                $kategori['Anak'] +=
                    (int) $item['jumlah'];

            } elseif (
                $namaKategoriNormal ===
                'keluarga penerima manfaat'
            ) {

                $kategori['Keluarga Penerima Manfaat'] +=
                    (int) $item['jumlah'];

            }
        }


        // =================================================
        // DATA TABEL
        // =================================================

        $penerimaQuery = $this->penerimaModel
            ->orderBy('periode_tahun', 'DESC')
            ->orderBy('periode_bulan', 'DESC')
            ->orderBy('id', 'DESC');


        // SEARCH TABEL

        if ($keyword !== '') {

            $penerimaQuery
                ->groupStart()
                ->like('kategori', $keyword)
                ->orLike('periode_tahun', $keyword)
                ->groupEnd();

        }


        $penerima =
            $penerimaQuery->paginate(10);


        // =================================================
        // DATA VIEW
        // =================================================

        $data = [

            'title' =>
                'Data Penerima Manfaat',

            'penerima' =>
                $penerima,

            'pager' =>
                $this->penerimaModel->pager,

            'totalPenerima' =>
                $totalPenerima,

            'kategori' =>
                $kategori,

            'keyword' =>
                $keyword,

        ];


        return view(
            'admin/PenerimaManfaat/index',
            $data
        );
    }


    // =====================================================
    // CREATE
    // =====================================================

    public function create()
    {
        return view(
            'admin/PenerimaManfaat/create',
            [
                'title' =>
                    'Tambah Data Penerima Manfaat'
            ]
        );
    }


    // =====================================================
    // STORE
    // =====================================================

    public function store()
    {
        $periodeBulan =
            $this->request->getPost('periode_bulan');

        $periodeTahun =
            $this->request->getPost('periode_tahun');

        $kategori =
            trim(
                $this->request->getPost('kategori') ?? ''
            );

        $jumlah =
            $this->request->getPost('jumlah');


        // =================================================
        // VALIDASI BULAN
        // =================================================

        if (
            $periodeBulan === null ||
            $periodeBulan === ''
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Bulan wajib dipilih.'
                );
        }


        if (
            !is_numeric($periodeBulan) ||
            (int) $periodeBulan < 1 ||
            (int) $periodeBulan > 12
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Bulan tidak valid.'
                );
        }


        // =================================================
        // VALIDASI TAHUN
        // =================================================

        if (
            $periodeTahun === null ||
            $periodeTahun === ''
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Tahun wajib diisi.'
                );
        }


        if (
            !is_numeric($periodeTahun) ||
            (int) $periodeTahun < 2000 ||
            (int) $periodeTahun > 2100
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Tahun tidak valid.'
                );
        }


        // =================================================
        // VALIDASI KATEGORI
        // =================================================

        $kategoriValid = [

            'Penyandang Disabilitas',

            'Lansia',

            'Anak',

            'Keluarga Penerima Manfaat',

        ];


        if (
            !in_array(
                $kategori,
                $kategoriValid,
                true
            )
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Kategori tidak valid.'
                );
        }


        // =================================================
        // VALIDASI JUMLAH
        // =================================================

        if (
            $jumlah === null ||
            $jumlah === '' ||
            !is_numeric($jumlah)
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Jumlah wajib diisi dengan angka.'
                );
        }


        if ((int) $jumlah < 0) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Jumlah tidak boleh kurang dari 0.'
                );
        }


        // =================================================
        // SIMPAN
        // =================================================

        $this->penerimaModel->insert([

            'periode_bulan' =>
                (int) $periodeBulan,

            'periode_tahun' =>
                (int) $periodeTahun,

            'kategori' =>
                $kategori,

            'jumlah' =>
                (int) $jumlah,

        ]);


        return redirect()
            ->to(
                base_url(
                    'admin/penerima-manfaat'
                )
            )
            ->with(
                'success',
                'Data penerima manfaat berhasil ditambahkan.'
            );
    }


    // =====================================================
    // EDIT
    // =====================================================

    public function edit($id)
    {
        $penerima =
            $this->penerimaModel->find($id);


        if (!$penerima) {

            return redirect()
                ->to(
                    base_url(
                        'admin/penerima-manfaat'
                    )
                )
                ->with(
                    'error',
                    'Data penerima manfaat tidak ditemukan.'
                );
        }


        return view(
            'admin/PenerimaManfaat/edit',
            [
                'title' =>
                    'Perbarui Data Penerima Manfaat',

                'penerima' =>
                    $penerima,
            ]
        );
    }


    // =====================================================
    // UPDATE
    // =====================================================

    public function update($id)
    {
        $penerima =
            $this->penerimaModel->find($id);


        if (!$penerima) {

            return redirect()
                ->to(
                    base_url(
                        'admin/penerima-manfaat'
                    )
                )
                ->with(
                    'error',
                    'Data penerima manfaat tidak ditemukan.'
                );
        }


        $periodeBulan =
            $this->request->getPost('periode_bulan');

        $periodeTahun =
            $this->request->getPost('periode_tahun');

        $kategori =
            trim(
                $this->request->getPost('kategori') ?? ''
            );

        $jumlah =
            $this->request->getPost('jumlah');


        // =================================================
        // VALIDASI BULAN
        // =================================================

        if (
            $periodeBulan === null ||
            $periodeBulan === '' ||
            !is_numeric($periodeBulan) ||
            (int) $periodeBulan < 1 ||
            (int) $periodeBulan > 12
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Bulan tidak valid.'
                );
        }


        // =================================================
        // VALIDASI TAHUN
        // =================================================

        if (
            $periodeTahun === null ||
            $periodeTahun === '' ||
            !is_numeric($periodeTahun) ||
            (int) $periodeTahun < 2000 ||
            (int) $periodeTahun > 2100
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Tahun tidak valid.'
                );
        }


        // =================================================
        // VALIDASI KATEGORI
        // =================================================

        $kategoriValid = [

            'Penyandang Disabilitas',

            'Lansia',

            'Anak',

            'Keluarga Penerima Manfaat',

        ];


        if (
            !in_array(
                $kategori,
                $kategoriValid,
                true
            )
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Kategori tidak valid.'
                );
        }


        // =================================================
        // VALIDASI JUMLAH
        // =================================================

        if (
            $jumlah === null ||
            $jumlah === '' ||
            !is_numeric($jumlah)
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Jumlah wajib berupa angka.'
                );
        }


        if ((int) $jumlah < 0) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Jumlah tidak boleh kurang dari 0.'
                );
        }


        // =================================================
        // UPDATE
        // =================================================

        $this->penerimaModel->update(
            $id,
            [

                'periode_bulan' =>
                    (int) $periodeBulan,

                'periode_tahun' =>
                    (int) $periodeTahun,

                'kategori' =>
                    $kategori,

                'jumlah' =>
                    (int) $jumlah,

            ]
        );


        return redirect()
            ->to(
                base_url(
                    'admin/penerima-manfaat'
                )
            )
            ->with(
                'success',
                'Data penerima manfaat berhasil diperbarui.'
            );
    }


    // =====================================================
    // DELETE
    // =====================================================

    public function delete($id)
    {
        $penerima =
            $this->penerimaModel->find($id);


        if (!$penerima) {

            return redirect()
                ->to(
                    base_url(
                        'admin/penerima-manfaat'
                    )
                )
                ->with(
                    'error',
                    'Data penerima manfaat tidak ditemukan.'
                );
        }


        $this->penerimaModel->delete($id);


        return redirect()
            ->to(
                base_url(
                    'admin/penerima-manfaat'
                )
            )
            ->with(
                'success',
                'Data penerima manfaat berhasil dihapus.'
            );
    }


    // =====================================================
    // IMPORT PAGE
    // =====================================================

    public function import()
    {
        return view(
            'admin/PenerimaManfaat/import',
            [
                'title' =>
                    'Import Data Penerima Manfaat'
            ]
        );
    }


    // =====================================================
    // IMPORT PROCESS
    // =====================================================

    // =====================================================
// IMPORT PROCESS
// =====================================================

public function importProcess()
{
    // =================================================
    // AMBIL FILE
    // =================================================

    $file = $this->request->getFile('file_excel');


    // =================================================
    // CEK FILE
    // =================================================

    if (!$file || !$file->isValid()) {

        return redirect()
            ->back()
            ->with(
                'error',
                'Silakan pilih file Excel terlebih dahulu.'
            );
    }


    // =================================================
    // CEK EXTENSION
    // =================================================

    $extension = strtolower(
        $file->getClientExtension()
    );

    $allowedExtensions = [
        'xlsx',
        'xls'
    ];


    if (!in_array(
        $extension,
        $allowedExtensions,
        true
    )) {

        return redirect()
            ->back()
            ->with(
                'error',
                'Format file harus Excel (.xlsx atau .xls).'
            );
    }


    // =================================================
    // CEK UKURAN
    // Maksimal 50 MB
    // =================================================

    if ($file->getSize() > 50 * 1024 * 1024) {

        return redirect()
            ->back()
            ->with(
                'error',
                'Ukuran file maksimal 50 MB.'
            );
    }


    // =================================================
    // BACA EXCEL
    // =================================================

    try {

        $spreadsheet = IOFactory::load(
            $file->getTempName()
        );

        $sheet = $spreadsheet->getActiveSheet();

        $rows = $sheet->toArray(
            null,
            true,
            true,
            false
        );

    } catch (\Throwable $e) {

        return redirect()
            ->back()
            ->with(
                'error',
                'File Excel tidak dapat dibaca.'
            );
    }


    // =================================================
    // CEK DATA
    // =================================================

    if (count($rows) <= 1) {

        return redirect()
            ->back()
            ->with(
                'error',
                'File Excel tidak memiliki data.'
            );
    }


    // =================================================
    // HEADER
    // =================================================

    $header = array_map(
        function ($value) {

            return strtolower(
                trim(
                    preg_replace(
                        '/\s+/',
                        ' ',
                        (string) $value
                    )
                )
            );

        },
        $rows[0]
    );


    // =================================================
    // HEADER YANG WAJIB
    // =================================================

    $requiredHeaders = [
        'periode',
        'kategori',
        'jumlah'
    ];


    foreach ($requiredHeaders as $required) {

        if (!in_array(
            $required,
            $header,
            true
        )) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Kolom "' . $required . '" tidak ditemukan.'
                );
        }
    }


    // =================================================
    // CARI POSISI KOLOM
    // =================================================

    $colPeriode = array_search(
        'periode',
        $header,
        true
    );

    $colKategori = array_search(
        'kategori',
        $header,
        true
    );

    $colJumlah = array_search(
        'jumlah',
        $header,
        true
    );


    // =================================================
    // KATEGORI VALID
    // =================================================

    $kategoriValid = [

        'Penyandang Disabilitas',

        'Lansia',

        'Anak',

        'Keluarga Penerima Manfaat',

    ];


    // =================================================
    // SIAPKAN DATA
    // =================================================

    $dataImport = [];

    $errors = [];


    foreach (
        array_slice($rows, 1)
        as $index => $row
    ) {

        $baris = $index + 2;


        // =============================================
        // AMBIL NILAI
        // =============================================

        $periodeValue = $row[$colPeriode] ?? '';

        $kategori = trim(
            (string) (
                $row[$colKategori] ?? ''
            )
        );

        $jumlah = trim(
            (string) (
                $row[$colJumlah] ?? ''
            )
        );


        // =============================================
        // LEWATI BARIS KOSONG
        // =============================================

        if (
            trim((string) $periodeValue) === '' &&
            $kategori === '' &&
            $jumlah === ''
        ) {

            continue;
        }


        // =============================================
        // VALIDASI PERIODE
        // =============================================

        if (
            $periodeValue === null ||
            trim((string) $periodeValue) === ''
        ) {

            $errors[] =
                "Baris {$baris}: Periode wajib diisi.";

            continue;
        }


        // =============================================
        // KONVERSI PERIODE
        // =============================================

        try {

            if (
                is_numeric($periodeValue) &&
                (float) $periodeValue > 30000
            ) {

                // Excel serial date

                $date = Date::excelToDateTimeObject(
                    $periodeValue
                );

                $periodeBulan =
                    (int) $date->format('m');

                $periodeTahun =
                    (int) $date->format('Y');

            } else {

                // Contoh:
                // Juli 2026
                // July 2026
                // 07/2026
                // 7-2026

                $periodeText = trim(
                    (string) $periodeValue
                );

                $bulanMap = [

                    'januari' => 1,
                    'februari' => 2,
                    'maret' => 3,
                    'april' => 4,
                    'mei' => 5,
                    'juni' => 6,
                    'juli' => 7,
                    'agustus' => 8,
                    'september' => 9,
                    'oktober' => 10,
                    'november' => 11,
                    'desember' => 12,

                    'january' => 1,
                    'february' => 2,
                    'march' => 3,
                    'may' => 5,
                    'june' => 6,
                    'july' => 7,
                    'august' => 8,
                    'october' => 10,
                    'december' => 12,

                ];


                $periodeLower = strtolower(
                    $periodeText
                );


                $periodeBulan = null;
                $periodeTahun = null;


                foreach (
                    $bulanMap as $namaBulan => $nomorBulan
                ) {

                    if (
                        str_contains(
                            $periodeLower,
                            $namaBulan
                        )
                    ) {

                        $periodeBulan =
                            $nomorBulan;

                        break;
                    }
                }


                if (
                    preg_match(
                        '/(20\d{2})/',
                        $periodeText,
                        $match
                    )
                ) {

                    $periodeTahun =
                        (int) $match[1];
                }


                // Jika format 07/2026 atau 07-2026

                if (
                    $periodeBulan === null &&
                    preg_match(
                        '/^(\d{1,2})[\/\-](20\d{2})$/',
                        $periodeText,
                        $match
                    )
                ) {

                    $periodeBulan =
                        (int) $match[1];

                    $periodeTahun =
                        (int) $match[2];
                }


                if (
                    $periodeBulan === null ||
                    $periodeTahun === null
                ) {

                    throw new \Exception(
                        'Format periode tidak dikenali.'
                    );
                }
            }

        } catch (\Throwable $e) {

            $errors[] =
                "Baris {$baris}: Format periode tidak valid.";

            continue;
        }


        // =============================================
        // VALIDASI TAHUN
        // =============================================

        if (
            $periodeTahun < 2000 ||
            $periodeTahun > 2100
        ) {

            $errors[] =
                "Baris {$baris}: Tahun tidak valid.";

            continue;
        }


        // =============================================
        // VALIDASI KATEGORI
        // =============================================

        if (
            !in_array(
                $kategori,
                $kategoriValid,
                true
            )
        ) {

            $errors[] =
                "Baris {$baris}: Kategori tidak valid.";

            continue;
        }


        // =============================================
        // VALIDASI JUMLAH
        // =============================================

        if (
            $jumlah === '' ||
            !is_numeric($jumlah)
        ) {

            $errors[] =
                "Baris {$baris}: Jumlah harus berupa angka.";

            continue;
        }


        if ((int) $jumlah < 0) {

            $errors[] =
                "Baris {$baris}: Jumlah tidak boleh negatif.";

            continue;
        }


        // =============================================
        // MASUKKAN KE DATA IMPORT
        // =============================================

        $dataImport[] = [

            'periode_bulan' =>
                $periodeBulan,

            'periode_tahun' =>
                $periodeTahun,

            'kategori' =>
                $kategori,

            'jumlah' =>
                (int) $jumlah,

        ];
    }


    // =================================================
    // TIDAK ADA DATA VALID
    // =================================================

    if (empty($dataImport)) {

        $pesan =
            'Tidak ada data valid yang dapat diimport.';

        if (!empty($errors)) {

            $pesan .= ' ' . $errors[0];
        }

        return redirect()
            ->back()
            ->with(
                'error',
                $pesan
            );
    }


    // =================================================
    // SIMPAN KE DATABASE
    // =================================================

    try {

        $db = \Config\Database::connect();

        $db->transStart();

        $this->penerimaModel->insertBatch(
            $dataImport
        );

        $db->transComplete();


        if ($db->transStatus() === false) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data gagal disimpan ke database.'
                );
        }

    } catch (\Throwable $e) {

        return redirect()
            ->back()
            ->with(
                'error',
                'Import gagal: ' . $e->getMessage()
            );
    }


    // =================================================
    // HASIL IMPORT
    // =================================================

    $jumlahBerhasil =
        count($dataImport);

    $pesan =
        "Berhasil mengimport {$jumlahBerhasil} data penerima manfaat.";


    if (!empty($errors)) {

        $pesan .=
            ' ' .
            count($errors) .
            ' baris dilewati karena tidak valid.';
    }


    return redirect()
        ->to(
            base_url(
                'admin/penerima-manfaat'
            )
        )
        ->with(
            'success',
            $pesan
        );
}
}