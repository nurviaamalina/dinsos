<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KecamatanModel;

class Kecamatan extends BaseController
{
    protected $kecamatanModel;


    public function __construct()
    {
        $this->kecamatanModel = new KecamatanModel();
    }


    // =====================================================
    // INDEX
    // =====================================================

    public function index()
    {
        $keyword = $this->request->getGet('keyword');


        $builder = $this->kecamatanModel;


        if (!empty($keyword)) {

            $builder->like(
                'nama_kecamatan',
                $keyword
            );

        }


        $data = [

            'title' => 'Data Kecamatan',

            'kecamatan' => $builder
                ->orderBy('id', 'ASC')
                ->paginate(10),

            'pager' => $this->kecamatanModel->pager,

            'keyword' => $keyword,

        ];


        return view(
            'admin/kecamatan/index',
            $data
        );
    }


    // =====================================================
    // CREATE
    // =====================================================

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Kecamatan',
        ];


        return view(
            'admin/kecamatan/create',
            $data
        );
    }


    // =====================================================
    // STORE
    // =====================================================

    public function store()
    {
        $rules = [

            'nama_kecamatan' => [
                'label' => 'Nama Kecamatan',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 3 karakter.',
                ],
            ],

            'status' => [
                'label' => 'Status',
                'rules' => 'required|in_list[aktif,tidak_aktif]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list' => '{field} tidak valid.',
                ],
            ],

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


        $this->kecamatanModel->insert([

            'nama_kecamatan' => $this->request
                ->getPost('nama_kecamatan'),

            'status' => $this->request
                ->getPost('status'),

        ]);


        return redirect()
            ->to(base_url('admin/kecamatan'))
            ->with(
                'success',
                'Data kecamatan berhasil ditambahkan.'
            );
    }


    // =====================================================
    // EDIT
    // =====================================================

    public function edit($id)
    {
        $kecamatan = $this->kecamatanModel->find($id);


        if (!$kecamatan) {

            throw \CodeIgniter\Exceptions\PageNotFoundException
                ::forPageNotFound();

        }


        $data = [

            'title' => 'Edit Data Kecamatan',

            'kecamatan' => $kecamatan,

        ];


        return view(
            'admin/kecamatan/edit',
            $data
        );
    }


    // =====================================================
    // UPDATE
    // =====================================================

    public function update($id)
    {
        $kecamatan = $this->kecamatanModel->find($id);


        if (!$kecamatan) {

            throw \CodeIgniter\Exceptions\PageNotFoundException
                ::forPageNotFound();

        }


        $rules = [

            'nama_kecamatan' => [
                'label' => 'Nama Kecamatan',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 3 karakter.',
                ],
            ],

            'status' => [
                'label' => 'Status',
                'rules' => 'required|in_list[aktif,tidak_aktif]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list' => '{field} tidak valid.',
                ],
            ],

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


        $this->kecamatanModel->update(
            $id,
            [

                'nama_kecamatan' => $this->request
                    ->getPost('nama_kecamatan'),

                'status' => $this->request
                    ->getPost('status'),

            ]
        );


        return redirect()
            ->to(base_url('admin/kecamatan'))
            ->with(
                'success',
                'Data kecamatan berhasil diperbarui.'
            );
    }


    // =====================================================
    // DELETE
    // =====================================================

    public function delete($id)
    {
        $kecamatan = $this->kecamatanModel->find($id);


        if (!$kecamatan) {

            throw \CodeIgniter\Exceptions\PageNotFoundException
                ::forPageNotFound();

        }


        $this->kecamatanModel->delete($id);


        return redirect()
            ->to(base_url('admin/kecamatan'))
            ->with(
                'success',
                'Data kecamatan berhasil dihapus.'
            );
    }
}