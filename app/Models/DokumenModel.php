<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenModel extends Model
{
    protected $table = 'dokumen';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'kategori_id',
        'judul',
        'file',
        'tahun',
        'status',
        'dilihat'
    ];

    protected $useTimestamps = true;
}