<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilSKMModel extends Model
{
    protected $table = 'hasil_skm';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useTimestamps = true;

    protected $allowedFields = [
        'periode_bulan',
        'periode_tahun',
        'kecamatan',
        'jumlah_responden',
        'nilai_ikm',
        'dokumen',
    ];
}