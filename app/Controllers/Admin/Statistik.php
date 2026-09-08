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
        $tahunSekarang = (int) date('Y');

        $tahunRequest = $this->request->getGet('tahun');
        $tahunRequest = is_numeric($tahunRequest)
            ? (int) $tahunRequest
            : $tahunSekarang;

        /*
         * =========================================================
         * AMBIL DATA
         * =========================================================
         */
        $semuaLayanan  = $this->datalayananModel->findAll();
        $semuaPenerima = $this->penerimaModel->findAll();
        $semuaSKM      = $this->skmModel->findAll();

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
         * DAFTAR TAHUN
         * =========================================================
         */
        $tahunTersedia = [$tahunSekarang];

        foreach ($semuaLayanan as $item) {
            $periodeInfo = $this->parsePeriode($item['periode'] ?? '');

            if ($periodeInfo['tahun'] !== null) {
                $tahunTersedia[] = $periodeInfo['tahun'];
            }
        }

        foreach ($semuaPenerima as $item) {
            if (
                isset($item['periode_tahun']) &&
                is_numeric($item['periode_tahun'])
            ) {
                $tahunTersedia[] = (int) $item['periode_tahun'];
            }
        }

        foreach ($semuaSKM as $item) {
            if (
                isset($item['periode_tahun']) &&
                is_numeric($item['periode_tahun'])
            ) {
                $tahunTersedia[] = (int) $item['periode_tahun'];
            }
        }

        $tahunTersedia = array_values(
            array_unique($tahunTersedia)
        );

        rsort($tahunTersedia);

        /*
         * Kalau tahun yang diminta tidak tersedia,
         * kembali ke tahun sekarang.
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
         * VARIABEL STATISTIK PELAYANAN
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
         * Grafik SELALU 12 bulan untuk tahun terpilih.
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
         * PROSES DATA PELAYANAN
         * =========================================================
         */
        foreach ($semuaLayanan as $item) {
            $periodeInfo = $this->parsePeriode(
                $item['periode'] ?? ''
            );

            $tahunData = $periodeInfo['tahun'];
            $bulanData = $periodeInfo['bulan'];

            if ($tahunData === null || $tahunData !== $tahun) {
                continue;
            }

            $jumlah = max(
                0,
                (int) ($item['jumlah'] ?? 0)
            );

            $selesai = max(
                0,
                (int) ($item['selesai'] ?? 0)
            );

            $proses = max(
                0,
                (int) ($item['proses'] ?? 0)
            );

            /*
             * Jangan biarkan selesai + proses melebihi jumlah.
             * Ini mencegah angka dashboard menjadi negatif/tidak logis.
             */
            if ($selesai > $jumlah) {
                $selesai = $jumlah;
            }

            $sisaSetelahSelesai = $jumlah - $selesai;

            if ($proses > $sisaSetelahSelesai) {
                $proses = $sisaSetelahSelesai;
            }

            $belum = $jumlah - $selesai - $proses;

            $totalLayanan   += $jumlah;
            $layananSelesai += $selesai;
            $layananProses  += $proses;
            $layananBelum   += $belum;

            /*
             * Grafik bulanan.
             */
            if ($bulanData !== null && isset($grafikBulan[$bulanData])) {
                $grafikBulan[$bulanData]['permohonan'] += $jumlah;
                $grafikBulan[$bulanData]['selesai']    += $selesai;
            }

            $bidang = trim(
                (string) ($item['bidang'] ?? '')
            );

            $bidang = $bidang !== ''
                ? $bidang
                : 'Tidak Diketahui';

            if (!isset($bidangData[$bidang])) {
                $bidangData[$bidang] = [
                    'nama'    => $bidang,
                    'jumlah'  => 0,
                    'selesai' => 0,
                    'proses'  => 0,
                    'belum'   => 0,
                ];
            }

            $bidangData[$bidang]['jumlah']  += $jumlah;
            $bidangData[$bidang]['selesai'] += $selesai;
            $bidangData[$bidang]['proses']  += $proses;
            $bidangData[$bidang]['belum']   += $belum;

            $layanan = trim(
                (string) ($item['layanan'] ?? '')
            );

            $layanan = $layanan !== ''
                ? $layanan
                : 'Tidak Diketahui';

            if (!isset($layananData[$layanan])) {
                $layananData[$layanan] = [
                    'nama'    => $layanan,
                    'jumlah'  => 0,
                    'selesai' => 0,
                    'proses'  => 0,
                    'belum'   => 0,
                ];
            }

            $layananData[$layanan]['jumlah']  += $jumlah;
            $layananData[$layanan]['selesai'] += $selesai;
            $layananData[$layanan]['proses']  += $proses;
            $layananData[$layanan]['belum']   += $belum;

            $kecamatan = trim(
                (string) ($item['kecamatan'] ?? '')
            );

            $kecamatan = $kecamatan !== ''
                ? $kecamatan
                : 'Tidak Diketahui';

            if (!isset($kecamatanData[$kecamatan])) {
                $kecamatanData[$kecamatan] = [
                    'nama'    => $kecamatan,
                    'jumlah'  => 0,
                    'selesai' => 0,
                    'proses'  => 0,
                    'belum'   => 0,
                ];
            }

            $kecamatanData[$kecamatan]['jumlah']  += $jumlah;
            $kecamatanData[$kecamatan]['selesai'] += $selesai;
            $kecamatanData[$kecamatan]['proses']  += $proses;
            $kecamatanData[$kecamatan]['belum']   += $belum;
        }

        /*
         * =========================================================
         * CAPAIAN KESELURUHAN
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
         * BIDANG
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

        usort(
            $bidang,
            static fn($a, $b) =>
                $b['capaian'] <=> $a['capaian']
        );

        /*
         * =========================================================
         * LAYANAN UNGGULAN
         * HANYA BERDASARKAN SELESAI / JUMLAH
         * =========================================================
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

        usort(
            $layananUnggulan,
            static fn($a, $b) =>
                $b['capaian'] <=> $a['capaian']
        );

        $layananUnggulan = array_slice(
            $layananUnggulan,
            0,
            4
        );

        /*
         * =========================================================
         * TOP 5 KECAMATAN
         * =========================================================
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

        usort(
            $kecamatan,
            static fn($a, $b) =>
                $b['capaian'] <=> $a['capaian']
        );

        $topKecamatan = array_slice(
            $kecamatan,
            0,
            5
        );

        /*
         * =========================================================
         * PENERIMA MANFAAT
         * FILTER TAHUN TERPILIH
         * =========================================================
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
            $tahunPenerima = isset($item['periode_tahun'])
                ? (int) $item['periode_tahun']
                : null;

            if ($tahunPenerima !== $tahun) {
                continue;
            }

            $jumlah = max(
                0,
                (int) ($item['jumlah'] ?? 0)
            );

            $totalPenerima += $jumlah;

            $kategori = strtolower(
                trim(
                    (string) ($item['kategori'] ?? '')
                )
            );

            if (
                str_contains($kategori, 'disabilitas')
            ) {
                $kategoriPenerima[
                    'Penyandang Disabilitas'
                ] += $jumlah;
            } elseif (
                str_contains($kategori, 'lansia')
            ) {
                $kategoriPenerima['Lansia'] += $jumlah;
            } elseif (
                str_contains($kategori, 'anak')
            ) {
                $kategoriPenerima['Anak'] += $jumlah;
            } elseif (
                str_contains($kategori, 'keluarga') ||
                str_contains($kategori, 'penerima manfaat')
            ) {
                $kategoriPenerima[
                    'Keluarga Penerima Manfaat'
                ] += $jumlah;
            } else {
                $kategoriPenerima['Lainnya'] += $jumlah;
            }
        }

        /*
         * =========================================================
         * SKM
         * =========================================================
         */
        $rataIKM          = 0;
        $totalRespondenSKM = 0;
        $mutuSKM          = 'E - Sangat Tidak Baik';
        $periodeSKM       = (string) $tahun;

        $skmTerpilih = [];

        foreach ($semuaSKM as $item) {
            if (
                isset($item['periode_tahun']) &&
                (int) $item['periode_tahun'] === $tahun
            ) {
                $skmTerpilih[] = $item;
            }
        }

        usort(
            $skmTerpilih,
            static function ($a, $b) {
                return (int) ($b['periode_bulan'] ?? 0)
                    <=> (int) ($a['periode_bulan'] ?? 0);
            }
        );

        if (!empty($skmTerpilih)) {
            $totalNilaiIKM = 0;
            $jumlahDataSKM = 0;

            foreach ($skmTerpilih as $item) {
                $nilai = (float) ($item['nilai_ikm'] ?? 0);

                if ($nilai > 0) {
                    $totalNilaiIKM += $nilai;
                    $jumlahDataSKM++;
                }

                $totalRespondenSKM += max(
                    0,
                    (int) ($item['jumlah_responden'] ?? 0)
                );
            }

            if ($jumlahDataSKM > 0) {
                $rataIKM = round(
                    $totalNilaiIKM / $jumlahDataSKM,
                    2
                );
            }

            $bulanTerbaru = (int) (
                $skmTerpilih[0]['periode_bulan'] ?? 0
            );

            if ($bulanTerbaru >= 1 && $bulanTerbaru <= 12) {
                $periodeSKM =
                    $namaBulan[$bulanTerbaru]
                    . ' '
                    . $tahun;
            }
        }

        if ($rataIKM >= 88.31) {
            $mutuSKM = 'A - Sangat Baik';
        } elseif ($rataIKM >= 76.61) {
            $mutuSKM = 'B - Baik';
        } elseif ($rataIKM >= 65.00) {
            $mutuSKM = 'C - Kurang Baik';
        } elseif ($rataIKM >= 25.00) {
            $mutuSKM = 'D - Tidak Baik';
        }

        /*
         * =========================================================
         * DATA KE VIEW
         * =========================================================
         */
        $data = [
            'tahun'         => $tahun,
            'tahunTersedia' => $tahunTersedia,

            'totalLayanan'   => $totalLayanan,
            'layananSelesai' => $layananSelesai,
            'layananProses'  => $layananProses,
            'layananBelum'   => $layananBelum,
            'capaianLayanan' => $capaianLayanan,

            'grafikBulan' => array_values($grafikBulan),

            'bidang' => $bidang,

            'layananUnggulan' => $layananUnggulan,

            'totalPenerima'   => $totalPenerima,
            'kategoriPenerima'=> $kategoriPenerima,

            'topKecamatan' => $topKecamatan,

            'rataIKM'           => $rataIKM,
            'totalRespondenSKM' => $totalRespondenSKM,
            'mutuSKM'           => $mutuSKM,
            'periodeSKM'        => $periodeSKM,
        ];

        return view(
            'admin/dashboard_statistik',
            $data
        );
    }

    /*
     * =============================================================
     * PARSE PERIODE DATA PELAYANAN
     *
     * Mendukung:
     * - Juli 2026
     * - Juli-2026
     * - Juli/2026
     * - 07/2026
     * - 07-2026
     * - 2026-07
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

        if ($periode === '') {
            return $hasil;
        }

        /*
         * Tahun 4 digit.
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
         * Format angka:
         * 07/2026
         * 07-2026
         * 2026-07
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

        if (
            preg_match(
                '/\b(19|20)\d{2}[\s\/\-](0?[1-9]|1[0-2])\b/',
                $periode,
                $matches
            )
        ) {
            $hasil['tahun'] = (int) $matches[0]
                ? (int) $matches[0]
                : $hasil['tahun'];

            /*
             * Ambil bagian bulan setelah tahun.
             */
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
         * Nama bulan Indonesia.
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
            if (str_contains($periode, $nama)) {
                $hasil['bulan'] = $nomor;
                break;
            }
        }

        return $hasil;
    }
}
