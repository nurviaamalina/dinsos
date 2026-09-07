<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilSKMImportModel extends Model
{
    protected $table = 'hasil_skm_import';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useTimestamps = false;

    protected $allowedFields = [
        'hasil_skm_id',
        'nama_file',
        'format_file',
        'mapping_kolom',
        'header_asli',
        'data_asli',
        'created_at',
    ];
}