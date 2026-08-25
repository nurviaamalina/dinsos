<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table = 'berita';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useTimestamps = true;

    protected $allowedFields = [
        'kode',
        'judul',
        'slug',
        'isi',
        'gambar',
        'publikator',
        'tanggal',
        'views',
        'status',
    ];
}