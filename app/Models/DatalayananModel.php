<?php

namespace App\Models;

use CodeIgniter\Model;

class DatalayananModel extends Model
{
    protected $table = 'datalayanan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'pendaftar', 
        'tanggal', 
        'status', 
        'jumlah',
        'jenis_kendaraan',
        'merek_kendaraan',
        'warna_kendaraan',
        'lokasi_kendaraan',
        'kategori_kendaraan'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $returnType = 'object';

    public function getAllData($limit = null, $offset = null)
    {
        $builder = $this->orderBy('id', 'DESC');
        
        if ($limit !== null) {
            $builder->limit($limit, $offset);
        }
        
        return $builder->get()->getResult();
    }

    public function searchData($keyword)
    {
        return $this->like('pendaftar', $keyword)
                    ->orLike('status', $keyword)
                    ->orLike('jenis_kendaraan', $keyword)
                    ->orLike('merek_kendaraan', $keyword)
                    ->orderBy('id', 'DESC')
                    ->get()
                    ->getResult();
    }

    public function getTotalData()
    {
        return $this->countAll();
    }

    public function getStatistik()
    {
        $total = $this->countAll();
        $selesai = $this->where('status', 'Selesai')->countAllResults();
        
        return (object) [
            'total_permohonan' => $total,
            'permohonan_selesai' => $selesai
        ];
    }

    public function getDataForExport()
    {
        return $this->orderBy('id', 'ASC')
                    ->get()
                    ->getResult();
    }
}