<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilAnggotaModel extends Model
{
    protected $table = 'profil_anggota';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'nama',
        'jabatan',
        'bidang',
        'caption',
        'foto',
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';
}