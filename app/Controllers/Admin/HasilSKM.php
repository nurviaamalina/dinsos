<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\HasilSKMModel;
use App\Models\HasilSKMLayananModel;
use App\Models\HasilSKMDemografiModel;
use App\Models\HasilSKMImportModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class HasilSKM extends BaseController
{
    protected $hasilSKMModel;
    protected $hasilSKMLayananModel;
    protected $hasilSKMDemografiModel;
    protected $hasilSKMImportModel;

    public function __construct()
    {
        $this->hasilSKMModel = new HasilSKMModel();
        $this->hasilSKMLayananModel = new HasilSKMLayananModel();
        $this->hasilSKMDemografiModel = new HasilSKMDemografiModel();
        $this->hasilSKMImportModel = new HasilSKMImportModel();
    }


    /* =========================================================
       INDEX
    ========================================================= */

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $builder = $this->hasilSKMModel;

        if (!empty($keyword)) {
            $builder = $builder
                ->groupStart()
                ->like('kecamatan', $keyword)
                ->orLike('periode_tahun', $keyword)
                ->groupEnd();
        }

        $hasilSKM = $builder
            ->orderBy('periode_tahun', 'DESC')
            ->orderBy('periode_bulan', 'DESC')
            ->paginate(10);

        $totalResponden = $this->hasilSKMModel
            ->selectSum('jumlah_responden')
            ->first();

        $totalResponden =
            $totalResponden['jumlah_responden'] ?? 0;

        return view(
            'admin/HasilSKM/index',
            [
                'title' => 'Data Survei Kepuasan Masyarakat',

                'hasilSKM' => $hasilSKM,

                'pager' => $this->hasilSKMModel->pager,

                'keyword' => $keyword,

                'totalResponden' => $totalResponden,

                'rataIKM' => $this->hitungRataIKM(),

                'periodeTerakhir' =>
                    $this->ambilPeriodeTerakhir(),
            ]
        );
    }


    /* =========================================================
       HALAMAN IMPORT
    ========================================================= */

    public function import()
    {
        return view(
            'admin/HasilSKM/import',
            [
                'title' =>
                    'Import Data Survei Kepuasan Masyarakat',
            ]
        );
    }


    /* =========================================================
       IMPORT PROCESS
       
       Upload Excel
       ↓
       Baca semua sheet
       ↓
       Cari sheet data utama
       ↓
       Baca header
       ↓
       Deteksi kolom
       ↓
       Mapping
    ========================================================= */

    public function importProcess()
    {
        $file = $this->request->getFile('file_excel');

        if (!$file || !$file->isValid()) {

            return redirect()
                ->to(base_url('admin/hasil-skm/import'))
                ->with(
                    'error',
                    'File Excel tidak valid.'
                );
        }


        $extension =
            strtolower($file->getClientExtension());


        if (!in_array($extension, ['xlsx', 'xls'])) {

            return redirect()
                ->to(base_url('admin/hasil-skm/import'))
                ->with(
                    'error',
                    'Format file harus XLS atau XLSX.'
                );
        }


        /*
         * Folder temporary
         */
        $uploadPath =
            WRITEPATH . 'uploads/skm';


        if (!is_dir($uploadPath)) {

            mkdir(
                $uploadPath,
                0777,
                true
            );
        }


        /*
         * Simpan file
         */
        $newName =
            $file->getRandomName();


        $file->move(
            $uploadPath,
            $newName
        );


        $filePath =
            $uploadPath .
            DIRECTORY_SEPARATOR .
            $newName;


        try {

            /*
             * Load Excel
             */
            $spreadsheet =
                IOFactory::load($filePath);


            /*
             * Baca seluruh sheet
             */
            $sheetInfo = [];

            $bestSheet = null;

            $bestScore = -1;


           foreach (
    $spreadsheet->getWorksheetIterator()
    as $worksheet
) {

    /*
     * Ambil informasi header
     */
    $headerData =
        $this->ambilHeader($worksheet);


    /*
     * Yang dikirim ke nilaiSheet()
     * hanya daftar header
     */
    $headers =
        $headerData['headers'];


    /*
     * Hitung skor sheet
     */
    $score =
        $this->nilaiSheet(
            $headers
        );


    /*
     * Simpan informasi sheet
     */
    $sheetInfo[] = [

        'name' =>
            $worksheet->getTitle(),

        'headers' =>
            $headers,

        'score' =>
            $score,
    ];


    /*
     * Tentukan sheet dengan skor
     * tertinggi sebagai sheet utama
     */
    if ($score > $bestScore) {

        $bestScore = $score;

        $bestSheet =
            $worksheet->getTitle();
    }
}


            if (!$bestSheet) {

                throw new \Exception(
                    'Tidak ditemukan sheet yang dapat dibaca.'
                );
            }


            /*
             * Ambil sheet utama
             */
            $worksheet =
                $spreadsheet
                    ->getSheetByName($bestSheet);


            /*
             * Header
             */
            $headerData =
                $this->ambilHeader($worksheet);


            $headers =
                $headerData['headers'];

            $headerRow =
                $headerData['row'];


            /*
             * Deteksi mapping otomatis
             */
            $autoMapping =
                $this->deteksiMapping(
                    $headers
                );


            /*
             * Preview data
             */
            $preview =
                $this->ambilPreview(
                    $worksheet,
                    $headerRow,
                    5
                );


            /*
             * Simpan informasi temporary
             *
             * HANYA path file yang disimpan
             * ke session.
             *
             * Jangan simpan 321+ row ke session.
             */
            session()->set([

                'skm_import_temp_file' =>
                    $filePath,

                'skm_import_file_name' =>
                    $file->getClientName(),

                'skm_import_extension' =>
                    $extension,

                'skm_import_sheet' =>
                    $bestSheet,

                'skm_import_header_row' =>
                    $headerRow,

            ]);


            /*
             * Tampilkan mapping
             */
            return view(
                'admin/HasilSKM/mapping',
                [

                    'title' =>
                        'Mapping Kolom Data SKM',

                    'fileName' =>
                        $file->getClientName(),

                    'headers' =>
                        $headers,

                    'autoMapping' =>
                        $autoMapping,

                    'preview' =>
                        $preview,

                    'sheetInfo' =>
                        $sheetInfo,

                    'selectedSheet' =>
                        $bestSheet,
                ]
            );


        } catch (\Throwable $e) {

            if (is_file($filePath)) {

                @unlink($filePath);
            }


            return redirect()
                ->to(
                    base_url(
                        'admin/hasil-skm/import'
                    )
                )
                ->with(
                    'error',
                    'File Excel gagal dibaca: ' .
                    $e->getMessage()
                );
        }
    }


    /* =========================================================
       SIMPAN HASIL MAPPING
    ========================================================= */

    public function importSave()
    {
        $tempFile =
            session()->get(
                'skm_import_temp_file'
            );


        if (!$tempFile || !is_file($tempFile)) {

            return redirect()
                ->to(
                    base_url(
                        'admin/hasil-skm/import'
                    )
                )
                ->with(
                    'error',
                    'File import sudah tidak tersedia. Silakan upload ulang.'
                );
        }


        $mapping =
            $this->request->getPost('mapping');


        if (!is_array($mapping)) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Mapping kolom tidak valid.'
                );
        }


        /*
         * Bersihkan mapping kosong
         */
        $mappingClean = [];


        foreach ($mapping as $column => $role) {

            if (
                $role !== null &&
                $role !== ''
            ) {

                $mappingClean[$column] =
                    $role;
            }
        }


        /*
         * Ambil informasi session
         */
        $sheetName =
            session()->get(
                'skm_import_sheet'
            );


        $fileName =
            session()->get(
                'skm_import_file_name'
            );


        try {

            $spreadsheet =
                IOFactory::load($tempFile);


            $worksheet =
                $spreadsheet
                    ->getSheetByName($sheetName);


            if (!$worksheet) {

                throw new \Exception(
                    'Sheet data tidak ditemukan.'
                );
            }


            /*
             * Cari header
             */
            $headerData =
                $this->ambilHeader(
                    $worksheet
                );


            $headers =
                $headerData['headers'];

            $headerRow =
                $headerData['row'];


            /*
             * Ambil semua data
             */
            $rows =
                $this->ambilData(
                    $worksheet,
                    $headerRow
                );


            if (empty($rows)) {

                throw new \Exception(
                    'Tidak ada data yang dapat diimport.'
                );
            }


            /*
             * Proses data
             */
            $hasil =
                $this->prosesData(
                    $rows,
                    $mappingClean
                );


            if (empty($hasil)) {

                throw new \Exception(
                    'Data tidak dapat diproses. Pastikan mapping periode dan data SKM sudah benar.'
                );
            }


            /*
             * Transaction
             */
            $db =
                \Config\Database::connect();

            $db->transStart();


            /*
             * Simpan setiap periode
             */
            foreach ($hasil as $group) {

                $periodeBulan =
                    $group['periode_bulan'];

                $periodeTahun =
                    $group['periode_tahun'];

                /*
                 * Kalau tidak ada kecamatan
                 * pada file mentah, gunakan
                 * scope Kabupaten.
                 */
                $kecamatan =
                    $group['kecamatan']
                    ?: 'Kabupaten Banyuwangi';


                /*
                 * Cek apakah periode
                 * sudah ada.
                 */
                $existing =
                    $this->hasilSKMModel
                        ->where(
                            'periode_bulan',
                            $periodeBulan
                        )
                        ->where(
                            'periode_tahun',
                            $periodeTahun
                        )
                        ->where(
                            'kecamatan',
                            $kecamatan
                        )
                        ->first();


                $parentData = [

                    'periode_bulan' =>
                        $periodeBulan,

                    'periode_tahun' =>
                        $periodeTahun,

                    'kecamatan' =>
                        $kecamatan,

                    'jumlah_responden' =>
                        $group['jumlah_responden'],

                    'nilai_ikm' =>
                        round(
                            $group['nilai_ikm'],
                            2
                        ),

                    'dokumen' =>
                        $fileName,
                ];


                /*
                 * Jika sudah ada,
                 * update.
                 *
                 * Jika belum,
                 * insert.
                 */
                if ($existing) {

                    $hasilSKMId =
                        $existing['id'];


                    $this->hasilSKMModel
                        ->update(
                            $hasilSKMId,
                            $parentData
                        );


                    /*
                     * Hapus detail lama
                     */
                    $this->hasilSKMLayananModel
                        ->where(
                            'hasil_skm_id',
                            $hasilSKMId
                        )
                        ->delete();


                    $this->hasilSKMDemografiModel
                        ->where(
                            'hasil_skm_id',
                            $hasilSKMId
                        )
                        ->delete();


                } else {

                    $hasilSKMId =
                        $this->hasilSKMModel
                            ->insert(
                                $parentData,
                                true
                            );
                }


                /*
                 * ================================
                 * LAYANAN
                 * ================================
                 */
                foreach (
                    $group['layanan']
                    as $layanan
                ) {

                    $this->hasilSKMLayananModel
                        ->insert([

                            'hasil_skm_id' =>
                                $hasilSKMId,

                            'nama_layanan' =>
                                $layanan['nama_layanan'],

                            'jumlah_responden' =>
                                $layanan['jumlah_responden'],

                            'nilai_ikm' =>
                                round(
                                    $layanan['nilai_ikm'],
                                    2
                                ),
                        ]);
                }


                /*
                 * ================================
                 * DEMOGRAFI
                 * ================================
                 */
                foreach (
                    $group['demografi']
                    as $demografi
                ) {

                    $this->hasilSKMDemografiModel
                        ->insert([

                            'hasil_skm_id' =>
                                $hasilSKMId,

                            'jenis' =>
                                $demografi['jenis'],

                            'kategori' =>
                                $demografi['kategori'],

                            'jumlah' =>
                                $demografi['jumlah'],
                        ]);
                }


                /*
                 * ================================
                 * LOG IMPORT
                 * ================================
                 */
                $this->hasilSKMImportModel
                    ->insert([

                        'hasil_skm_id' =>
                            $hasilSKMId,

                        'nama_file' =>
                            $fileName,

                        'format_file' =>
                            session()->get(
                                'skm_import_extension'
                            ),

                        'mapping_kolom' =>
                            json_encode(
                                $mappingClean,
                                JSON_UNESCAPED_UNICODE
                            ),

                        'header_asli' =>
                            json_encode(
                                $headers,
                                JSON_UNESCAPED_UNICODE
                            ),

                        'data_asli' =>
                            json_encode(
                                $group['raw'],
                                JSON_UNESCAPED_UNICODE
                            ),

                        'created_at' =>
                            date(
                                'Y-m-d H:i:s'
                            ),
                    ]);
            }


            $db->transComplete();


            if ($db->transStatus() === false) {

                throw new \Exception(
                    'Database gagal menyimpan data.'
                );
            }


            /*
             * Hapus temporary file
             */
            if (is_file($tempFile)) {

                @unlink($tempFile);
            }


            /*
             * Hapus session temporary
             */
            session()->remove([
                'skm_import_temp_file',
                'skm_import_file_name',
                'skm_import_extension',
                'skm_import_sheet',
                'skm_import_header_row',
            ]);


            return redirect()
                ->to(
                    base_url(
                        'admin/hasil-skm'
                    )
                )
                ->with(
                    'success',
                    'Data SKM berhasil diimport.'
                );


        } catch (\Throwable $e) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Import gagal: ' .
                    $e->getMessage()
                );
        }
    }


    /* =========================================================
       PROSES DATA EXCEL
    ========================================================= */

    private function prosesData(
        array $rows,
        array $mapping
    ) {
        /*
         * Cari mapping
         */
        $roles = array_values($mapping);


        /*
         * Unsur U1-U9
         */
        $unsur = [];

        for ($i = 1; $i <= 9; $i++) {

            $role = 'u' . $i;

            $column =
                array_search(
                    $role,
                    $mapping,
                    true
                );

            if ($column !== false) {

                $unsur[$i] =
                    $column;
            }
        }


        /*
         * Periode
         */
        $bulanColumn =
            array_search(
                'periode_bulan',
                $mapping,
                true
            );

        $tahunColumn =
            array_search(
                'periode_tahun',
                $mapping,
                true
            );

        $tanggalColumn =
            array_search(
                'tanggal',
                $mapping,
                true
            );

        $periodeColumn =
            array_search(
                'periode',
                $mapping,
                true
            );


        /*
         * Layanan
         */
        $layananColumn =
            array_search(
                'nama_layanan',
                $mapping,
                true
            );


        /*
         * Kecamatan
         */
        $kecamatanColumn =
            array_search(
                'kecamatan',
                $mapping,
                true
            );


        /*
         * Bidang
         */
        $bidangColumn =
            array_search(
                'bidang',
                $mapping,
                true
            );


        /*
         * IKM langsung
         */
        $ikmColumn =
            array_search(
                'nilai_ikm',
                $mapping,
                true
            );


        /*
         * Jumlah responden
         */
        $respondenColumn =
            array_search(
                'jumlah_responden',
                $mapping,
                true
            );


        /*
         * Demografi
         */
        $genderColumn =
            array_search(
                'demografi_jenis_kelamin',
                $mapping,
                true
            );

        $pendidikanColumn =
            array_search(
                'demografi_pendidikan',
                $mapping,
                true
            );


        /*
         * Validasi periode
         */
        if (
            $bulanColumn === false &&
            $periodeColumn === false &&
            $tanggalColumn === false
        ) {

            throw new \Exception(
                'Kolom periode/bulan/tanggal belum dipetakan.'
            );
        }


        $groups = [];


        foreach ($rows as $row) {

            /*
             * Lewati baris kosong
             */
            $hasValue = false;

            foreach ($row as $value) {

                if (
                    $value !== null &&
                    trim((string) $value) !== ''
                ) {

                    $hasValue = true;

                    break;
                }
            }

            if (!$hasValue) {
                continue;
            }


            /*
             * ================================
             * PERIODE
             * ================================
             */

            $bulan = null;
            $tahun = null;


            if (
                $bulanColumn !== false
            ) {

                $bulan =
                    $this->parseMonth(
                        $row[$bulanColumn] ?? null
                    );
            }


            if (
                $tahunColumn !== false
            ) {

                $tahun =
                    $this->parseYear(
                        $row[$tahunColumn] ?? null
                    );
            }


            /*
             * Kalau ada tanggal
             */
            if (
                $tanggalColumn !== false &&
                (
                    !$bulan ||
                    !$tahun
                )
            ) {

                $tanggal =
                    $this->parseDate(
                        $row[$tanggalColumn] ?? null
                    );


                if ($tanggal) {

                    $bulan =
                        (int) $tanggal->format('n');

                    $tahun =
                        (int) $tanggal->format('Y');
                }
            }


            /*
             * Kalau menggunakan kolom periode
             */
            if (
                $periodeColumn !== false &&
                (
                    !$bulan ||
                    !$tahun
                )
            ) {

                $periode =
                    $this->parsePeriode(
                        $row[$periodeColumn] ?? null
                    );


                if ($periode) {

                    $bulan =
                        $periode['bulan'];

                    $tahun =
                        $periode['tahun'];
                }
            }


            if (!$bulan || !$tahun) {
                continue;
            }


            /*
             * ================================
             * KECAMATAN
             * ================================
             */

            $kecamatan =
                $kecamatanColumn !== false
                    ? trim(
                        (string) (
                            $row[$kecamatanColumn]
                            ?? ''
                        )
                    )
                    : 'Kabupaten Banyuwangi';


            /*
             * ================================
             * HITUNG IKM
             * ================================
             */

            $nilaiIKM = null;


            /*
             * Mode 1:
             * Excel sudah memiliki IKM
             */
            if (
                $ikmColumn !== false
            ) {

                $nilaiIKM =
                    $this->parseNumber(
                        $row[$ikmColumn]
                        ?? null
                    );
            }


            /*
             * Mode 2:
             * Excel mentah U1-U9
             */
            if (
                $nilaiIKM === null &&
                !empty($unsur)
            ) {

                $nilai = [];

                foreach (
                    $unsur as $u => $column
                ) {

                    $value =
                        $this->parseNumber(
                            $row[$column]
                            ?? null
                        );


                    if (
                        $value !== null &&
                        $value >= 1 &&
                        $value <= 4
                    ) {

                        $nilai[] =
                            $value;
                    }
                }


                if (!empty($nilai)) {

                    /*
                     * Rata-rata nilai unsur
                     * dikonversi ke 25
                     */
                    $rata =
                        array_sum($nilai)
                        / count($nilai);


                    $nilaiIKM =
                        $rata * 25;
                }
            }


            if ($nilaiIKM === null) {
                continue;
            }


            /*
             * Jumlah responden
             */
            if (
                $respondenColumn !== false
            ) {

                $jumlah =
                    $this->parseNumber(
                        $row[$respondenColumn]
                        ?? null
                    );

                $jumlah =
                    $jumlah !== null
                        ? (int) $jumlah
                        : 1;

            } else {

                /*
                 * Data mentah:
                 * satu baris = satu responden
                 */
                $jumlah = 1;
            }


            /*
             * Group key
             */
            $groupKey =
                $tahun .
                '-' .
                str_pad(
                    $bulan,
                    2,
                    '0',
                    STR_PAD_LEFT
                ) .
                '-' .
                strtolower($kecamatan);


            if (!isset($groups[$groupKey])) {

                $groups[$groupKey] = [

                    'periode_bulan' =>
                        $bulan,

                    'periode_tahun' =>
                        $tahun,

                    'kecamatan' =>
                        $kecamatan,

                    'jumlah_responden' =>
                        0,

                    'total_nilai' =>
                        0,

                    'nilai_ikm' =>
                        0,

                    'layanan' => [],

                    'demografi' => [],

                    'raw' => [],
                ];
            }


            /*
             * Simpan raw
             */
            $groups[$groupKey]['raw'][] =
                $row;


            /*
             * Total
             */
            $groups[$groupKey]
                ['jumlah_responden']
                += $jumlah;


            /*
             * Weighted average
             */
            $groups[$groupKey]
                ['total_nilai']
                += $nilaiIKM * $jumlah;


            /*
             * ================================
             * LAYANAN
             * ================================
             */

            if (
                $layananColumn !== false
            ) {

                $namaLayanan =
                    trim(
                        (string) (
                            $row[$layananColumn]
                            ?? ''
                        )
                    );


                if ($namaLayanan !== '') {

                    if (
                        !isset(
                            $groups[$groupKey]
                            ['layanan']
                            [$namaLayanan]
                        )
                    ) {

                        $groups[$groupKey]
                            ['layanan']
                            [$namaLayanan] = [

                                'nama_layanan' =>
                                    $namaLayanan,

                                'jumlah_responden' =>
                                    0,

                                'total_nilai' =>
                                    0,

                                'nilai_ikm' =>
                                    0,
                            ];
                    }


                    $groups[$groupKey]
                        ['layanan']
                        [$namaLayanan]
                        ['jumlah_responden']
                        += $jumlah;


                    $groups[$groupKey]
                        ['layanan']
                        [$namaLayanan]
                        ['total_nilai']
                        += $nilaiIKM * $jumlah;
                }
            }


            /*
             * ================================
             * DEMOGRAFI
             * ================================
             */

            if (
                $genderColumn !== false
            ) {

                $gender =
                    trim(
                        (string) (
                            $row[$genderColumn]
                            ?? ''
                        )
                    );


                if ($gender !== '') {

                    $key =
                        'Jenis Kelamin|' .
                        $gender;


                    if (
                        !isset(
                            $groups[$groupKey]
                            ['demografi']
                            [$key]
                        )
                    ) {

                        $groups[$groupKey]
                            ['demografi']
                            [$key] = [

                                'jenis' =>
                                    'Jenis Kelamin',

                                'kategori' =>
                                    $gender,

                                'jumlah' =>
                                    0,
                            ];
                    }


                    $groups[$groupKey]
                        ['demografi']
                        [$key]
                        ['jumlah']
                        += $jumlah;
                }
            }


            if (
                $pendidikanColumn !== false
            ) {

                $pendidikan =
                    trim(
                        (string) (
                            $row[$pendidikanColumn]
                            ?? ''
                        )
                    );


                if ($pendidikan !== '') {

                    $key =
                        'Pendidikan|' .
                        $pendidikan;


                    if (
                        !isset(
                            $groups[$groupKey]
                            ['demografi']
                            [$key]
                        )
                    ) {

                        $groups[$groupKey]
                            ['demografi']
                            [$key] = [

                                'jenis' =>
                                    'Pendidikan',

                                'kategori' =>
                                    $pendidikan,

                                'jumlah' =>
                                    0,
                            ];
                    }


                    $groups[$groupKey]
                        ['demografi']
                        [$key]
                        ['jumlah']
                        += $jumlah;
                }
            }
        }


        /*
         * Finalisasi
         */
        foreach ($groups as &$group) {

            if (
                $group['jumlah_responden'] > 0
            ) {

                $group['nilai_ikm'] =
                    $group['total_nilai']
                    /
                    $group['jumlah_responden'];
            }


            /*
             * Layanan
             */
            foreach (
                $group['layanan']
                as &$layanan
            ) {

                if (
                    $layanan['jumlah_responden']
                    > 0
                ) {

                    $layanan['nilai_ikm'] =
                        $layanan['total_nilai']
                        /
                        $layanan['jumlah_responden'];
                }
            }


            /*
             * Ubah associative array
             * menjadi list
             */
            $group['layanan'] =
                array_values(
                    $group['layanan']
                );


            $group['demografi'] =
                array_values(
                    $group['demografi']
                );
        }


        return $groups;
    }


    /* =========================================================
       DETEKSI HEADER
    ========================================================= */

    private function ambilHeader($worksheet)
    {
        $highestColumn =
            $worksheet->getHighestColumn();


        $highestRow =
            min(
                $worksheet->getHighestRow(),
                15
            );


        $rows =
            $worksheet->rangeToArray(
                'A1:' .
                $highestColumn .
                $highestRow,
                null,
                true,
                true
            );


        $bestRow = 1;
        $bestScore = -1;


        foreach ($rows as $index => $row) {

            $score = 0;

            foreach ($row as $value) {

                if (
                    $value === null ||
                    trim((string) $value) === ''
                ) {
                    continue;
                }


                $text =
                    $this->normalisasi(
                        $value
                    );


                if (
                    str_contains(
                        $text,
                        'responden'
                    )
                ) {
                    $score += 2;
                }

                if (
                    str_contains(
                        $text,
                        'layanan'
                    )
                ) {
                    $score += 2;
                }

                if (
                    preg_match(
                        '/^u[1-9]/',
                        $text
                    )
                ) {
                    $score += 3;
                }

                if (
                    str_contains(
                        $text,
                        'tanggal'
                    )
                ) {
                    $score += 2;
                }

                if (
                    str_contains(
                        $text,
                        'tahun'
                    )
                ) {
                    $score += 2;
                }

                if (
                    str_contains(
                        $text,
                        'bulan'
                    )
                ) {
                    $score += 2;
                }

                if (
                    str_contains(
                        $text,
                        'pendidikan'
                    )
                ) {
                    $score += 1;
                }

                if (
                    str_contains(
                        $text,
                        'jenis kelamin'
                    )
                ) {
                    $score += 1;
                }
            }


            if ($score > $bestScore) {

                $bestScore = $score;

                $bestRow =
                    $index + 1;
            }
        }


        $headerRow =
            $worksheet->rangeToArray(
                'A' .
                $bestRow .
                ':' .
                $highestColumn .
                $bestRow,
                null,
                true,
                true
            )[0];


        $headers = [];


        foreach (
            $headerRow as $column => $value
        ) {

            $value =
                trim((string) $value);


            if ($value === '') {
                continue;
            }


            $headers[$column] =
                $value;
        }


        return [

            'row' =>
                $bestRow,

            'headers' =>
                $headers,
        ];
    }


    /* =========================================================
       DETEKSI SHEET DATA UTAMA
    ========================================================= */

    private function nilaiSheet($headers)
    {
        $score = 0;


        foreach ($headers as $header) {

            $text =
                $this->normalisasi(
                    $header
                );


            if (
                preg_match(
                    '/^u[1-9]/',
                    $text
                )
            ) {

                $score += 5;
            }


            if (
                str_contains(
                    $text,
                    'responden'
                )
            ) {

                $score += 3;
            }


            if (
                str_contains(
                    $text,
                    'layanan'
                )
            ) {

                $score += 3;
            }


            if (
                str_contains(
                    $text,
                    'tanggal'
                )
            ) {

                $score += 2;
            }
        }


        return $score;
    }


    /* =========================================================
       AUTO MAPPING
    ========================================================= */

    private function deteksiMapping($headers)
    {
        $mapping = [];


        foreach (
            $headers as $column => $header
        ) {

            $text =
                $this->normalisasi(
                    $header
                );


            $role = '';


            /*
             * U1 - U9
             */
            if (
                preg_match(
                    '/^u\s*([1-9])/',
                    $text,
                    $match
                )
            ) {

                $role =
                    'u' . $match[1];
            }


            /*
             * ID
             */
            elseif (
                str_contains(
                    $text,
                    'id responden'
                ) ||
                $text === 'id'
            ) {

                $role =
                    'id_responden';
            }


            /*
             * Tanggal
             */
            elseif (
                str_contains(
                    $text,
                    'tanggal survei'
                ) ||
                $text === 'tanggal'
            ) {

                $role =
                    'tanggal';
            }


            /*
             * Bulan
             */
            elseif (
                $text === 'bulan' ||
                str_contains(
                    $text,
                    'periode bulan'
                )
            ) {

                $role =
                    'periode_bulan';
            }


            /*
             * Tahun
             */
            elseif (
                $text === 'tahun' ||
                str_contains(
                    $text,
                    'periode tahun'
                )
            ) {

                $role =
                    'periode_tahun';
            }


            /*
             * Periode
             */
            elseif (
                $text === 'periode'
            ) {

                $role =
                    'periode';
            }


            /*
             * Layanan
             */
            elseif (
                str_contains(
                    $text,
                    'nama layanan'
                ) ||
                $text === 'layanan'
            ) {

                $role =
                    'nama_layanan';
            }


            /*
             * Bidang
             */
            elseif (
                $text === 'bidang' ||
                str_contains(
                    $text,
                    'bidang layanan'
                )
            ) {

                $role =
                    'bidang';
            }


            /*
             * Kecamatan
             */
            elseif (
                str_contains(
                    $text,
                    'kecamatan'
                ) ||
                $text === 'wilayah'
            ) {

                $role =
                    'kecamatan';
            }


            /*
             * Gender
             */
            elseif (
                str_contains(
                    $text,
                    'jenis kelamin'
                ) ||
                $text === 'gender'
            ) {

                $role =
                    'demografi_jenis_kelamin';
            }


            /*
             * Pendidikan
             */
            elseif (
                str_contains(
                    $text,
                    'pendidikan'
                )
            ) {

                $role =
                    'demografi_pendidikan';
            }


            /*
             * IKM
             */
            elseif (
                str_contains(
                    $text,
                    'nilai ikm'
                ) ||
                $text === 'ikm'
            ) {

                $role =
                    'nilai_ikm';
            }


            /*
             * Responden
             */
            elseif (
                str_contains(
                    $text,
                    'jumlah responden'
                ) ||
                $text === 'responden'
            ) {

                $role =
                    'jumlah_responden';
            }


            $mapping[$column] =
                $role;
        }


        return $mapping;
    }


    /* =========================================================
       PREVIEW
    ========================================================= */

    private function ambilPreview(
        $worksheet,
        $headerRow,
        $limit = 5
    ) {
        $highestColumn =
            $worksheet->getHighestColumn();

        $highestRow =
            $worksheet->getHighestRow();


        $endRow =
            min(
                $headerRow + $limit,
                $highestRow
            );


        if ($endRow <= $headerRow) {
            return [];
        }


        return $worksheet->rangeToArray(
            'A' .
            ($headerRow + 1) .
            ':' .
            $highestColumn .
            $endRow,
            null,
            true,
            true
        );
    }


    /* =========================================================
       AMBIL SEMUA DATA
    ========================================================= */

    private function ambilData(
        $worksheet,
        $headerRow
    ) {
        $highestColumn =
            $worksheet->getHighestColumn();

        $highestRow =
            $worksheet->getHighestRow();


        if (
            $highestRow <= $headerRow
        ) {

            return [];
        }


        return $worksheet->rangeToArray(
            'A' .
            ($headerRow + 1) .
            ':' .
            $highestColumn .
            $highestRow,
            null,
            true,
            true
        );
    }


    /* =========================================================
       NORMALISASI
    ========================================================= */

    private function normalisasi($value)
    {
        $value =
            strtolower(
                trim((string) $value)
            );


        $value =
            preg_replace(
                '/\s+/',
                ' ',
                $value
            );


        return $value;
    }


    /* =========================================================
       PARSE NUMBER
    ========================================================= */

    private function parseNumber($value)
    {
        if (
            $value === null ||
            trim((string) $value) === ''
        ) {

            return null;
        }


        if (is_numeric($value)) {

            return (float) $value;
        }


        $value =
            str_replace(
                '%',
                '',
                (string) $value
            );


        $value =
            str_replace(
                ',',
                '.',
                $value
            );


        $value =
            preg_replace(
                '/[^0-9.\-]/',
                '',
                $value
            );


        return is_numeric($value)
            ? (float) $value
            : null;
    }


    /* =========================================================
       PARSE MONTH
    ========================================================= */

    private function parseMonth($value)
    {
        if (
            $value === null ||
            trim((string) $value) === ''
        ) {

            return null;
        }


        if (
            is_numeric($value) &&
            (int) $value >= 1 &&
            (int) $value <= 12
        ) {

            return (int) $value;
        }


        $bulan = [

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

        ];


        $text =
            strtolower(
                trim((string) $value)
            );


        foreach (
            $bulan as $nama => $nomor
        ) {

            if (
                str_contains(
                    $text,
                    $nama
                )
            ) {

                return $nomor;
            }
        }


        return null;
    }


    /* =========================================================
       PARSE YEAR
    ========================================================= */

    private function parseYear($value)
    {
        if (
            $value === null ||
            trim((string) $value) === ''
        ) {

            return null;
        }


        if (
            is_numeric($value)
        ) {

            $year =
                (int) $value;

            if (
                $year >= 1900 &&
                $year <= 2100
            ) {

                return $year;
            }
        }


        if (
            preg_match(
                '/(19|20)\d{2}/',
                (string) $value,
                $match
            )
        ) {

            return (int) $match[0];
        }


        return null;
    }


    /* =========================================================
       PARSE DATE
    ========================================================= */

    private function parseDate($value)
    {
        if ($value instanceof \DateTimeInterface) {

            return new \DateTime(
                $value->format('Y-m-d')
            );
        }


        if (
            $value === null ||
            trim((string) $value) === ''
        ) {

            return null;
        }


        $timestamp =
            strtotime(
                (string) $value
            );


        if ($timestamp === false) {

            return null;
        }


        return new \DateTime(
            date(
                'Y-m-d',
                $timestamp
            )
        );
    }


    /* =========================================================
       PARSE PERIODE
    ========================================================= */

    private function parsePeriode($value)
    {
        if (
            $value === null
        ) {

            return null;
        }


        $bulan =
            $this->parseMonth(
                $value
            );


        $tahun =
            $this->parseYear(
                $value
            );


        if (
            $bulan &&
            $tahun
        ) {

            return [

                'bulan' =>
                    $bulan,

                'tahun' =>
                    $tahun,
            ];
        }


        return null;
    }


    /* =========================================================
       RATA-RATA IKM
    ========================================================= */

    private function hitungRataIKM()
    {
        $result =
            $this->hasilSKMModel
                ->selectAvg('nilai_ikm')
                ->first();


        return round(
            (float) (
                $result['nilai_ikm']
                ?? 0
            ),
            2
        );
    }


    /* =========================================================
       PERIODE TERAKHIR
    ========================================================= */

    private function ambilPeriodeTerakhir()
    {
        $data =
            $this->hasilSKMModel
                ->orderBy(
                    'periode_tahun',
                    'DESC'
                )
                ->orderBy(
                    'periode_bulan',
                    'DESC'
                )
                ->first();


        if (!$data) {

            return '-';
        }


        return $this->namaBulan(
            $data['periode_bulan']
        )
        . ' '
        . $data['periode_tahun'];
    }


    /* =========================================================
       BULAN
    ========================================================= */

    private function namaBulan($bulan)
    {
        $nama = [

            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',

        ];


        return $nama[
            (int) $bulan
        ] ?? '-';
    }


    /* =========================================================
       DELETE
    ========================================================= */

    public function delete($id)
    {
        $data =
            $this->hasilSKMModel
                ->find($id);


        if (!$data) {

            return redirect()
                ->to(
                    base_url(
                        'admin/hasil-skm'
                    )
                )
                ->with(
                    'error',
                    'Data SKM tidak ditemukan.'
                );
        }


        $this->hasilSKMModel
            ->delete($id);


        return redirect()
            ->to(
                base_url(
                    'admin/hasil-skm'
                )
            )
            ->with(
                'success',
                'Data SKM berhasil dihapus.'
            );
    }
}