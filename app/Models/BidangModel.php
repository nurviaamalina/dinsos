<?php

namespace App\Models;

use CodeIgniter\Model;

class BidangModel extends Model
{
    protected $table = 'bidang';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useTimestamps = true;

    protected $allowedFields = [
        'nama_bidang',
        'status',
    ];
}