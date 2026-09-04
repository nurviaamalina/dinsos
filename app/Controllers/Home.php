<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\ProfilAnggotaModel;
use App\Models\LayananModel;
use App\Models\BidangModel;
use App\Models\KegiatanModel;

class Home extends BaseController
{
    protected $beritaModel;
    protected $anggotaModel;
    protected $kegiatanModel;
    protected $layananModel;

    public function __construct()
    {
        $this->beritaModel   = new BeritaModel();
        $this->anggotaModel  = new ProfilAnggotaModel();
        $this->kegiatanModel = new KegiatanModel();
        $this->layananModel  = new LayananModel();
    }

    public function index()
    {
        // =====================================================
        // BERITA
        // =====================================================

        $berita = $this->beritaModel
            ->where('status', 'publik')
            ->orderBy('tanggal', 'DESC')
            ->findAll(3);


        // =====================================================
        // ANGGOTA
        // =====================================================

        $anggota = $this->anggotaModel
            ->orderBy('id', 'ASC')
            ->findAll();


        // =====================================================
        // BIDANG
        // =====================================================

        $bidangModel = new BidangModel();

        $bidang = $bidangModel
            ->where('status', 'Aktif')
            ->findAll();


        // =====================================================
        // LAYANAN
        // HANYA YANG AKTIF, MAKSIMAL 4
        // =====================================================

        $layanan = $this->layananModel
    ->where('status_layanan', 'Aktif')
    ->orderBy('id', 'DESC')
    ->findAll(4);

    $layanan = array_reverse($layanan);


        // =====================================================
        // TAHUN KEGIATAN
        // =====================================================

        $tahunKegiatan = $this->kegiatanModel
            ->select('tahun')
            ->distinct()
            ->where('tahun IS NOT NULL')
            ->orderBy('tahun', 'DESC')
            ->findAll();


        // =====================================================
        // AMBIL THUMBNAIL SETIAP TAHUN
        // =====================================================

        foreach ($tahunKegiatan as &$item) {

            $kegiatan = $this->kegiatanModel
                ->where('tahun', $item['tahun'])
                ->orderBy('tanggal', 'DESC')
                ->first();

            $item['thumbnail'] = $kegiatan['thumbnail'] ?? null;
        }

        unset($item);


        // =====================================================
        // DATA UNTUK VIEW HOME
        // =====================================================

        $data = [

            'berita' => $berita,

            'anggota' => $anggota,

            'bidang' => $bidang,

            'layanan' => $layanan,

            'tahunKegiatan' => $tahunKegiatan,

        ];


        return view('home', $data);
    }
}