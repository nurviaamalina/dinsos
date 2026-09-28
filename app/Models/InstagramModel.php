<?php

namespace App\Models;

use CodeIgniter\Model;

class InstagramModel extends Model
{
    protected $table            = 'instagram_posts';
    protected $primaryKey       = 'id';

    protected $returnType       = 'array';

    protected $useAutoIncrement = true;

    protected $useSoftDeletes   = false;

    protected $protectFields    = true;

    protected $allowedFields = [

        // CRUD Manual
        'judul',
        'caption',
        'thumbnail',
        'instagram_url',
        'tanggal_post',

        // Persiapan API Instagram
        'instagram_id',
        'media_url',
        'thumbnail_url',
        'permalink',
        'media_type',
        'posted_at'

    ];

    protected bool $allowEmptyInserts = false;

    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;

    protected $dateFormat = 'datetime';

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = '';

    protected $validationRules = [];

    protected $validationMessages = [];

    protected $skipValidation = false;

    protected $cleanValidationRules = true;
}