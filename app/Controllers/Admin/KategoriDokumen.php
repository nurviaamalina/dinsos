<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KategoriDokumenModel;

class KategoriDokumen extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel =
            new KategoriDokumenModel();
    }


    // ==========================================
    // INDEX
    // ==========================================

    public function index()
    {
        $data = [
            'title' => 'Kategori Dokumen',

            'kategori' =>
                $this->kategoriModel
                    ->orderBy('id', 'DESC')
                    ->findAll()
        ];

        return view(
            'Admin/kategori-dokumen/index',
            $data
        );
    }


    // ==========================================
    // CREATE
    // ==========================================

    public function create()
    {
        $data = [
            'title' =>
                'Tambah Kategori Dokumen'
        ];

        return view(
            'Admin/kategori-dokumen/create',
            $data
        );
    }


    // ==========================================
    // STORE
    // ==========================================

    public function store()
    {
        $rules = [

            'nama_kategori' => [
                'label' =>
                    'Nama Kategori',

                'rules' =>
                    'required|min_length[3]|max_length[100]',

                'errors' => [

                    'required' =>
                        'Nama kategori wajib diisi.',

                    'min_length' =>
                        'Nama kategori minimal 3 karakter.',

                    'max_length' =>
                        'Nama kategori maksimal 100 karakter.'
                ]
            ],


            'slug' => [
                'label' => 'Slug',

                'rules' =>
                    'required|alpha_dash|max_length[100]',

                'errors' => [

                    'required' =>
                        'Slug wajib diisi.',

                    'alpha_dash' =>
                        'Slug hanya boleh menggunakan huruf, angka, tanda - dan _.',

                    'max_length' =>
                        'Slug maksimal 100 karakter.'
                ]
            ],


            'deskripsi' => [
                'label' =>
                    'Deskripsi',

                'rules' =>
                    'permit_empty|max_length[1000]',

                'errors' => [

                    'max_length' =>
                        'Deskripsi maksimal 1000 karakter.'
                ]
            ]

        ];


        if (!$this->validate($rules)) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    $this->validator->getErrors()
                );
        }


        // ======================================
        // CEK SLUG
        // ======================================

        $slug =
            $this->request
                ->getPost('slug');


        $cekSlug =
            $this->kategoriModel
                ->where('slug', $slug)
                ->first();


        if ($cekSlug) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Slug kategori sudah digunakan.'
                );
        }


        // ======================================
        // SIMPAN
        // ======================================

        $this->kategoriModel->insert([

            'nama_kategori' =>
                $this->request
                    ->getPost('nama_kategori'),

            'slug' =>
                $slug,

            'deskripsi' =>
                $this->request
                    ->getPost('deskripsi')

        ]);


        return redirect()
            ->to('/admin/dokumen')
            ->with(
                'success',
                'Kategori dokumen berhasil ditambahkan.'
            );
    }


    // ==========================================
    // DELETE
    // ==========================================

    public function delete($id)
    {
        $kategori =
            $this->kategoriModel
                ->find($id);


        if (!$kategori) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Kategori tidak ditemukan.'
                );
        }


        $this->kategoriModel
            ->delete($id);


        return redirect()
            ->back()
            ->with(
                'success',
                'Kategori berhasil dihapus.'
            );
    }
}