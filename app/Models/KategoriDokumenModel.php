<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriDokumenModel extends Model
{
    protected $table = 'kategori_dokumen';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'nama_kategori',
        'slug',
        'deskripsi'
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';
}