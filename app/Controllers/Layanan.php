<?php

namespace App\Controllers;

use App\Models\LayananModel;

class Layanan extends BaseController
{
    protected $layananModel;

    public function __construct()
    {
        $this->layananModel = new LayananModel();
    }

    public function index()
    {
        $data = [
            'layanan' => $this->layananModel
                ->where('status_layanan', 'Aktif')
                ->orderBy('id', 'ASC')
                ->findAll()
        ];

        return view('Layanan/layanan', $data);
    }

    public function detail($id)
    {
        $layanan = $this->layananModel
            ->where('id', $id)
            ->where('status_layanan', 'Aktif')
            ->first();

        if (!$layanan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Layanan tidak ditemukan.'
            );
        }

        return view('Layanan/layanan_detail', [
            'layanan' => $layanan
        ]);
    }
}