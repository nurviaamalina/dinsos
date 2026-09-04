<?php

namespace App\Models;

use CodeIgniter\Model;

class BidangDetailModel extends Model
{
    protected $table = 'bidang_detail';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'id_bidang',
        'tentang',
        'ruang_lingkup',
        'tugas_pokok',
        'program_kegiatan',
        'telepon',
        'email',
        'alamat',
        'gambar',
    ];

    protected $useTimestamps = true;
}