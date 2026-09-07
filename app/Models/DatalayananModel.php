<?php

namespace App\Models;

use CodeIgniter\Model;

class DatalayananModel extends Model
{
    protected $table = 'datalayanan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'periode',
        'layanan',
        'bidang',
        'kecamatan',
        'jumlah',
        'selesai',
        'proses'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $returnType = 'object';

    protected $validationRules = [
        'periode' => 'required|max_length[50]',
        'layanan' => 'required|max_length[200]',
        'bidang' => 'required|max_length[100]',
        'kecamatan' => 'required|max_length[100]',
        'jumlah' => 'required|numeric|greater_than_equal_to[0]',
        'selesai' => 'permit_empty|numeric|greater_than_equal_to[0]',
        'proses' => 'permit_empty|numeric|greater_than_equal_to[0]'
    ];

    protected $validationMessages = [
        'periode' => [
            'required' => 'Periode harus diisi',
            'max_length' => 'Periode maksimal 50 karakter'
        ],
        'layanan' => [
            'required' => 'Layanan harus diisi',
            'max_length' => 'Layanan maksimal 200 karakter'
        ],
        'bidang' => [
            'required' => 'Bidang harus diisi',
            'max_length' => 'Bidang maksimal 100 karakter'
        ],
        'kecamatan' => [
            'required' => 'Kecamatan harus diisi',
            'max_length' => 'Kecamatan maksimal 100 karakter'
        ],
        'jumlah' => [
            'required' => 'Jumlah harus diisi',
            'numeric' => 'Jumlah harus berupa angka',
            'greater_than_equal_to' => 'Jumlah tidak boleh negatif'
        ]
    ];

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
        return $this->like('periode', $keyword)
                    ->orLike('layanan', $keyword)
                    ->orLike('bidang', $keyword)
                    ->orLike('kecamatan', $keyword)
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
        $total = $this->selectSum('jumlah')->get()->getRow()->jumlah ?? 0;
        $selesai = $this->selectSum('selesai')->get()->getRow()->selesai ?? 0;
        $proses = $this->selectSum('proses')->get()->getRow()->proses ?? 0;
        
        return (object) [
            'total_permohonan' => $total,
            'permohonan_selesai' => $selesai,
            'permohonan_proses' => $proses
        ];
    }

    public function getDataForExport()
    {
        return $this->orderBy('id', 'ASC')
                    ->get()
                    ->getResult();
    }
}