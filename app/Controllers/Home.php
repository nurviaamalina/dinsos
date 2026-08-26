<?php

namespace App\Controllers;
use App\Models\BeritaModel;
use App\Models\ProfilAnggotaModel;

class Home extends BaseController
{
      protected $beritaModel;
      protected $anggotaModel;

       public function __construct()
    {
        $this->beritaModel = new BeritaModel();
        $this->anggotaModel = new ProfilAnggotaModel();
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


        $data = [

            'berita' => $berita,
            'anggota' => $anggota,
        ];

        return view('home', $data);
    }

}