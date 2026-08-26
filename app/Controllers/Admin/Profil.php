<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProfilModel;
use App\Models\ProfilAnggotaModel;

class Profil extends BaseController
{
    protected $profilModel;

    protected $anggotaModel;


    public function __construct()
    {
        $this->profilModel = new ProfilModel();

        $this->anggotaModel = new ProfilAnggotaModel();

        
    }


    // =====================================================
    // PROFIL DINAS
    // =====================================================

    public function index()
    {
        $profil = $this->profilModel->first();

        $anggota = $this->anggotaModel
            ->orderBy('id', 'DESC')
            ->findAll();


        return view(
            'admin/profil/index',
            [
                'title'   => 'Profil dan Sejarah Dinas',
                'profil'  => $profil,
                'anggota' => $anggota,
            ]
        );
    }


    // =====================================================
    // TAMBAH SEJARAH
    // =====================================================

    public function create()
    
    {
        $profil = $this->profilModel->first();

        $sasaranStrategis = [];

        if (!empty($profil['sasaran_strategis'])) {

            $decoded = json_decode(
                $profil['sasaran_strategis'],
                true
            );

            if (is_array($decoded)) {
                $sasaranStrategis = $decoded;
            }
        }


        return view(
            'admin/profil/create',
            [
                'title'  => 'Tambah Sejarah Dinas',
                'profil' => $profil,
            ]
        );
    }

public function update()
    {
        $profil = $this->profilModel->first();

        if (!$profil) {

            $this->profilModel->insert([
                'sejarah' => $this->request->getPost('sejarah'),
                'visi' => $this->request->getPost('visi'),

    'misi' => $this->request->getPost('misi'),
                'sasaran_strategis' => $this->request->getPost('sasaran_strategis') ?? [],
                'maklumat_pelayanan' => $this->request->getPost('maklumat_pelayanan'),
                'kontak' => $this->request->getPost('kontak'),
                'email' => $this->request->getPost('email'),
                'instagram' => $this->request->getPost('instagram'),
                'facebook' => $this->request->getPost('facebook'),
                'struktur' => $this->request->getPost('struktur'),
            ]);

        } else {

            $this->profilModel->update($profil['id'], [

                'sejarah' => $this->request->getPost('sejarah'),

                'visi' => $this->request->getPost('visi'),
                'misi' => $this->request->getPost('misi'),

                'sasaran_strategis' => $this->request->getPost('sasaran_strategis') ?? [],
                'maklumat_pelayanan' => $this->request->getPost('maklumat_pelayanan'),
                'kontak' => $this->request->getPost('kontak'),

                'email' => $this->request->getPost('email'),

                'instagram' => $this->request->getPost('instagram'),

                'facebook' => $this->request->getPost('facebook'),

                'struktur' => $this->request->getPost('struktur'),

            ]);
        }

        return redirect()
            ->to(base_url('admin/profil'))
            ->with('success', 'Profil berhasil diperbarui.');
    }

    // =====================================================
    // SIMPAN PROFIL
    // =====================================================

    public function store()
{
    /*
    |--------------------------------------------------------------------------
    | AMBIL DATA PROFIL LAMA
    |--------------------------------------------------------------------------
    */

    $profil = $this->profilModel->first();

    /*
    |--------------------------------------------------------------------------
    | DATA PROFIL
    |--------------------------------------------------------------------------
    */

    $data = [

        'sejarah' => $this->request
            ->getPost('sejarah'),

        'visi' => $this->request
            ->getPost('visi'),

        'misi' => $this->request
            ->getPost('misi'),

        'sasaran_strategis' => $this->request
            ->getPost('sasaran_strategis') ?? [],
        
        'maklumat_pelayanan' => $this->request
            ->getPost('maklumat_pelayanan'),

        'kontak' => $this->request
            ->getPost('kontak'),

        'email' => $this->request
            ->getPost('email'),

        'instagram' => $this->request
            ->getPost('instagram'),

        'facebook' => $this->request
            ->getPost('facebook'),

    ];


    /*
    |--------------------------------------------------------------------------
    | UPLOAD STRUKTUR
    |--------------------------------------------------------------------------
    */

    $file = $this->request->getFile('struktur');


    if (
        $file &&
        $file->isValid() &&
        !$file->hasMoved()
    ) {

        $path = FCPATH . 'uploads/struktur/';


        if (!is_dir($path)) {

            mkdir(
                $path,
                0777,
                true
            );

        }


        $namaFile = $file->getRandomName();


        $file->move(
            $path,
            $namaFile
        );


        $data['struktur'] = $namaFile;

    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA PROFIL
    |--------------------------------------------------------------------------
    */

    if ($profil) {

        $this->profilModel->update(
            $profil['id'],
            $data
        );

    } else {

        /*
        |--------------------------------------------------------------------------
        | INSERT JIKA BELUM ADA
        |--------------------------------------------------------------------------
        */

        $this->profilModel->insert(
            $data
        );

    }


    /*
    |--------------------------------------------------------------------------
    | REDIRECT
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->to(base_url('admin/profil'))
        ->with(
            'success',
            'Profil Dinas berhasil disimpan.'
        );
}


    // =====================================================
    // TAMBAH ANGGOTA
    // =====================================================

    public function anggotaCreate()
    {
        return view(
            'admin/profil/anggota-create',
            [
                'title' => 'Tambah Anggota Dinas'
            ]
        );
    }


    // =====================================================
    // SIMPAN ANGGOTA
    // =====================================================

    public function anggotaStore()
    {
        $validation = $this->validate([
            'nama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama wajib diisi.'
                ]
            ],

            'jabatan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Jabatan wajib diisi.'
                ]
            ],

            'bidang' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Bidang wajib diisi.'
                ]
            ],

            'caption' => [
                'rules'  => 'permit_empty'
            ],

            'foto' => [
                'rules'  => 'uploaded[foto]|is_image[foto]|max_size[foto,5120]',
                'errors' => [
                    'uploaded' => 'Foto wajib diupload.',
                    'is_image' => 'File harus berupa gambar.',
                    'max_size' => 'Ukuran foto maksimal 5MB.'
                ]
            ],
        ]);


        if (!$validation) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    $this->validator->getErrors()
                );
        }


        $data = [
            'nama'    => $this->request->getPost('nama'),
            'jabatan' => $this->request->getPost('jabatan'),
            'bidang'  => $this->request->getPost('bidang'),
            'caption' => $this->request->getPost('caption'),
        ];


        // =================================================
        // UPLOAD FOTO
        // =================================================

        $foto = $this->request->getFile('foto');


        if (
            $foto &&
            $foto->isValid() &&
            !$foto->hasMoved()
        ) {

            $uploadPath = FCPATH . 'uploads/profil/';


            if (!is_dir($uploadPath)) {

                mkdir(
                    $uploadPath,
                    0777,
                    true
                );

            }


            $namaFoto = $foto->getRandomName();


            $foto->move(
                $uploadPath,
                $namaFoto
            );


            $data['foto'] = $namaFoto;
        }


        $this->anggotaModel->insert($data);


        return redirect()
            ->to(base_url('admin/profil'))
            ->with(
                'success',
                'Anggota Dinas berhasil ditambahkan.'
            );
    }

    public function anggotaEdit($id)
{
    $anggota = $this->anggotaModel->find($id);

    if (!$anggota) {

        return redirect()
            ->to(base_url('admin/profil'))
            ->with(
                'error',
                'Data anggota tidak ditemukan.'
            );
    }

    return view(
        'admin/profil/anggota-edit',
        [
            'title'   => 'Edit Anggota Dinas',
            'anggota' => $anggota,
        ]
    );
}

public function anggotaUpdate($id)
{
    $anggota = $this->anggotaModel->find($id);

    if (!$anggota) {

        return redirect()
            ->to(base_url('admin/profil'))
            ->with(
                'error',
                'Data anggota tidak ditemukan.'
            );
    }


    // =========================================
    // DATA TEXT
    // =========================================

    $data = [
        'nama'    => $this->request->getPost('nama'),
        'jabatan' => $this->request->getPost('jabatan'),
        'bidang'  => $this->request->getPost('bidang'),
        'caption' => $this->request->getPost('caption'),
    ];


    // =========================================
    // FOTO BARU
    // =========================================

    $foto = $this->request->getFile('foto');


    if (
        $foto &&
        $foto->isValid() &&
        !$foto->hasMoved()
    ) {

        $uploadPath = FCPATH . 'uploads/profil/';


        if (!is_dir($uploadPath)) {

            mkdir(
                $uploadPath,
                0777,
                true
            );
        }


        // Hapus foto lama

        if (!empty($anggota['foto'])) {

            $fotoLama =
                $uploadPath . $anggota['foto'];


            if (is_file($fotoLama)) {

                unlink($fotoLama);

            }
        }


        // Simpan foto baru

        $namaFoto =
            $foto->getRandomName();


        $foto->move(
            $uploadPath,
            $namaFoto
        );


        $data['foto'] = $namaFoto;
    }


    // =========================================
    // UPDATE
    // =========================================

    $this->anggotaModel->update(
        $id,
        $data
    );


    return redirect()
        ->to(base_url('admin/profil'))
        ->with(
            'success',
            'Data anggota berhasil diperbarui.'
        );
}
}