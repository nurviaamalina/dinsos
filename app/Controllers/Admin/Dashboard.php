<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BeritaModel;
use App\Models\DatalayananModel;
use App\Models\KegiatanModel;

class Dashboard extends BaseController
{
    protected BeritaModel $beritaModel;
    protected KegiatanModel $kegiatanModel;
    protected DatalayananModel $datalayananModel;

    public function __construct()
    {
        $this->beritaModel      = new BeritaModel();
        $this->kegiatanModel    = new KegiatanModel();
        $this->datalayananModel = new DatalayananModel();
    }

    public function index()
    {
        // =========================================================
        // 1. BERITA
        // =========================================================
        $berita = $this->beritaModel
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $berita = array_map(
            static fn($item) => (array) $item,
            $berita
        );

        $totalBerita   = count($berita);
        $beritaTerbaru = array_slice($berita, 0, 3);

        // =========================================================
        // 2. KEGIATAN
        // =========================================================
        $kegiatan = $this->kegiatanModel
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        $kegiatan = array_map(
            static fn($item) => (array) $item,
            $kegiatan
        );

        $totalKegiatan   = count($kegiatan);
        $kegiatanTerbaru = array_slice($kegiatan, 0, 3);

        // =========================================================
        // 3. INSTAGRAM - MASIH HARDCODE
        // =========================================================
        $totalInstagram = 32;

        $instagramTerbaru = [
            [
                'judul'     => 'Caption Instagram',
                'deskripsi' => 'Postingan terbaru ...',
            ],
            [
                'judul'     => 'Caption Instagram',
                'deskripsi' => 'Postingan terbaru ...',
            ],
            [
                'judul'     => 'Caption Instagram',
                'deskripsi' => 'Postingan terbaru ...',
            ],
        ];

        // =========================================================
        // 4. DATA PELAYANAN
        //    Sumber yang sama: tabel datalayanan
        // =========================================================
        $semuaLayanan = $this->datalayananModel->findAll();
        $semuaLayanan = array_map(
            static fn($item) => (array) $item,
            $semuaLayanan
        );

        // =========================================================
        // 5. TENTUKAN TAHUN TERBARU YANG BENAR-BENAR MEMILIKI DATA
        // =========================================================
        $tahunData = [];

        foreach ($semuaLayanan as $item) {
            $periodeInfo = $this->parsePeriode($item['periode'] ?? '');

            $tahun = $periodeInfo['tahun'];

            // Fallback: bila tahun tidak bisa dibaca dari periode,
            // gunakan created_at agar data tetap dapat dipetakan.
            if ($tahun === null && !empty($item['created_at'])) {
                $createdYear = date('Y', strtotime((string) $item['created_at']));
                if (is_numeric($createdYear)) {
                    $tahun = (int) $createdYear;
                }
            }

            if ($tahun !== null) {
                $tahunData[] = $tahun;
            }
        }

        $tahunData = array_values(array_unique($tahunData));
        rsort($tahunData, SORT_NUMERIC);

        $tahunStatistik = !empty($tahunData)
            ? (int) $tahunData[0]
            : (int) date('Y');

        // =========================================================
        // 6. INISIALISASI STATISTIK
        // =========================================================
        $totalPermohonan = 0;
        $totalSelesai    = 0;
        $totalProses     = 0;
        $belumSelesai    = 0;

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

        // Selalu ada 12 bulan agar grafik tidak pernah kosong.
        $grafikBulan = [];

        foreach ($namaBulan as $nomor => $nama) {
            $grafikBulan[$nomor] = [
                'bulan'      => $nama,
                'permohonan' => 0,
                'selesai'    => 0,
            ];
        }

        // =========================================================
        // 7. PROSES DATA PELAYANAN
        // =========================================================
        foreach ($semuaLayanan as $item) {
            $periodeInfo = $this->parsePeriode($item['periode'] ?? '');

            $tahunData = $periodeInfo['tahun'];
            $bulanData = $periodeInfo['bulan'];

            // Fallback tahun dari created_at
            if ($tahunData === null && !empty($item['created_at'])) {
                $createdTimestamp = strtotime((string) $item['created_at']);
                if ($createdTimestamp !== false) {
                    $tahunData = (int) date('Y', $createdTimestamp);
                }
            }

            // Fallback bulan dari created_at jika periode hanya berisi tahun
            if ($bulanData === null && !empty($item['created_at'])) {
                $createdTimestamp = strtotime((string) $item['created_at']);
                if ($createdTimestamp !== false) {
                    $bulanData = (int) date('n', $createdTimestamp);
                }
            }

            if ($tahunData === null || (int) $tahunData !== $tahunStatistik) {
                continue;
            }

            $jumlah  = max(0, (int) ($item['jumlah'] ?? 0));
            $selesai = max(0, (int) ($item['selesai'] ?? 0));
            $proses  = max(0, (int) ($item['proses'] ?? 0));

            // Menjaga data tetap logis.
            if ($selesai > $jumlah) {
                $selesai = $jumlah;
            }

            $sisa = $jumlah - $selesai;

            if ($proses > $sisa) {
                $proses = $sisa;
            }

            // DEFINISI YANG SUDAH DISEPAKATI:
            // Belum Selesai = Proses
            $totalPermohonan += $jumlah;
            $totalSelesai    += $selesai;
            $totalProses     += $proses;
            $belumSelesai    += $proses;

            if ($bulanData !== null && isset($grafikBulan[$bulanData])) {
                $grafikBulan[$bulanData]['permohonan'] += $jumlah;
                $grafikBulan[$bulanData]['selesai']    += $selesai;
            }
        }

        // =========================================================
        // 8. CAPAIAN
        // =========================================================
        $capaianKeseluruhan = $totalPermohonan > 0
            ? round(($totalSelesai / $totalPermohonan) * 100, 2)
            : 0;

        // Nilai maksimum grafik untuk menentukan tinggi batang.
        $chartMax = 0;

        foreach ($grafikBulan as $item) {
            $chartMax = max(
                $chartMax,
                (int) ($item['permohonan'] ?? 0),
                (int) ($item['selesai'] ?? 0)
            );
        }

        // =========================================================
        // 9. DATA VIEW
        // =========================================================
        $data = [
            'tahunStatistik'     => $tahunStatistik,

            'totalBerita'        => $totalBerita,
            'totalKegiatan'      => $totalKegiatan,
            'totalInstagram'     => $totalInstagram,

            'totalPermohonan'    => $totalPermohonan,
            'totalSelesai'       => $totalSelesai,
            'totalProses'        => $totalProses,
            'belumSelesai'       => $belumSelesai,
            'capaianKeseluruhan' => $capaianKeseluruhan,

            'grafikBulan'        => array_values($grafikBulan),
            'chartMax'           => $chartMax,

            'kegiatanTerbaru'    => $kegiatanTerbaru,
            'beritaTerbaru'      => $beritaTerbaru,
            'instagramTerbaru'   => $instagramTerbaru,
        ];

        return view('admin/dashboard', $data);
    }

    /**
     * Parse periode layanan.
     * Mendukung:
     * - Januari 2026
     * - Januari-2026
     * - Januari/2026
     * - 01/2026
     * - 01-2026
     * - 2026-01
     * - 2026/01
     * - 2026
     */
    private function parsePeriode($periode): array
    {
        $periode = trim(strtolower((string) $periode));

        $hasil = [
            'bulan' => null,
            'tahun' => null,
        ];

        if ($periode === '') {
            return $hasil;
        }

        // Tahun 4 digit.
        if (preg_match('/\b(19|20)\d{2}\b/', $periode, $matches)) {
            $hasil['tahun'] = (int) $matches[0];
        }

        // Format angka MM/YYYY, MM-YYYY, MM YYYY.
        if (preg_match('/\b(0?[1-9]|1[0-2])(?:[\s\/\-]+)(19|20)\d{2}\b/', $periode, $matches)) {
            $hasil['bulan'] = (int) $matches[1];
            return $hasil;
        }

        // Format angka YYYY-MM, YYYY/MM, YYYY MM.
        if (preg_match('/\b(19|20)\d{2}(?:[\s\/\-]+)(0?[1-9]|1[0-2])\b/', $periode, $matches)) {
            $hasil['bulan'] = (int) $matches[2];
            return $hasil;
        }

        // Format nama bulan Indonesia.
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
