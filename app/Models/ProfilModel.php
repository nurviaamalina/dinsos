<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilModel extends Model
{
    protected $table = 'profil';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'sejarah',
        'visi',
        'misi',
        'sasaran_strategis',
        'maklumat_pelayanan',
        'kontak',
        'email',
        'instagram',
        'facebook',
        'struktur',
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';
}