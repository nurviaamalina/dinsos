<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\BidangDetailModel;

class Bidang extends BaseController
{
    protected $bidangModel;


    public function __construct()
    {
        $this->bidangModel = new BidangModel();
    }


    // =====================================================
    // INDEX
    // =====================================================

    public function index()
    {
        $keyword = $this->request->getGet('keyword');


        $builder = $this->bidangModel;


        if (!empty($keyword)) {

            $builder->like(
                'nama_bidang',
                $keyword
            );

        }


        $data = [

            'title' => 'Data Bidang',

            'bidang' => $builder
                ->orderBy('id', 'ASC')
                ->paginate(10),

            'pager' => $this->bidangModel->pager,

            'keyword' => $keyword,

        ];


        return view(
            'admin/bidang/index',
            $data
        );
    }


    // =====================================================
    // CREATE
    // =====================================================

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Bidang',
        ];


        return view(
            'admin/bidang/create',
            $data
        );
    }


    // =====================================================
    // STORE
    // =====================================================

    public function store()
    {
        $rules = [

            'nama_bidang' => [
                'label' => 'Nama Bidang',
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


        $this->bidangModel->insert([

            'nama_bidang' => $this->request
                ->getPost('nama_bidang'),

            'status' => $this->request
                ->getPost('status'),

        ]);


        return redirect()
            ->to(base_url('admin/bidang'))
            ->with(
                'success',
                'Data bidang berhasil ditambahkan.'
            );
    }


    // =====================================================
    // EDIT
    // =====================================================

    public function edit($id)
    {
        $bidang = $this->bidangModel->find($id);


        if (!$bidang) {

            throw \CodeIgniter\Exceptions\PageNotFoundException
                ::forPageNotFound();

        }


        $data = [

            'title' => 'Edit Data Bidang',

            'bidang' => $bidang,

        ];


        return view(
            'admin/bidang/edit',
            $data
        );
    }


    // =====================================================
    // UPDATE
    // =====================================================

    public function update($id)
    {
        $bidang = $this->bidangModel->find($id);


        if (!$bidang) {

            throw \CodeIgniter\Exceptions\PageNotFoundException
                ::forPageNotFound();

        }


        $rules = [

            'nama_bidang' => [
                'label' => 'Nama Bidang',
                'rules' => 'required|min_length[3]',
            ],

            'status' => [
                'label' => 'Status',
                'rules' => 'required|in_list[aktif,tidak_aktif]',
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


        $this->bidangModel->update(
            $id,
            [

                'nama_bidang' => $this->request
                    ->getPost('nama_bidang'),

                'status' => $this->request
                    ->getPost('status'),

            ]
        );


        return redirect()
            ->to(base_url('admin/bidang'))
            ->with(
                'success',
                'Data bidang berhasil diperbarui.'
            );
    }


    // =====================================================
    // DELETE
    // =====================================================

    public function delete($id)
    {
        $bidang = $this->bidangModel->find($id);


        if (!$bidang) {

            throw \CodeIgniter\Exceptions\PageNotFoundException
                ::forPageNotFound();

        }


        $this->bidangModel->delete($id);


        return redirect()
            ->to(base_url('admin/bidang'))
            ->with(
                'success',
                'Data bidang berhasil dihapus.'
            );
    }

    public function detail($id)
{
    $bidangModel = new BidangModel();
    $detailModel = new BidangDetailModel();

    // Ambil bidang berdasarkan ID
    $bidang = $bidangModel->find($id);

    if (!$bidang) {
        return redirect()->to('/admin/bidang')
            ->with('error', 'Data bidang tidak ditemukan.');
    }

    // Ambil detail berdasarkan id_bidang
    $detail = $detailModel
        ->where('id_bidang', $id)
        ->first();

    $data = [
        'title'  => 'Detail Bidang',
        'bidang' => $bidang,
        'detail' => $detail,
    ];

    return view('Admin/Bidang/detail', $data);
}
}

