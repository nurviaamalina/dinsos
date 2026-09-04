<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\BidangDetailModel;

class BidangDetail extends BaseController
{
    protected $bidangModel;
    protected $detailModel;

    public function __construct()
    {
        $this->bidangModel = new BidangModel();
        $this->detailModel = new BidangDetailModel();
    }

    /**
     * Menampilkan detail berdasarkan ID bidang
     */
    public function index($id)
    {
        $bidang = $this->bidangModel->find($id);

        if (!$bidang) {
            return redirect()->to('/admin/bidang')
                ->with('error', 'Bidang tidak ditemukan.');
        }

        $detail = $this->detailModel
            ->where('id_bidang', $id)
            ->first();

        $data = [
            'title'  => 'Detail ' . $bidang['nama_bidang'],
            'bidang' => $bidang,
            'detail' => $detail,
        ];

        return view('admin/bidang_detail/index', $data);
    }

    /**
     * Form tambah detail
     */
    public function create($id)
    {
        $bidang = $this->bidangModel->find($id);

        if (!$bidang) {
            return redirect()->to('/admin/bidang')
                ->with('error', 'Bidang tidak ditemukan.');
        }

        // Cek apakah detail sudah ada
        $detail = $this->detailModel
            ->where('id_bidang', $id)
            ->first();

        if ($detail) {
            return redirect()->to('/admin/bidang/detail/' . $id)
                ->with('error', 'Detail bidang sudah tersedia.');
        }

        $data = [
            'title'  => 'Tambah Detail Bidang',
            'bidang' => $bidang,
        ];

        return view('admin/bidang_detail/create', $data);
    }

    /**
     * Simpan detail
     */
    public function store($id)
    {
        $bidang = $this->bidangModel->find($id);

        if (!$bidang) {
            return redirect()->to('/admin/bidang')
                ->with('error', 'Bidang tidak ditemukan.');
        }

        // Pastikan belum ada detail
        $existing = $this->detailModel
            ->where('id_bidang', $id)
            ->first();

        if ($existing) {
            return redirect()->to('/admin/bidang/detail/' . $id)
                ->with('error', 'Detail bidang sudah tersedia.');
        }

        $this->detailModel->insert([
            'id_bidang'       => $id,
            'tentang'         => $this->request->getPost('tentang'),
            'ruang_lingkup'   => $this->request->getPost('ruang_lingkup'),
            'tugas_pokok'     => $this->request->getPost('tugas_pokok'),
            'program_kegiatan'=> $this->request->getPost('program_kegiatan'),
            'telepon'         => $this->request->getPost('telepon'),
            'email'           => $this->request->getPost('email'),
            'alamat'          => $this->request->getPost('alamat'),
        ]);

        return redirect()->to('/admin/bidang/detail/' . $id)
            ->with('success', 'Detail bidang berhasil disimpan.');
    }

    /**
     * Form edit
     */
    public function edit($id)
    {
        $detail = $this->detailModel->find($id);

        if (!$detail) {
            return redirect()->to('/admin/bidang')
                ->with('error', 'Detail bidang tidak ditemukan.');
        }

        $bidang = $this->bidangModel->find($detail['id_bidang']);

        $data = [
            'title'  => 'Edit Detail Bidang',
            'detail' => $detail,
            'bidang' => $bidang,
        ];

        return view('admin/bidang_detail/edit', $data);
    }

    /**
     * Update
     */
    public function update($id)
    {
        $detail = $this->detailModel->find($id);

        if (!$detail) {
            return redirect()->to('/admin/bidang')
                ->with('error', 'Detail bidang tidak ditemukan.');
        }

        $this->detailModel->update($id, [
            'tentang'          => $this->request->getPost('tentang'),
            'ruang_lingkup'    => $this->request->getPost('ruang_lingkup'),
            'tugas_pokok'      => $this->request->getPost('tugas_pokok'),
            'program_kegiatan' => $this->request->getPost('program_kegiatan'),
            'telepon'          => $this->request->getPost('telepon'),
            'email'            => $this->request->getPost('email'),
            'alamat'           => $this->request->getPost('alamat'),
        ]);

        return redirect()->to(
            '/admin/bidang/detail/' . $detail['id_bidang']
        )->with('success', 'Detail bidang berhasil diperbarui.');
    }

    /**
     * Hapus
     */
    public function delete($id)
    {
        $detail = $this->detailModel->find($id);

        if (!$detail) {
            return redirect()->to('/admin/bidang')
                ->with('error', 'Detail bidang tidak ditemukan.');
        }

        $bidangId = $detail['id_bidang'];

        $this->detailModel->delete($id);

        return redirect()->to('/admin/bidang/detail/' . $bidangId)
            ->with('success', 'Detail bidang berhasil dihapus.');
    }
}