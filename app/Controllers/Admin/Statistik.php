<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DatalayananModel;
use App\Models\PenerimaManfaatModel;
use App\Models\HasilSKMModel;

class Statistik extends BaseController
{
    protected $datalayananModel;
    protected $penerimaModel;
    protected $skmModel;

    public function __construct()
    {
        $this->datalayananModel = new DatalayananModel();
        $this->penerimaModel    = new PenerimaManfaatModel();
        $this->skmModel         = new HasilSKMModel();
    }

    public function index()
    {
        /*
         * =========================================================
         * 1. TAHUN YANG DIPILIH
         * =========================================================
         */

        $tahunSekarang = (int) date('Y');

        $tahunRequest = $this->request->getGet('tahun');

        $tahunRequest = is_numeric($tahunRequest)
            ? (int) $tahunRequest
            : $tahunSekarang;


        /*
         * =========================================================
         * 2. AMBIL DATA
         * =========================================================
         */

        $semuaLayanan  = $this->datalayananModel->findAll();
        $semuaPenerima = $this->penerimaModel->findAll();
        $semuaSKM      = $this->skmModel->findAll();


        /*
         * DatalayananModel returnType = object
         * sehingga diubah menjadi array.
         */

        $semuaLayanan = array_map(
            static fn($item) => (array) $item,
            $semuaLayanan
        );

        $semuaPenerima = array_map(
            static fn($item) => (array) $item,
            $semuaPenerima
        );

        $semuaSKM = array_map(
            static fn($item) => (array) $item,
            $semuaSKM
        );


        /*
         * =========================================================
         * 3. DAFTAR TAHUN TERSEDIA
         * =========================================================
         */

        $tahunTersedia = [$tahunSekarang];


        /*
         * TAHUN DATA PELAYANAN
         */

        foreach ($semuaLayanan as $item) {

            $periodeInfo = $this->parsePeriode(
                $item['periode'] ?? ''
            );

            if ($periodeInfo['tahun'] !== null) {
                $tahunTersedia[] = $periodeInfo['tahun'];
            }
        }


        /*
         * TAHUN PENERIMA MANFAAT
         */

        foreach ($semuaPenerima as $item) {

            if (
                isset($item['periode_tahun']) &&
                is_numeric($item['periode_tahun'])
            ) {
                $tahunTersedia[] = (int) $item['periode_tahun'];
            }
        }


        /*
         * TAHUN SKM
         */

        foreach ($semuaSKM as $item) {

            if (
                isset($item['periode_tahun']) &&
                is_numeric($item['periode_tahun'])
            ) {
                $tahunTersedia[] = (int) $item['periode_tahun'];
            }
        }


        /*
         * Hilangkan tahun yang duplikat.
         */

        $tahunTersedia = array_values(
            array_unique($tahunTersedia)
        );

        rsort($tahunTersedia);


        /*
         * Jika tahun request tidak tersedia,
         * gunakan tahun sekarang.
         */

        $tahun = in_array(
            $tahunRequest,
            $tahunTersedia,
            true
        )
            ? $tahunRequest
            : $tahunSekarang;


        /*
         * =========================================================
         * 4. VARIABEL DATA PELAYANAN
         * =========================================================
         */

        $totalLayanan   = 0;
        $layananSelesai = 0;
        $layananProses  = 0;
        $layananBelum   = 0;

        $bidangData    = [];
        $layananData   = [];
        $kecamatanData = [];


        /*
         * =========================================================
         * 5. MASTER BIDANG
         * =========================================================
         *
         * Dashboard selalu memiliki 4 bidang resmi.
         *
         * Bidang yang belum memiliki transaksi tetap muncul
         * dengan nilai 0%.
         */

        $daftarBidang = [
            'Perlindungan dan jaminan sosial',
            'Pemberdayaan dan rehabilitasi sosial',
            'Pemberdayaan perempuan dan perlindungan anak',
            'Pengendalian penduduk dan keluarga berencana',
        ];


        /*
         * Inisialisasi semua bidang dengan nilai 0.
         */

        foreach ($daftarBidang as $namaBidang) {

            $bidangData[$namaBidang] = [
                'nama'    => $namaBidang,
                'jumlah'  => 0,
                'selesai' => 0,
                'proses'  => 0,
                'belum'   => 0,
            ];
        }


        /*
         * =========================================================
         * 6. DATA BULAN
         * =========================================================
         */

        $namaBulan = [
            1  => 'Januari',
            2  => 'Februari',
            3  => 'Maret',
            4  => 'April',
            5  => 'Mei',
            6  => 'Juni',
            7  => 'Juli',
            8  => 'Agustus',
            9  => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];


        /*
         * =========================================================
         * 7. GRAFIK BULANAN
         * =========================================================
         */

        $grafikBulan = [];

        foreach ($namaBulan as $nomor => $nama) {

            $grafikBulan[$nomor] = [
                'bulan'      => $nama,
                'permohonan' => 0,
                'selesai'    => 0,
            ];
        }


        /*
         * =========================================================
         * 8. PROSES DATA PELAYANAN
         * =========================================================
         */

        foreach ($semuaLayanan as $item) {

            /*
             * Ambil periode.
             */

            $periodeInfo = $this->parsePeriode(
                $item['periode'] ?? ''
            );

            $tahunData = $periodeInfo['tahun'];
            $bulanData = $periodeInfo['bulan'];


            /*
             * Hanya data tahun yang dipilih.
             */

            if (
                $tahunData === null ||
                $tahunData !== $tahun
            ) {
                continue;
            }


            /*
             * =====================================================
             * JUMLAH
             * =====================================================
             */

            $jumlah = max(
                0,
                (int) ($item['jumlah'] ?? 0)
            );


            /*
             * =====================================================
             * SELESAI
             * =====================================================
             */

            $selesai = max(
                0,
                (int) ($item['selesai'] ?? 0)
            );


            /*
             * =====================================================
             * PROSES
             * =====================================================
             */

            $proses = max(
                0,
                (int) ($item['proses'] ?? 0)
            );


            /*
             * Selesai tidak boleh lebih besar dari jumlah.
             */

            if ($selesai > $jumlah) {
                $selesai = $jumlah;
            }


            /*
             * Proses tidak boleh lebih besar dari
             * sisa setelah selesai.
             */

            $maksimalProses = $jumlah - $selesai;

            if ($proses > $maksimalProses) {
                $proses = $maksimalProses;
            }


            /*
             * =====================================================
             * BELUM SELESAI
             * =====================================================
             *
             * Sesuai definisi yang kita tetapkan:
             *
             * Belum Selesai = Proses
             */

            $belum = $proses;


            /*
             * =====================================================
             * TOTAL
             * =====================================================
             */

            $totalLayanan   += $jumlah;
            $layananSelesai += $selesai;
            $layananProses  += $proses;
            $layananBelum   += $belum;


            /*
             * =====================================================
             * GRAFIK BULANAN
             * =====================================================
             */

            if (
                $bulanData !== null &&
                isset($grafikBulan[$bulanData])
            ) {

                $grafikBulan[$bulanData]['permohonan']
                    += $jumlah;

                $grafikBulan[$bulanData]['selesai']
                    += $selesai;
            }


            /*
             * =====================================================
             * BIDANG
             * =====================================================
             */

            $bidangAsli = trim(
                (string) ($item['bidang'] ?? '')
            );


            /*
             * Normalisasi bidang.
             *
             * Tujuannya supaya:
             *
             * "pemberdayaan dan rehabilitasi sosial"
             * dan
             * "Pemberdayaan dan rehabilitasi sosial"
             *
             * dianggap bidang yang sama.
             */

            $bidang = $this->normalizeBidang(
                $bidangAsli
            );


            /*
             * Jika bidang tidak cocok dengan daftar resmi,
             * masukkan ke "Tidak Diketahui".
             */

            if ($bidang === null) {

                $bidang = 'Tidak Diketahui';

                if (!isset($bidangData[$bidang])) {

                    $bidangData[$bidang] = [
                        'nama'    => $bidang,
                        'jumlah'  => 0,
                        'selesai' => 0,
                        'proses'  => 0,
                        'belum'   => 0,
                    ];
                }
            }


            /*
             * Tambahkan data ke bidang.
             */

            $bidangData[$bidang]['jumlah']
                += $jumlah;

            $bidangData[$bidang]['selesai']
                += $selesai;

            $bidangData[$bidang]['proses']
                += $proses;

            $bidangData[$bidang]['belum']
                += $belum;


            /*
             * =====================================================
             * LAYANAN
             * =====================================================
             */

            $layanan = trim(
                (string) ($item['layanan'] ?? '')
            );

            if ($layanan === '') {
                $layanan = 'Tidak Diketahui';
            }


            if (!isset($layananData[$layanan])) {

                $layananData[$layanan] = [
                    'nama'    => $layanan,
                    'jumlah'  => 0,
                    'selesai' => 0,
                    'proses'  => 0,
                    'belum'   => 0,
                ];
            }


            $layananData[$layanan]['jumlah']
                += $jumlah;

            $layananData[$layanan]['selesai']
                += $selesai;

            $layananData[$layanan]['proses']
                += $proses;

            $layananData[$layanan]['belum']
                += $belum;


            /*
             * =====================================================
             * KECAMATAN
             * =====================================================
             */

            $kecamatan = trim(
                (string) ($item['kecamatan'] ?? '')
            );

            if ($kecamatan === '') {
                $kecamatan = 'Tidak Diketahui';
            }


            if (!isset($kecamatanData[$kecamatan])) {

                $kecamatanData[$kecamatan] = [
                    'nama'    => $kecamatan,
                    'jumlah'  => 0,
                    'selesai' => 0,
                    'proses'  => 0,
                    'belum'   => 0,
                ];
            }


            $kecamatanData[$kecamatan]['jumlah']
                += $jumlah;

            $kecamatanData[$kecamatan]['selesai']
                += $selesai;

            $kecamatanData[$kecamatan]['proses']
                += $proses;

            $kecamatanData[$kecamatan]['belum']
                += $belum;
        }


        /*
         * =========================================================
         * 9. CAPAIAN KESELURUHAN
         * =========================================================
         */

        $capaianLayanan = $totalLayanan > 0
            ? round(
                ($layananSelesai / $totalLayanan) * 100,
                2
            )
            : 0;


        /*
         * =========================================================
         * 10. CAPAIAN PER BIDANG
         * =========================================================
         */

        $bidang = [];

        foreach ($bidangData as $item) {

            $capaian = $item['jumlah'] > 0
                ? round(
                    ($item['selesai'] / $item['jumlah']) * 100,
                    2
                )
                : 0;


            $bidang[] = [
                'nama'    => $item['nama'],
                'jumlah'  => $item['jumlah'],
                'selesai' => $item['selesai'],
                'proses'  => $item['proses'],
                'belum'   => $item['belum'],
                'capaian' => $capaian,
            ];
        }


        /*
         * =========================================================
         * URUTKAN BIDANG
         * =========================================================
         *
         * Bidang yang memiliki data diurutkan berdasarkan
         * capaian tertinggi.
         *
         * Bidang 0% akan berada di bawah.
         */

        usort(
            $bidang,
            static function ($a, $b) {

                if ($a['capaian'] == $b['capaian']) {
                    return $a['nama'] <=> $b['nama'];
                }

                return $b['capaian'] <=> $a['capaian'];
            }
        );


        /*
         * =========================================================
         * 11. LAYANAN UNGGULAN
         * =========================================================
         *
         * DEFINISI:
         *
         * Layanan Unggulan =
         * 4 layanan dengan JUMLAH PERMOHONAN SELESAI
         * terbanyak.
         */

        $layananUnggulan = [];

        foreach ($layananData as $item) {

            if ($item['jumlah'] <= 0) {
                continue;
            }


            $capaian = round(
                ($item['selesai'] / $item['jumlah']) * 100,
                2
            );


            $layananUnggulan[] = [
                'nama'    => $item['nama'],
                'jumlah'  => $item['jumlah'],
                'selesai' => $item['selesai'],
                'proses'  => $item['proses'],
                'belum'   => $item['belum'],
                'capaian' => $capaian,
            ];
        }


        /*
         * =========================================================
         * RANKING LAYANAN UNGGULAN
         * =========================================================
         *
         * Prioritas pertama:
         * jumlah SELESAI terbesar
         *
         * Jika sama:
         * jumlah permohonan terbesar
         */

        usort(
            $layananUnggulan,
            static function ($a, $b) {

                if ($a['selesai'] === $b['selesai']) {
                    return $b['jumlah'] <=> $a['jumlah'];
                }

                return $b['selesai'] <=> $a['selesai'];
            }
        );


        /*
         * Hanya ambil 4 besar.
         */

        $layananUnggulan = array_slice(
            $layananUnggulan,
            0,
            4
        );


        /*
         * =========================================================
         * 12. TOP 5 KECAMATAN
         * =========================================================
         *
         * Tetap menggunakan CAPAIAN tertinggi.
         */

        $kecamatan = [];

        foreach ($kecamatanData as $item) {

            if ($item['jumlah'] <= 0) {
                continue;
            }


            $capaian = round(
                ($item['selesai'] / $item['jumlah']) * 100,
                2
            );


            $kecamatan[] = [
                'nama'    => $item['nama'],
                'jumlah'  => $item['jumlah'],
                'selesai' => $item['selesai'],
                'proses'  => $item['proses'],
                'belum'   => $item['belum'],
                'capaian' => $capaian,
            ];
        }


        /*
         * Ranking berdasarkan capaian.
         */

        usort(
            $kecamatan,
            static function ($a, $b) {

                if ($a['capaian'] == $b['capaian']) {
                    return $b['selesai'] <=> $a['selesai'];
                }

                return $b['capaian'] <=> $a['capaian'];
            }
        );


        /*
         * Ambil Top 5.
         */

        $topKecamatan = array_slice(
            $kecamatan,
            0,
            5
        );


        /*
         * =========================================================
         * 13. PENERIMA MANFAAT
         * =========================================================
         *
         * HANYA berdasarkan tahun yang dipilih.
         */

        $totalPenerima = 0;

        $kategoriPenerima = [
            'Keluarga Penerima Manfaat' => 0,
            'Penyandang Disabilitas'    => 0,
            'Lansia'                    => 0,
            'Anak'                      => 0,
            'Lainnya'                   => 0,
        ];


        foreach ($semuaPenerima as $item) {

            $tahunPenerima = isset(
                $item['periode_tahun']
            )
                ? (int) $item['periode_tahun']
                : null;


            /*
             * Hanya tahun terpilih.
             */

            if ($tahunPenerima !== $tahun) {
                continue;
            }


            $jumlah = max(
                0,
                (int) ($item['jumlah'] ?? 0)
            );


            $totalPenerima += $jumlah;


            /*
             * Normalisasi kategori.
             */

            $kategori = strtolower(
                trim(
                    (string) ($item['kategori'] ?? '')
                )
            );


            if (
                str_contains(
                    $kategori,
                    'disabilitas'
                )
            ) {

                $kategoriPenerima[
                    'Penyandang Disabilitas'
                ] += $jumlah;

            } elseif (
                str_contains(
                    $kategori,
                    'lansia'
                )
            ) {

                $kategoriPenerima[
                    'Lansia'
                ] += $jumlah;

            } elseif (
                str_contains(
                    $kategori,
                    'anak'
                )
            ) {

                $kategoriPenerima[
                    'Anak'
                ] += $jumlah;

            } elseif (
                str_contains(
                    $kategori,
                    'keluarga'
                ) ||
                str_contains(
                    $kategori,
                    'penerima manfaat'
                )
            ) {

                $kategoriPenerima[
                    'Keluarga Penerima Manfaat'
                ] += $jumlah;

            } else {

                $kategoriPenerima[
                    'Lainnya'
                ] += $jumlah;
            }
        }


        /*
         * =========================================================
         * 14. SKM
         * =========================================================
         *
         * BAGIAN SKM TIDAK DIUBAH.
         * Tetap memakai logic yang sudah terbukti
         * sesuai database pada pengujian sebelumnya.
         */

        $rataIKM           = 0;
        $totalRespondenSKM = 0;
        $mutuSKM           = 'E - Sangat Tidak Baik';
        $periodeSKM        = (string) $tahun;

        $skmTerpilih = [];


        foreach ($semuaSKM as $item) {

            if (
                isset($item['periode_tahun']) &&
                (int) $item['periode_tahun'] === $tahun
            ) {

                $skmTerpilih[] = $item;
            }
        }


        /*
         * Urutkan berdasarkan bulan terbaru.
         */

        usort(
            $skmTerpilih,
            static function ($a, $b) {

                return (int) (
                    $b['periode_bulan'] ?? 0
                ) <=> (int) (
                    $a['periode_bulan'] ?? 0
                );
            }
        );


       if (!empty($skmTerpilih)) {

    /*
     * DATA PERTAMA = DATA SKM TERBARU
     * karena sebelumnya sudah diurutkan
     * berdasarkan periode_bulan DESC
     */
    $skmTerbaru = $skmTerpilih[0];

    // =====================================================
    // IKM = NILAI DARI SURVEI TERBARU
    // =====================================================
    $rataIKM = (float) (
        $skmTerbaru['nilai_ikm'] ?? 0
    );

    $rataIKM = round(
        $rataIKM,
        2
    );

    // =====================================================
    // RESPONDEN
    // Tetap menjumlahkan seluruh responden
    // pada tahun yang dipilih.
    // =====================================================
    $totalRespondenSKM = 0;

    foreach ($skmTerpilih as $item) {

        $totalRespondenSKM += max(
            0,
            (int) (
                $item['jumlah_responden'] ?? 0
            )
        );
    }

    // =====================================================
    // PERIODE = SURVEI TERBARU
    // =====================================================
    $bulanTerbaru = (int) (
        $skmTerbaru['periode_bulan'] ?? 0
    );

    if (
        $bulanTerbaru >= 1 &&
        $bulanTerbaru <= 12
    ) {
        $periodeSKM =
            $namaBulan[$bulanTerbaru]
            . ' '
            . $tahun;
    }
}


        /*
         * =========================================================
         * 15. MUTU SKM
         * =========================================================
         */

        if ($rataIKM >= 88.31) {

            $mutuSKM = 'A - Sangat Baik';

        } elseif ($rataIKM >= 76.61) {

            $mutuSKM = 'B - Baik';

        } elseif ($rataIKM >= 65.00) {

            $mutuSKM = 'C - Kurang Baik';

        } elseif ($rataIKM >= 25.00) {

            $mutuSKM = 'D - Tidak Baik';

        } else {

            $mutuSKM = 'E - Sangat Tidak Baik';
        }


        /*
         * =========================================================
         * 16. DATA KE VIEW
         * =========================================================
         */

        $data = [

            /*
             * FILTER TAHUN
             */

            'tahun'         => $tahun,
            'tahunTersedia' => $tahunTersedia,


            /*
             * DATA PELAYANAN
             */

            'totalLayanan'   => $totalLayanan,
            'layananSelesai' => $layananSelesai,
            'layananProses'  => $layananProses,
            'layananBelum'   => $layananBelum,

            'capaianLayanan' => $capaianLayanan,


            /*
             * GRAFIK BULAN
             */

            'grafikBulan' => array_values(
                $grafikBulan
            ),


            /*
             * BIDANG
             */

            'bidang' => $bidang,


            /*
             * LAYANAN UNGGULAN
             */

            'layananUnggulan' => $layananUnggulan,


            /*
             * PENERIMA MANFAAT
             */

            'totalPenerima'    => $totalPenerima,
            'kategoriPenerima' => $kategoriPenerima,


            /*
             * KECAMATAN
             */

            'topKecamatan' => $topKecamatan,


            /*
             * SKM
             */

            'rataIKM'           => $rataIKM,
            'totalRespondenSKM' => $totalRespondenSKM,
            'mutuSKM'           => $mutuSKM,
            'periodeSKM'        => $periodeSKM,
        ];


        /*
         * =========================================================
         * 17. KIRIM KE VIEW
         * =========================================================
         */

        return view(
            'admin/dashboard_statistik',
            $data
        );
    }


    /*
     * =============================================================
     * NORMALISASI BIDANG
     * =============================================================
     *
     * Mengubah berbagai variasi penulisan menjadi
     * nama bidang resmi.
     *
     * =============================================================
     */

    private function normalizeBidang($bidang): ?string
    {
        $nilai = strtolower(
            trim(
                (string) $bidang
            )
        );


        /*
         * Hilangkan spasi berlebihan.
         */

        $nilai = preg_replace(
            '/\s+/',
            ' ',
            $nilai
        );


        /*
         * Mapping bidang.
         */

        $mapping = [

            'perlindungan dan jaminan sosial'
                => 'Perlindungan dan jaminan sosial',

            'pemberdayaan dan rehabilitasi sosial'
                => 'Pemberdayaan dan rehabilitasi sosial',

            'pemberdayaan perempuan dan perlindungan anak'
                => 'Pemberdayaan perempuan dan perlindungan anak',

            'pengendalian penduduk dan keluarga berencana'
                => 'Pengendalian penduduk dan keluarga berencana',
        ];


        return $mapping[$nilai] ?? null;
    }


    /*
     * =============================================================
     * PARSE PERIODE DATA PELAYANAN
     * =============================================================
     *
     * Mendukung:
     *
     * Juli 2026
     * Juli-2026
     * Juli/2026
     * 07/2026
     * 07-2026
     * 2026-07
     *
     * =============================================================
     */

    private function parsePeriode($periode): array
    {
        $periode = trim(
            strtolower(
                (string) $periode
            )
        );


        $hasil = [
            'bulan' => null,
            'tahun' => null,
        ];


        /*
         * Periode kosong.
         */

        if ($periode === '') {
            return $hasil;
        }


        /*
         * =========================================================
         * TAHUN 4 DIGIT
         * =========================================================
         */

        if (
            preg_match(
                '/\b(19|20)\d{2}\b/',
                $periode,
                $matches
            )
        ) {

            $hasil['tahun'] = (int) $matches[0];
        }


        /*
         * =========================================================
         * FORMAT:
         *
         * 07/2026
         * 07-2026
         * =========================================================
         */

        if (
            preg_match(
                '/\b(0?[1-9]|1[0-2])[\s\/\-](19|20)\d{2}\b/',
                $periode,
                $matches
            )
        ) {

            $hasil['bulan'] = (int) $matches[1];

            return $hasil;
        }


        /*
         * =========================================================
         * FORMAT:
         *
         * 2026-07
         * 2026/07
         * =========================================================
         */

        if (
            preg_match(
                '/\b(19|20)\d{2}[\s\/\-](0?[1-9]|1[0-2])\b/',
                $periode,
                $matches
            )
        ) {

            if (
                preg_match(
                    '/\b(19|20)\d{2}[\s\/\-](0?[1-9]|1[0-2])\b/',
                    $periode,
                    $m
                )
            ) {

                $hasil['bulan'] = (int) $m[2];
            }


            return $hasil;
        }


        /*
         * =========================================================
         * NAMA BULAN INDONESIA
         * =========================================================
         */

        $bulanMap = [

            'januari'   => 1,
            'februari'  => 2,
            'maret'     => 3,
            'april'     => 4,
            'mei'       => 5,
            'juni'      => 6,
            'juli'      => 7,
            'agustus'   => 8,
            'september' => 9,
            'oktober'   => 10,
            'november'  => 11,
            'desember'  => 12,
        ];


        foreach ($bulanMap as $nama => $nomor) {

            if (
                str_contains(
                    $periode,
                    $nama
                )
            ) {

                $hasil['bulan'] = $nomor;

                break;
            }
        }


        return $hasil;
    }
}