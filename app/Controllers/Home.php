<?php

namespace App\Controllers;
use App\Models\BeritaModel;

class Home extends BaseController
{
      protected $beritaModel;

       public function __construct()
    {
        $this->beritaModel = new BeritaModel();
    } 
    public function index()
    {
        // Ambil berita yang sudah dipublikasikan
        $berita = $this->beritaModel
            ->where('status', 'publik')
            ->orderBy('tanggal', 'DESC')
            ->findAll(3);

        $data = [

            'berita' => $berita,

        ];

        return view('home', $data);
    }

}