<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DatalayananModel;

class Datalayanan extends BaseController
{
    protected $datalayananModel;

    public function __construct()
    {
        $this->datalayananModel = new DatalayananModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $keyword = $this->request->getGet('search');
        
        if ($keyword) {
            $data['layanan'] = $this->datalayananModel->searchData($keyword);
        } else {
            $data['layanan'] = $this->datalayananModel->getAllData();
        }
        
        $data['title'] = 'Data Pelayanan';
        $data['statistik'] = $this->datalayananModel->getStatistik();
        $data['total_data'] = $this->datalayananModel->getTotalData();
        $data['search'] = $keyword;

        return view('admin/datalayanan/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Data Pelayanan';
        return view('admin/datalayanan/create', $data);
    }

    public function store()
    {
        $rules = [
            'pendaftar' => 'required|max_length[100]',
            'tanggal' => 'required|valid_date',
            'status' => 'required|max_length[50]',
            'jumlah' => 'required|numeric|greater_than[0]',
            'jenis_kendaraan' => 'permit_empty|max_length[50]',
            'merek_kendaraan' => 'permit_empty|max_length[50]',
            'warna_kendaraan' => 'permit_empty|max_length[30]',
            'lokasi_kendaraan' => 'permit_empty|max_length[100]',
            'kategori_kendaraan' => 'permit_empty|max_length[50]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'pendaftar' => $this->request->getPost('pendaftar'),
            'tanggal' => $this->request->getPost('tanggal'),
            'status' => $this->request->getPost('status'),
            'jumlah' => (int) $this->request->getPost('jumlah'),
            'jenis_kendaraan' => $this->request->getPost('jenis_kendaraan'),
            'merek_kendaraan' => $this->request->getPost('merek_kendaraan'),
            'warna_kendaraan' => $this->request->getPost('warna_kendaraan'),
            'lokasi_kendaraan' => $this->request->getPost('lokasi_kendaraan'),
            'kategori_kendaraan' => $this->request->getPost('kategori_kendaraan')
        ];

        // Hapus data kosong untuk field yang tidak diisi
        foreach ($data as $key => $value) {
            if ($value === '' || $value === null) {
                unset($data[$key]);
            }
        }

        $this->datalayananModel->insert($data);
        session()->setFlashdata('success', 'Data pelayanan berhasil ditambahkan!');
        
        return redirect()->to('/admin/datalayanan');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Pelayanan';
        $data['layanan'] = $this->datalayananModel->find($id);
        
        if (empty($data['layanan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }

        return view('admin/datalayanan/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'pendaftar' => 'required|max_length[100]',
            'tanggal' => 'required|valid_date',
            'status' => 'required|max_length[50]',
            'jumlah' => 'required|numeric|greater_than[0]',
            'jenis_kendaraan' => 'permit_empty|max_length[50]',
            'merek_kendaraan' => 'permit_empty|max_length[50]',
            'warna_kendaraan' => 'permit_empty|max_length[30]',
            'lokasi_kendaraan' => 'permit_empty|max_length[100]',
            'kategori_kendaraan' => 'permit_empty|max_length[50]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'pendaftar' => $this->request->getPost('pendaftar'),
            'tanggal' => $this->request->getPost('tanggal'),
            'status' => $this->request->getPost('status'),
            'jumlah' => (int) $this->request->getPost('jumlah'),
            'jenis_kendaraan' => $this->request->getPost('jenis_kendaraan'),
            'merek_kendaraan' => $this->request->getPost('merek_kendaraan'),
            'warna_kendaraan' => $this->request->getPost('warna_kendaraan'),
            'lokasi_kendaraan' => $this->request->getPost('lokasi_kendaraan'),
            'kategori_kendaraan' => $this->request->getPost('kategori_kendaraan')
        ];

        // Hapus data kosong untuk field yang tidak diisi
        foreach ($data as $key => $value) {
            if ($value === '' || $value === null) {
                unset($data[$key]);
            }
        }

        $this->datalayananModel->update($id, $data);
        session()->setFlashdata('success', 'Data pelayanan berhasil diperbarui!');
        
        return redirect()->to('/admin/datalayanan');
    }

    public function delete($id)
    {
        $this->datalayananModel->delete($id);
        session()->setFlashdata('success', 'Data pelayanan berhasil dihapus!');
        
        return redirect()->to('/admin/datalayanan');
    }

    public function export()
    {
        $data = $this->datalayananModel->getDataForExport();
        
        $filename = 'data_pelayanan_' . date('Y-m-d') . '.csv';
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);
        
        $output = fopen('php://output', 'w');
        // Tambahkan BOM untuk UTF-8
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($output, ['No', 'Pendaftar', 'Tanggal', 'Status', 'Jumlah', 'Jenis Kendaraan', 'Merek', 'Warna', 'Lokasi', 'Kategori']);
        
        $no = 1;
        foreach ($data as $row) {
            fputcsv($output, [
                $no++,
                $row->pendaftar,
                $row->tanggal,
                $row->status,
                $row->jumlah,
                $row->jenis_kendaraan ?? '',
                $row->merek_kendaraan ?? '',
                $row->warna_kendaraan ?? '',
                $row->lokasi_kendaraan ?? '',
                $row->kategori_kendaraan ?? ''
            ]);
        }
        
        fclose($output);
        exit;
    }

    public function import()
    {
        $data['title'] = 'Import Data Pelayanan';
        return view('admin/datalayanan/import', $data);
    }

    public function importProcess()
    {
        $file = $this->request->getFile('file_import');
        
        if (!$file->isValid()) {
            session()->setFlashdata('error', 'File tidak valid!');
            return redirect()->back();
        }

        // Cek ekstensi file
        $ext = $file->getExtension();
        if (!in_array($ext, ['csv', 'CSV'])) {
            session()->setFlashdata('error', 'File harus berformat CSV!');
            return redirect()->back();
        }

        $filePath = $file->getTempName();
        $handle = fopen($filePath, 'r');
        
        // Lewati BOM jika ada
        $bom = fread($handle, 3);
        if ($bom !== chr(0xEF).chr(0xBB).chr(0xBF)) {
            rewind($handle);
        }
        
        $data = [];
        $row = 0;
        while (($dataRow = fgetcsv($handle, 1000, ',')) !== FALSE) {
            if ($row > 0) {
                // Validasi data minimal
                if (!empty($dataRow[1] ?? '')) {
                    $data[] = [
                        'pendaftar' => trim($dataRow[1] ?? ''),
                        'tanggal' => !empty($dataRow[2]) ? date('Y-m-d', strtotime($dataRow[2])) : date('Y-m-d'),
                        'status' => trim($dataRow[3] ?? 'Pending'),
                        'jumlah' => (int) ($dataRow[4] ?? 0),
                        'jenis_kendaraan' => trim($dataRow[5] ?? ''),
                        'merek_kendaraan' => trim($dataRow[6] ?? ''),
                        'warna_kendaraan' => trim($dataRow[7] ?? ''),
                        'lokasi_kendaraan' => trim($dataRow[8] ?? ''),
                        'kategori_kendaraan' => trim($dataRow[9] ?? '')
                    ];
                }
            }
            $row++;
        }
        fclose($handle);

        if (!empty($data)) {
            $this->datalayananModel->insertBatch($data);
            session()->setFlashdata('success', 'Berhasil import ' . count($data) . ' data!');
        } else {
            session()->setFlashdata('error', 'Tidak ada data yang diimport!');
        }

        return redirect()->to('/admin/datalayanan');
    }

    public function downloadTemplate()
    {
        $filename = 'template_import_pelayanan.csv';
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);
        
        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        
        // Header template
        fputcsv($output, ['No', 'Pendaftar', 'Tanggal', 'Status', 'Jumlah', 'Jenis Kendaraan', 'Merek', 'Warna', 'Lokasi', 'Kategori']);
        
        // Contoh data
        fputcsv($output, ['1', 'Nama Pendaftar', '2026-01-01', 'Pending', '100', 'Mobil', 'Toyota', 'Merah', 'Jakarta', 'SUV']);
        fputcsv($output, ['2', 'Contoh Lain', '2026-01-02', 'Proses', '200', 'Motor', 'Honda', 'Hitam', 'Bandung', '']);
        
        fclose($output);
        exit;
    }
}