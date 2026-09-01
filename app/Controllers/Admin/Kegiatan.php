<?php

namespace App\Controllers;

use App\Models\KegiatanModel;
use App\Models\FotoKegiatanModel;

class Kegiatan extends BaseController
{
    protected $kegiatanModel;
    protected $fotoModel;

    public function __construct()
    {
        $this->kegiatanModel = new KegiatanModel();
        $this->fotoModel = new FotoKegiatanModel();
    }


    // =====================================================
    // INDEX
    // =====================================================

    public function index()
    {
        $data = [

            'title' => 'Kegiatan',

            'kegiatan' => $this->kegiatanModel
                ->orderBy('tanggal', 'DESC')
                ->paginate(6),

            'pager' => $this->kegiatanModel->pager,

        ];

        return view(
            'Kegiatan/index',
            $data
        );
    }


    // =====================================================
    // RECAP PER TAHUN
    // =====================================================

    public function tahun($tahun)
    {
        $data = [

            'title' => 'Kegiatan Tahun ' . $tahun,

            'tahun' => $tahun,

            'kegiatan' => $this->kegiatanModel
                ->where('tahun', $tahun)
                ->orderBy('tanggal', 'DESC')
                ->paginate(6),

            'pager' => $this->kegiatanModel->pager,

        ];

        return view(
            'Kegiatan/tahun',
            $data
        );
    }


    // =====================================================
    // DETAIL
    // =====================================================

    public function detail($slug)
    {
        $kegiatan =
            $this->kegiatanModel
                ->where('slug', $slug)
                ->first();


        if (!$kegiatan) {

            return redirect()
                ->to(base_url('kegiatan'))
                ->with(
                    'error',
                    'Kegiatan tidak ditemukan.'
                );
        }


        $foto =
            $this->fotoModel
                ->where(
                    'kegiatan_id',
                    $kegiatan['id']
                )
                ->findAll();


        return view(
            'Kegiatan/detail',
            [
                'title' => $kegiatan['judul'],
                'kegiatan' => $kegiatan,
                'foto' => $foto,
            ]
        );
    }
}