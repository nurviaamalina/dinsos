<?php

namespace App\Models;

use CodeIgniter\Model;

class PenerimaManfaatModel extends Model
{
    protected $table = 'penerima_manfaat';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useTimestamps = true;

    protected $allowedFields = [
        'periode_bulan',
        'periode_tahun',
        'kategori',
        'jumlah',
    ];
}