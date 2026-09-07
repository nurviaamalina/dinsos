<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilSKMLayananModel extends Model
{
    protected $table = 'hasil_skm_layanan';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useTimestamps = true;

    protected $allowedFields = [
        'hasil_skm_id',
        'nama_layanan',
        'jumlah_responden',
        'nilai_ikm',
    ];
}