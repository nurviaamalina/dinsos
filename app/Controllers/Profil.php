<?php

namespace App\Controllers;

use App\Models\ProfilModel;

class Profil extends BaseController
{
    protected $profilModel;

    public function __construct()
    {
        $this->profilModel = new ProfilModel();
    }

    public function index()
    {
        // Ambil data profil pertama
        $profil = $this->profilModel->first();

        $data = [
            'title'  => 'Profil - Dinas Sosial PPKB Banyuwangi',
            'profil' => $profil,
        ];

        return view('profil', $data);
    }
}