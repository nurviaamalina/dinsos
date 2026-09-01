<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoKegiatanModel extends Model
{
    protected $table = 'foto_kegiatan';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useTimestamps = false;

    protected $allowedFields = [
        'kegiatan_id',
        'foto',
        'created_at',
    ];
}