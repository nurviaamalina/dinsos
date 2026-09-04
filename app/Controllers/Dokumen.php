<?php

namespace App\Controllers;

use App\Models\DokumenModel;

class Dokumen extends BaseController
{
    protected $dokumenModel;

    public function __construct()
    {
        $this->dokumenModel = new DokumenModel();
    }


    // =========================
    // HALAMAN SEMUA DOKUMEN
    // =========================
    public function index()
    {
        $data = [
            'title' => 'Dokumen Resmi',

            'dokumen' => $this->dokumenModel
                ->where('status', 'PUBLISHED')
                ->orderBy('id', 'DESC')
                ->findAll()
        ];

        return view(
            'dokumen/index',
            $data
        );
    }


    // =========================
// DETAIL DOKUMEN
// =========================
public function detail($id)
{
    $dokumen = $this->dokumenModel
        ->select('dokumen.*, kategori_dokumen.nama_kategori, kategori_dokumen.slug')
        ->join(
            'kategori_dokumen',
            'kategori_dokumen.id = dokumen.kategori_id',
            'left'
        )
        ->where('dokumen.id', $id)
        ->where('dokumen.status', 'PUBLISHED')
        ->first();

    if (!$dokumen) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
            'Dokumen tidak ditemukan.'
        );
    }

    // Tambah jumlah dilihat
    $this->dokumenModel
        ->set('dilihat', 'dilihat + 1', false)
        ->where('id', $id)
        ->update();

    // Update nilai untuk halaman yang sedang dibuka
    $dokumen['dilihat'] = (int) $dokumen['dilihat'] + 1;

    return view('dokumen/detail', [
        'title'   => $dokumen['nama_kategori'],
        'dokumen' => $dokumen
    ]);
}

}