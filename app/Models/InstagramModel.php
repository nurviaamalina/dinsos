<?php

namespace App\Models;

use CodeIgniter\Model;

class InstagramModel extends Model
{
    protected $table = 'instagram_posts';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useTimestamps = true;

    protected $allowedFields = [
        'instagram_id',
        'caption',
        'media_url',
        'thumbnail_url',
        'permalink',
        'media_type',
    ];
}