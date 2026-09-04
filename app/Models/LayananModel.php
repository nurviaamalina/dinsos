<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
    protected $table            = 'layanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    
    // Tambahkan standar_layanan, gambar, dan dokumen di sini
    protected $allowedFields    = [
        'nama_layanan', 
        'bidang', 
        'deskripsi_layanan', 
        'standar_layanan', 
        'prosedur_layanan', 
        'status_layanan', 
        'gambar', 
        'dokumen'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
}