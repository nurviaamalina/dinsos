<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\DatalayananModel;
use App\Models\KecamatanModel;
use App\Models\LayananModel;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

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
    // ==========================================
    // AMBIL FILE
    // ==========================================

    $file = $this->request->getFile('file_import');


    // ==========================================
    // CEK FILE
    // ==========================================

    if (!$file || !$file->isValid()) {

        return redirect()
            ->back()
            ->with('error', 'Silakan pilih file terlebih dahulu.');
    }


    // ==========================================
    // CEK UKURAN
    // Maksimal 10 MB
    // ==========================================

    if ($file->getSize() > 10 * 1024 * 1024) {

        return redirect()
            ->back()
            ->with(
                'error',
                'Ukuran file maksimal 10 MB.'
            );
    }


    // ==========================================
    // CEK EXTENSION
    // ==========================================

    $extension = strtolower(
        $file->getClientExtension()
    );

    $allowedExtensions = [
        'csv',
        'xls',
        'xlsx',
        'xlsm'
    ];


    if (!in_array(
        $extension,
        $allowedExtensions,
        true
    )) {

        return redirect()
            ->back()
            ->with(
                'error',
                'Format file tidak didukung. Gunakan CSV, XLS, XLSX, atau XLSM.'
            );
    }


    // ==========================================
    // BACA FILE EXCEL / CSV
    // ==========================================

    try {

        $spreadsheet = IOFactory::load(
            $file->getTempName()
        );

        $sheet = $spreadsheet->getActiveSheet();

        $rows = $sheet->toArray(
            null,
            true,
            true,
            false
        );

    } catch (\Throwable $e) {

        return redirect()
            ->back()
            ->with(
                'error',
                'File tidak dapat dibaca. Pastikan file Excel/CSV tidak rusak.'
            );
    }


    // ==========================================
    // CEK DATA
    // ==========================================

    if (count($rows) <= 1) {

        return redirect()
            ->back()
            ->with(
                'error',
                'File tidak memiliki data.'
            );
    }


    // ==========================================
    // HEADER
    // ==========================================

    $header = array_map(
        function ($value) {

            return strtolower(
                trim(
                    preg_replace(
                        '/\s+/',
                        ' ',
                        (string) $value
                    )
                )
            );

        },
        $rows[0]
    );


    // ==========================================
    // HEADER WAJIB
    // ==========================================

    $requiredHeaders = [
        'periode',
        'nama layanan',
        'bidang',
        'kecamatan',
        'jumlah',
        'selesai',
        'proses'
    ];


    foreach ($requiredHeaders as $required) {

        if (!in_array(
            $required,
            $header,
            true
        )) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Kolom "' . $required . '" tidak ditemukan dalam file.'
                );
        }
    }


    // ==========================================
    // POSISI KOLOM
    // ==========================================

    $colPeriode = array_search(
        'periode',
        $header,
        true
    );

    $colLayanan = array_search(
        'nama layanan',
        $header,
        true
    );

    $colBidang = array_search(
        'bidang',
        $header,
        true
    );

    $colKecamatan = array_search(
        'kecamatan',
        $header,
        true
    );

    $colJumlah = array_search(
        'jumlah',
        $header,
        true
    );

    $colSelesai = array_search(
        'selesai',
        $header,
        true
    );

    $colProses = array_search(
        'proses',
        $header,
        true
    );


    // ==========================================
    // SIAPKAN DATA
    // ==========================================

    $dataImport = [];

    $errors = [];


    foreach (
        array_slice($rows, 1)
        as $index => $row
    ) {

        $baris = $index + 2;


        // --------------------------------------
        // AMBIL DATA
        // --------------------------------------

        $periode = trim(
            (string) (
                $row[$colPeriode] ?? ''
            )
        );

        $layanan = trim(
            (string) (
                $row[$colLayanan] ?? ''
            )
        );

        $bidang = trim(
            (string) (
                $row[$colBidang] ?? ''
            )
        );

        $kecamatan = trim(
            (string) (
                $row[$colKecamatan] ?? ''
            )
        );

        $jumlah = trim(
            (string) (
                $row[$colJumlah] ?? ''
            )
        );

        $selesai = trim(
            (string) (
                $row[$colSelesai] ?? ''
            )
        );

        $proses = trim(
            (string) (
                $row[$colProses] ?? ''
            )
        );


        // --------------------------------------
        // BARIS KOSONG
        // --------------------------------------

        if (
            $periode === '' &&
            $layanan === '' &&
            $bidang === '' &&
            $kecamatan === '' &&
            $jumlah === '' &&
            $selesai === '' &&
            $proses === ''
        ) {
            continue;
        }


        // --------------------------------------
        // VALIDASI
        // --------------------------------------

        if ($periode === '') {
            $errors[] = "Baris {$baris}: Periode belum diisi.";
            continue;
        }

        if ($layanan === '') {
            $errors[] = "Baris {$baris}: Nama Layanan belum diisi.";
            continue;
        }

        if ($bidang === '') {
            $errors[] = "Baris {$baris}: Bidang belum diisi.";
            continue;
        }

        if ($kecamatan === '') {
            $errors[] = "Baris {$baris}: Kecamatan belum diisi.";
            continue;
        }


        // --------------------------------------
        // VALIDASI JUMLAH
        // --------------------------------------

        if (
            $jumlah === '' ||
            !is_numeric($jumlah)
        ) {

            $errors[] =
                "Baris {$baris}: Jumlah harus berupa angka.";

            continue;
        }


        // --------------------------------------
        // SELESAI
        // --------------------------------------

        if (
            $selesai === '' ||
            !is_numeric($selesai)
        ) {
            $selesai = 0;
        }


        // --------------------------------------
        // PROSES
        // --------------------------------------

        if (
            $proses === '' ||
            !is_numeric($proses)
        ) {
            $proses = 0;
        }


        // --------------------------------------
        // NORMALISASI ANGKA
        // --------------------------------------

        $jumlah = (int) str_replace(
            [',', '.'],
            '',
            $jumlah
        );

        $selesai = (int) str_replace(
            [',', '.'],
            '',
            $selesai
        );

        $proses = (int) str_replace(
            [',', '.'],
            '',
            $proses
        );


        // --------------------------------------
        // DATA UNTUK DATABASE
        // --------------------------------------

        $dataImport[] = [

            'periode'   => $periode,
            'layanan'   => $layanan,
            'bidang'    => $bidang,
            'kecamatan' => $kecamatan,
            'jumlah'    => $jumlah,
            'selesai'   => $selesai,
            'proses'    => $proses,

        ];
    }


    // ==========================================
    // CEK DATA VALID
    // ==========================================

    if (empty($dataImport)) {

        return redirect()
            ->back()
            ->with(
                'error',
                'Tidak ada data valid yang ditemukan.'
            );
    }


    // ==========================================
    // SIMPAN KE DATABASE
    // ==========================================

    $db = \Config\Database::connect();


    try {

        $db->transStart();

        $this->datalayananModel->insertBatch(
            $dataImport
        );

        $db->transComplete();


        if ($db->transStatus() === false) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data gagal disimpan ke database.'
                );
        }

    } catch (\Throwable $e) {

        return redirect()
            ->back()
            ->with(
                'error',
                'Import gagal: ' . $e->getMessage()
            );
    }


    // ==========================================
    // PESAN HASIL
    // ==========================================

    $jumlahData = count($dataImport);

    $pesan = "Berhasil import {$jumlahData} data pelayanan!";


    if (!empty($errors)) {

        $pesan .= ' Ada ' .
            count($errors) .
            ' baris yang dilewati karena tidak valid.';
    }


    return redirect()
        ->to('/admin/datalayanan')
        ->with('success', $pesan);
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