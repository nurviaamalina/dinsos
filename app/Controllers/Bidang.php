<?php

namespace App\Controllers;

use App\Models\BidangModel;
use App\Models\BidangDetailModel;

class Bidang extends BaseController
{
    protected $bidangModel;
    protected $bidangDetailModel;

    public function __construct()
    {
        $this->bidangModel = new BidangModel();
        $this->bidangDetailModel = new BidangDetailModel();
    }

    public function detail($slug)
    {
        // Ubah slug URL menjadi nama bidang
        $namaBidang = match (strtolower($slug)) {
            'sekretariat' => 'Sekretariat',
            'linjamsos'   => 'Bidang Linjamsos',
            'rehabsos'    => 'Bidang Rehabsos',
            'dayasos'     => 'Bidang Dayasos',
            'ppdkb'       => 'Bidang PPDKB',
            default       => null
        };

        // Jika URL tidak sesuai
        if (!$namaBidang) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Bidang tidak ditemukan.'
            );
        }

        // Ambil data bidang berdasarkan nama_bidang
        $bidang = $this->bidangModel
            ->where('nama_bidang', $namaBidang)
            ->where('status', 'aktif')
            ->first();

        if (!$bidang) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Bidang tidak ditemukan.'
            );
        }

        // Ambil detail bidang berdasarkan id_bidang
        $detail = $this->bidangDetailModel
            ->where('id_bidang', $bidang['id'])
            ->first();

        // Kirim ke view
        $data = [
            'bidang' => $bidang,
            'detail' => $detail
        ];

        return view('bidang', $data);
    }
}