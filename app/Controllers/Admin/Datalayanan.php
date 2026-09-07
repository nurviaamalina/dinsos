<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\DatalayananModel;
use App\Models\KecamatanModel;
use App\Models\LayananModel;

class Datalayanan extends BaseController
{
    protected $datalayananModel;
    protected $bidangModel;
    protected $kecamatanModel;
    protected $layananModel;

    public function __construct()
    {
        $this->datalayananModel = new DatalayananModel();
        $this->bidangModel = new BidangModel();
        $this->kecamatanModel = new KecamatanModel();
        $this->layananModel = new LayananModel();
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
        $data = [
            'title' => 'Tambah Data Pelayanan',
            'bidang' => $this->getActiveBidang(),
            'kecamatan' => $this->getActiveKecamatan(),
            'layananMaster' => $this->getActiveLayanan(),
        ];

        return view('admin/datalayanan/create', $data);
    }

    public function store()
    {
        $rules = [
            'periode' => 'required|max_length[50]',
            'layanan' => 'required|max_length[200]',
            'bidang' => 'required|max_length[100]',
            'kecamatan' => 'required|max_length[100]',
            'jumlah' => 'required|numeric|greater_than_equal_to[0]',
            'selesai' => 'permit_empty|numeric|greater_than_equal_to[0]',
            'proses' => 'permit_empty|numeric|greater_than_equal_to[0]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'periode' => $this->request->getPost('periode'),
            'layanan' => $this->request->getPost('layanan'),
            'bidang' => $this->request->getPost('bidang'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'jumlah' => (int) $this->request->getPost('jumlah'),
            'selesai' => (int) $this->request->getPost('selesai'),
            'proses' => (int) $this->request->getPost('proses')
        ];

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

        $data['bidang'] = $this->getActiveBidang($data['layanan']->bidang);
        $data['kecamatan'] = $this->getActiveKecamatan($data['layanan']->kecamatan);
        $data['layananMaster'] = $this->getActiveLayanan($data['layanan']->layanan);

        return view('admin/datalayanan/edit', $data);
    }

    private function getActiveBidang($current = null)
    {
        $builder = $this->bidangModel->where('status', 'aktif');
        $items = $builder->orderBy('nama_bidang', 'ASC')->findAll();

        if ($current && !array_filter($items, static fn ($item) => $item['nama_bidang'] === $current)) {
            $selected = $this->bidangModel->where('nama_bidang', $current)->first();
            if ($selected) {
                array_unshift($items, $selected);
            }
        }

        return $items;
    }

    private function getActiveKecamatan($current = null)
    {
        $builder = $this->kecamatanModel->where('status', 'aktif');
        $items = $builder->orderBy('nama_kecamatan', 'ASC')->findAll();

        if ($current && !array_filter($items, static fn ($item) => $item['nama_kecamatan'] === $current)) {
            $selected = $this->kecamatanModel->where('nama_kecamatan', $current)->first();
            if ($selected) {
                array_unshift($items, $selected);
            }
        }

        return $items;
    }

    private function getActiveLayanan($current = null)
    {
        $items = $this->layananModel
            ->where('status_layanan', 'Aktif')
            ->orderBy('nama_layanan', 'ASC')
            ->findAll();

        if ($current && !array_filter($items, static fn ($item) => $item['nama_layanan'] === $current)) {
            $selected = $this->layananModel->where('nama_layanan', $current)->first();
            if ($selected) {
                array_unshift($items, $selected);
            }
        }

        return $items;
    }

    public function update($id)
    {
        $rules = [
            'periode' => 'required|max_length[50]',
            'layanan' => 'required|max_length[200]',
            'bidang' => 'required|max_length[100]',
            'kecamatan' => 'required|max_length[100]',
            'jumlah' => 'required|numeric|greater_than_equal_to[0]',
            'selesai' => 'permit_empty|numeric|greater_than_equal_to[0]',
            'proses' => 'permit_empty|numeric|greater_than_equal_to[0]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'periode' => $this->request->getPost('periode'),
            'layanan' => $this->request->getPost('layanan'),
            'bidang' => $this->request->getPost('bidang'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'jumlah' => (int) $this->request->getPost('jumlah'),
            'selesai' => (int) $this->request->getPost('selesai'),
            'proses' => (int) $this->request->getPost('proses')
        ];

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
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($output, ['No', 'Periode', 'Layanan', 'Bidang', 'Kecamatan', 'Jumlah', 'Selesai', 'Proses']);
        
        $no = 1;
        foreach ($data as $row) {
            fputcsv($output, [
                $no++,
                $row->periode,
                $row->layanan,
                $row->bidang,
                $row->kecamatan,
                $row->jumlah,
                $row->selesai ?? 0,
                $row->proses ?? 0
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

        $ext = $file->getExtension();
        if (!in_array($ext, ['csv', 'CSV'])) {
            session()->setFlashdata('error', 'File harus berformat CSV!');
            return redirect()->back();
        }

        $filePath = $file->getTempName();
        $handle = fopen($filePath, 'r');
        
        $bom = fread($handle, 3);
        if ($bom !== chr(0xEF).chr(0xBB).chr(0xBF)) {
            rewind($handle);
        }
        
        $data = [];
        $row = 0;
        while (($dataRow = fgetcsv($handle, 1000, ',')) !== FALSE) {
            if ($row > 0) {
                if (!empty($dataRow[1] ?? '')) {
                    $data[] = [
                        'periode' => trim($dataRow[1] ?? ''),
                        'layanan' => trim($dataRow[2] ?? ''),
                        'bidang' => trim($dataRow[3] ?? ''),
                        'kecamatan' => trim($dataRow[4] ?? ''),
                        'jumlah' => (int) ($dataRow[5] ?? 0),
                        'selesai' => (int) ($dataRow[6] ?? 0),
                        'proses' => (int) ($dataRow[7] ?? 0)
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
        
        fputcsv($output, ['No', 'Periode', 'Layanan', 'Bidang', 'Kecamatan', 'Jumlah', 'Selesai', 'Proses']);
        fputcsv($output, ['1', 'Juli 2026', 'Surat Pernyataan Miskin', 'Perlindungan Sosial', 'Banyuwangi', '123', '100', '23']);
        fputcsv($output, ['2', 'Juli 2026', 'Rekomendasi STP', 'Pemberdayaan Sosial', 'Srono', '123', '100', '23']);
        
        fclose($output);
        exit;
    }
}