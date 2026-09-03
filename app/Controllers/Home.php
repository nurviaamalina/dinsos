<?php

namespace App\Controllers;
use App\Models\BeritaModel;
use App\Models\ProfilAnggotaModel;

use App\Models\BidangModel;

use App\Models\KegiatanModel;

class Home extends BaseController
{
      protected $beritaModel;
      protected $anggotaModel;

       public function __construct()
    {
        $this->beritaModel = new BeritaModel();
        $this->anggotaModel = new ProfilAnggotaModel();
        $this->kegiatanModel = new KegiatanModel();
    } 
    public function index()
    {
        // Ambil berita yang sudah dipublikasikan
        $berita = $this->beritaModel
            ->where('status', 'publik')
            ->orderBy('tanggal', 'DESC')
            ->findAll(3);

        
        $anggota = $this->anggotaModel
            ->orderBy('id', 'ASC')
            ->findAll();

        $bidangModel = new BidangModel();
    


        
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


            $item['thumbnail'] =
                $kegiatan['thumbnail'] ?? null;
        }

        unset($item);


        $data = [

            'berita' => $berita,
            'anggota' => $anggota,

             'bidang' => $bidangModel
                ->where('status', 'Aktif')
                     ->findAll(),

            'tahunKegiatan' => $tahunKegiatan,
        ];

        return view('home', $data);
    }
    

}