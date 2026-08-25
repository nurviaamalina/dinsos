<?php

namespace App\Controllers;

use App\Models\BeritaModel;

class Berita extends BaseController
{
    protected $beritaModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
    }


    // =====================================================
    // INDEX BERITA
    // =====================================================

    public function index()
    {
        $data = [

            'title' => 'Berita',

            'berita' => $this->beritaModel
                ->where('status', 'publik')
                ->orderBy('tanggal', 'DESC')
                ->paginate(5),

            'pager' => $this->beritaModel->pager,

        ];

        return view(
            'berita/index',
            $data
        );
    }


    // =====================================================
    // DETAIL BERITA
    // =====================================================

   public function detail($slug)
{
    $berita = $this->beritaModel
        ->where('slug', $slug)
        ->where('status', 'publik')
        ->first();

    if (!$berita) {

        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
            'Berita tidak ditemukan.'
        );

    }

    // Tambah views
    $this->beritaModel
        ->set(
            'views',
            ((int) $berita['views']) + 1
        )
        ->where('id', $berita['id'])
        ->update();


    // Update nilai views untuk ditampilkan
    $berita['views'] =
        ((int) $berita['views']) + 1;


    return view(
        'Berita/detailBerita',
        [
            'title'  => $berita['judul'],
            'berita' => $berita
        ]
    );
}
}