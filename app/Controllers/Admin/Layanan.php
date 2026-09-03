<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LayananModel;
use App\Models\BidangModel;

class Layanan extends BaseController
{
    protected $layananModel;
    protected $bidangModel; 

    public function __construct()
    {
        $this->layananModel = new LayananModel();
         $this->bidangModel = new BidangModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        
        if ($keyword) {
            $this->layananModel->like('nama_layanan', $keyword);
        }

        $data = [
            'title'    => 'Data Layanan',
            'layanan'  => $this->layananModel->paginate(10), // 10 data per halaman
            'pager'    => $this->layananModel->pager,
            'keyword'  => $keyword
        ];

        return view('admin/layanan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Layanan',
            'bidang_list' => $this->bidangModel->where('status', 'aktif')->findAll(),
        ];
        return view('admin/layanan/create', $data);
    }

       public function store()
    {
        // Validasi input
        if (!$this->validate([
            'nama_layanan' => 'required',
            'bidang' => 'required',
            'deskripsi_layanan' => 'permit_empty', 
        ])) {
            return redirect()->to('/admin/layanan/create')->withInput()->with('errors', $this->validator->getErrors());
        }

        // 1. TENTUKAN STATUS BERDASARKAN TOMBOL YANG DITEKAN
        $status = $this->request->getPost('draft') ? 'Nonaktif' : 'Aktif';

        // 2. Upload Dokumen (SOP)
        $fileDokumen = $this->request->getFile('dokumen');
        $namaDokumen = null;

        if ($fileDokumen && $fileDokumen->isValid() && !$fileDokumen->hasMoved()) {
            $uploadPathDokumen = FCPATH . 'uploads/dokumen';
            if (!is_dir($uploadPathDokumen)) {
                mkdir($uploadPathDokumen, 0777, true);
            }

            $namaDokumen = $fileDokumen->getRandomName();
            $fileDokumen->move($uploadPathDokumen, $namaDokumen);
        }

        // 3. Simpan ke Database (GUNAKAN VARIABEL $status)
        $this->layananModel->save([
            'nama_layanan'      => $this->request->getPost('nama_layanan'),
            'bidang'            => $this->request->getPost('bidang'),
            'deskripsi_layanan' => $this->request->getPost('deskripsi_layanan'),
            'standar_layanan'   => $this->request->getPost('standar_layanan'),
            'prosedur_layanan'  => $this->request->getPost('prosedur_layanan'),
            'status_layanan'    => $status, 
            'dokumen'           => $namaDokumen,
        ]);

        return redirect()->to('/admin/layanan')->with('success', 'Data Layanan berhasil ditambahkan.');
    }

    public function update($id)
    {
        // Validasi input
        if (!$this->validate([
            'nama_layanan' => 'required',
            'bidang' => 'required',
            'deskripsi_layanan' => 'permit_empty',
        ])) {
            return redirect()->to('/admin/layanan/edit/' . $id)->withInput()->with('errors', $this->validator->getErrors());
        }

        // 1. TENTUKAN STATUS BERDASARKAN TOMBOL YANG DITEKAN
        $status = $this->request->getPost('draft') ? 'Nonaktif' : 'Aktif';

        $data = [
            'nama_layanan'      => $this->request->getPost('nama_layanan'),
            'bidang'            => $this->request->getPost('bidang'),
            'deskripsi_layanan' => $this->request->getPost('deskripsi_layanan'),
            'standar_layanan'   => $this->request->getPost('standar_layanan'),
            'prosedur_layanan'  => $this->request->getPost('prosedur_layanan'),
            'status_layanan'    => $status, // <-- INI YANG BENAR!
        ];

        // 2. Upload Dokumen Baru (Jika ada file yang di-upload)
        $fileDokumen = $this->request->getFile('dokumen');
        if ($fileDokumen && $fileDokumen->isValid() && !$fileDokumen->hasMoved()) {
            $layananLama = $this->layananModel->find($id);
            $uploadPathDokumen = FCPATH . 'uploads/dokumen';
            
            if ($layananLama['dokumen'] && file_exists($uploadPathDokumen . '/' . $layananLama['dokumen'])) {
                unlink($uploadPathDokumen . '/' . $layananLama['dokumen']);
            }

            if (!is_dir($uploadPathDokumen)) {
                mkdir($uploadPathDokumen, 0777, true);
            }
            $namaDokumen = $fileDokumen->getRandomName();
            $fileDokumen->move($uploadPathDokumen, $namaDokumen);
            
            $data['dokumen'] = $namaDokumen;
        }

        $this->layananModel->update($id, $data);

        return redirect()->to('/admin/layanan')->with('success', 'Data Layanan berhasil diperbarui.');
    }

    public function delete($id)
    {
        // Hapus file dokumen jika ada
        $layanan = $this->layananModel->find($id);
        $uploadPathDokumen = FCPATH . 'uploads/dokumen';
        
        if ($layanan['dokumen'] && file_exists($uploadPathDokumen . '/' . $layanan['dokumen'])) {
            unlink($uploadPathDokumen . '/' . $layanan['dokumen']);
        }

        $this->layananModel->delete($id);

        return redirect()->to('/admin/layanan')->with('success', 'Data Layanan berhasil dihapus.');
    }

    public function toggleStatus($id)
{
    $layanan = $this->layananModel->find($id);
    
    if ($layanan) {
        // Ubah status: Jika Aktif jadi Nonaktif, jika Nonaktif jadi Aktif
        $statusBaru = ($layanan['status_layanan'] === 'Aktif') ? 'Nonaktif' : 'Aktif';
        
        $this->layananModel->update($id, ['status_layanan' => $statusBaru]);
        
        return redirect()->to('/admin/layanan')->with('success', 'Status Layanan berhasil diubah menjadi ' . $statusBaru . '.');
    }

    return redirect()->to('/admin/layanan')->with('error', 'Data layanan tidak ditemukan.');
}
}