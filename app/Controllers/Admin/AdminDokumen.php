<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DokumenModel;
use App\Models\KategoriDokumenModel;

class AdminDokumen extends BaseController
{
    protected $dokumen;
    protected $kategori;


    public function __construct()
    {
        $this->dokumen = new DokumenModel();

        $this->kategori = new KategoriDokumenModel();
    }


    // =====================================================
    // INDEX
    // =====================================================

    public function index()
    {
        $data = [

            'title' => 'Dokumen',

            'dokumen' => $this->dokumen
                ->select(
                    'dokumen.*,
                     kategori_dokumen.nama_kategori,
                     kategori_dokumen.slug'
                )
                ->join(
                    'kategori_dokumen',
                    'kategori_dokumen.id = dokumen.kategori_id',
                    'left'
                )
                ->orderBy(
                    'dokumen.id',
                    'DESC'
                )
                ->paginate(5),

            'pager' => $this->dokumen->pager,

            'kategori' => $this->kategori
                ->orderBy(
                    'nama_kategori',
                    'ASC'
                )
                ->findAll(),

        ];


        return view(
            'Admin/dokumen/index',
            $data
        );
    }


    // =====================================================
    // CREATE
    // =====================================================

    public function create()
    {
        $data = [

            'title' => 'Tambah Dokumen',

            'kategori' => $this->kategori
                ->orderBy(
                    'nama_kategori',
                    'ASC'
                )
                ->findAll(),

        ];


        return view(
            'Admin/dokumen/create',
            $data
        );
    }


    // =====================================================
    // STORE
    // =====================================================

    public function store()
    {
        $rules = [

            'kategori_id' => [
                'label' => 'Kategori',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' =>
                        'Kategori wajib dipilih.',
                    'numeric' =>
                        'Kategori tidak valid.',
                ],
            ],

            'judul' => [
                'label' => 'Judul Dokumen',
                'rules' =>
                    'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' =>
                        'Judul dokumen wajib diisi.',
                    'min_length' =>
                        'Judul minimal 3 karakter.',
                    'max_length' =>
                        'Judul maksimal 255 karakter.',
                ],
            ],

            'tahun' => [
                'label' => 'Tahun',
                'rules' =>
                    'required|numeric|exact_length[4]',
                'errors' => [
                    'required' =>
                        'Tahun wajib diisi.',
                    'numeric' =>
                        'Tahun harus berupa angka.',
                    'exact_length' =>
                        'Tahun harus terdiri dari 4 angka.',
                ],
            ],

            'status' => [
                'label' => 'Status',
                'rules' =>
                    'required|in_list[DRAFT,PUBLISHED]',
                'errors' => [
                    'required' =>
                        'Status wajib dipilih.',
                    'in_list' =>
                        'Status tidak valid.',
                ],
            ],

            'file' => [
                'label' => 'File Dokumen',
                'rules' =>
                    'uploaded[file]|max_size[file,10240]',
                'errors' => [
                    'uploaded' =>
                        'File dokumen wajib dipilih.',
                    'max_size' =>
                        'Ukuran file maksimal 10 MB.',
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


        // =================================================
        // FILE
        // =================================================

        $file =
            $this->request->getFile('file');


        if (
            !$file ||
            !$file->isValid()
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'File dokumen tidak valid.'
                );
        }


        // =================================================
        // FOLDER
        // =================================================

        $uploadPath =
            FCPATH . 'uploads/dokumen';


        if (!is_dir($uploadPath)) {

            mkdir(
                $uploadPath,
                0777,
                true
            );
        }


        // =================================================
        // NAMA FILE ASLI
        // =================================================

        $namaFile =
            $file->getName();


        // =================================================
        // CEK FILE
        // =================================================

        if (
            file_exists(
                $uploadPath .
                DIRECTORY_SEPARATOR .
                $namaFile
            )
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Nama file sudah digunakan. Silakan gunakan nama file lain.'
                );
        }


        // =================================================
        // PINDAHKAN FILE
        // =================================================

        $file->move(
            $uploadPath,
            $namaFile
        );


        // =================================================
        // SIMPAN DATABASE
        // =================================================

        $this->dokumen->insert([

            'kategori_id' =>
                $this->request
                    ->getPost('kategori_id'),

            'judul' =>
                $this->request
                    ->getPost('judul'),

            'file' =>
                $namaFile,

            'tahun' =>
                $this->request
                    ->getPost('tahun'),

            'status' =>
                $this->request
                    ->getPost('status'),

        ]);


        return redirect()
            ->to(
                base_url('admin/dokumen')
            )
            ->with(
                'success',
                'Dokumen berhasil ditambahkan.'
            );
    }


    // =====================================================
    // EDIT
    // =====================================================

    public function edit($id)
    {
        $dokumen =
            $this->dokumen->find($id);


        if (!$dokumen) {

            throw
                \CodeIgniter\Exceptions\PageNotFoundException
                ::forPageNotFound(
                    'Dokumen tidak ditemukan.'
                );
        }


        $data = [

            'title' =>
                'Edit Dokumen',

            'dokumen' =>
                $dokumen,

            'kategori' =>
                $this->kategori
                    ->orderBy(
                        'nama_kategori',
                        'ASC'
                    )
                    ->findAll(),

        ];


        return view(
            'Admin/dokumen/edit',
            $data
        );
    }


    // =====================================================
    // UPDATE
    // =====================================================

    public function update($id)
    {
        $dokumen =
            $this->dokumen->find($id);


        if (!$dokumen) {

            throw
                \CodeIgniter\Exceptions\PageNotFoundException
                ::forPageNotFound(
                    'Dokumen tidak ditemukan.'
                );
        }


        // =================================================
        // VALIDASI
        // =================================================

        $rules = [

            'kategori_id' => [
                'label' => 'Kategori',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' =>
                        'Kategori wajib dipilih.',
                    'numeric' =>
                        'Kategori tidak valid.',
                ],
            ],

            'judul' => [
                'label' => 'Judul Dokumen',
                'rules' =>
                    'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' =>
                        'Judul dokumen wajib diisi.',
                    'min_length' =>
                        'Judul minimal 3 karakter.',
                    'max_length' =>
                        'Judul maksimal 255 karakter.',
                ],
            ],

            'tahun' => [
                'label' => 'Tahun',
                'rules' =>
                    'required|numeric|exact_length[4]',
                'errors' => [
                    'required' =>
                        'Tahun wajib diisi.',
                    'numeric' =>
                        'Tahun harus berupa angka.',
                    'exact_length' =>
                        'Tahun harus terdiri dari 4 angka.',
                ],
            ],

            'status' => [
                'label' => 'Status',
                'rules' =>
                    'required|in_list[DRAFT,PUBLISHED]',
                'errors' => [
                    'required' =>
                        'Status wajib dipilih.',
                    'in_list' =>
                        'Status tidak valid.',
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


        // =================================================
        // DATA UPDATE
        // =================================================

        $data = [

            'kategori_id' =>
                $this->request
                    ->getPost('kategori_id'),

            'judul' =>
                $this->request
                    ->getPost('judul'),

            'tahun' =>
                $this->request
                    ->getPost('tahun'),

            'status' =>
                $this->request
                    ->getPost('status'),

        ];


        // =================================================
        // FILE BARU
        // =================================================

        $file =
            $this->request->getFile('file');


        if (
            $file &&
            $file->isValid() &&
            !$file->hasMoved()
        ) {

            $uploadPath =
                FCPATH . 'uploads/dokumen';


            if (!is_dir($uploadPath)) {

                mkdir(
                    $uploadPath,
                    0777,
                    true
                );
            }


            $namaFile =
                $file->getName();


            // =============================================
            // CEK FILE BARU
            // =============================================

            if (
                file_exists(
                    $uploadPath .
                    DIRECTORY_SEPARATOR .
                    $namaFile
                )
                &&
                $dokumen['file'] !== $namaFile
            ) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Nama file sudah digunakan.'
                    );
            }


            // =============================================
            // HAPUS FILE LAMA
            // =============================================

            if (
                !empty(
                    $dokumen['file']
                )
            ) {

                $fileLama =
                    $uploadPath .
                    DIRECTORY_SEPARATOR .
                    $dokumen['file'];


                if (
                    file_exists($fileLama)
                    &&
                    $dokumen['file']
                    !== $namaFile
                ) {

                    unlink($fileLama);
                }
            }


            // =============================================
            // UPLOAD FILE
            // =============================================

            $file->move(
                $uploadPath,
                $namaFile
            );


            $data['file'] =
                $namaFile;
        }


        // =================================================
        // UPDATE DATABASE
        // =================================================

        $this->dokumen->update(
            $id,
            $data
        );


        return redirect()
            ->to(
                base_url('admin/dokumen')
            )
            ->with(
                'success',
                'Dokumen berhasil diperbarui.'
            );
    }


    // =====================================================
    // DELETE
    // =====================================================

    public function delete($id)
{
    $dokumen = $this->dokumen->find($id);

    if (!$dokumen) {
        return redirect()
            ->to(base_url('admin/dokumen'))
            ->with('error', 'Dokumen tidak ditemukan.');
    }

    // Hapus file fisik
    if (!empty($dokumen['file'])) {

        $filePath = FCPATH . 'uploads/dokumen/' . $dokumen['file'];

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    // Hapus data database
    if ($this->dokumen->delete($id)) {

        return redirect()
            ->to(base_url('admin/dokumen'))
            ->with('success', 'Dokumen berhasil dihapus.');

    }

    return redirect()
        ->to(base_url('admin/dokumen'))
        ->with('error', 'Dokumen gagal dihapus.');
}

    // =====================================================
    // DOWNLOAD
    // =====================================================

    public function download($id)
    {
        $dokumen =
            $this->dokumen->find($id);


        if (!$dokumen) {

            throw
                \CodeIgniter\Exceptions\PageNotFoundException
                ::forPageNotFound(
                    'Dokumen tidak ditemukan.'
                );
        }


        if (
            empty(
                $dokumen['file']
            )
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Dokumen tidak memiliki file.'
                );
        }


        $filePath =
            FCPATH .
            'uploads/dokumen/' .
            $dokumen['file'];


        if (
            !file_exists($filePath)
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'File dokumen tidak ditemukan.'
                );
        }


        return $this->response
            ->download(
                $filePath,
                null
            );
    }
}