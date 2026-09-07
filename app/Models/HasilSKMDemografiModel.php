<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilSKMDemografiModel extends Model
{
    protected $table = 'hasil_skm_demografi';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useTimestamps = true;

    protected $allowedFields = [
        'hasil_skm_id',
        'jenis',
        'kategori',
        'jumlah',
    ];
}