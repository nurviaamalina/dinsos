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
    
    protected $allowedFields    = [
        'nama_layanan', 
        'bidang', 
        'deskripsi_layanan', 
        'dasar_hukum',
        'persyaratan',
        'sistem_mekanisme_prosedur',
        'jangka_waktu_pelayanan',
        'biaya_tarif',
        'produk_pelayanan',
        'penanganan_pengaduan',
        'sarana_prasarana_fasilitas',
        'kompetensi_pelaksana',
        'pengawasan_internal',
        'jumlah_pelaksana',
        'jaminan_pelayanan',
        'jaminan_keamanan_keselamatan',
        'evaluasi_kinerja_pelaksana',
        'status_layanan', 
        'gambar', 
        'dokumen'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
}