<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KegiatanModel;
use App\Models\FotoKegiatanModel;

class Kegiatan extends BaseController
{
    protected $kegiatanModel;
    protected $fotoKegiatanModel;

    public function __construct()
    {
        $this->kegiatanModel = new KegiatanModel();
        $this->fotoKegiatanModel = new FotoKegiatanModel();
    }


    // =====================================================
    // HALAMAN UTAMA KEGIATAN
    // =====================================================

    public function index()
    {
        $data = [

            'title' => 'Kegiatan',

            'kegiatan' => $this->kegiatanModel
                ->orderBy('tanggal', 'DESC')
                ->findAll(),

        ];

        return view(
            'Kegiatan/index',
            $data
        );
    }


    // =====================================================
    // KEGIATAN BERDASARKAN TAHUN
    // =====================================================

    public function tahun($tahun)
    {
        // Pastikan tahun berupa angka
        if (!is_numeric($tahun)) {

            return redirect()
                ->to(base_url('kegiatan'))
                ->with(
                    'error',
                    'Tahun kegiatan tidak valid.'
                );
        }


        // Ambil kegiatan berdasarkan tahun
        $kegiatan = $this->kegiatanModel
            ->where('tahun', $tahun)
            ->orderBy('tanggal', 'DESC')
            ->paginate(6);


        $data = [

            'title' => 'Kegiatan Tahun ' . $tahun,

            'tahun' => $tahun,

            'kegiatan' => $kegiatan,

            'pager' => $this->kegiatanModel->pager,

        ];


        return view(
            'Kegiatan/tahun',
            $data
        );
    }


    // =====================================================
    // DETAIL KEGIATAN
    // =====================================================

    public function detail($slug)
    {
        $kegiatan = $this->kegiatanModel
            ->where('slug', $slug)
            ->first();


        if (!$kegiatan) {

            return redirect()
                ->to(base_url('kegiatan'))
                ->with(
                    'error',
                    'Data kegiatan tidak ditemukan.'
                );
        }


        $foto = $this->fotoKegiatanModel
            ->where(
                'kegiatan_id',
                $kegiatan['id']
            )
            ->findAll();


        $data = [

            'title' =>
                $kegiatan['judul'],

            'kegiatan' =>
                $kegiatan,

            'foto' =>
                $foto,

        ];


        return view(
            'Kegiatan/detail',
            $data
        );
    }
}