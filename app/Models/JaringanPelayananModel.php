<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class JaringanPelayananModel extends Model
{
    protected $table = 'dbo_lokasi';
    protected $primaryKey = 'lokasi_id';
    protected $allowedFields = [
        'konten_id',
        'lokasi_parent',
        'lokasi_gambar',
        'kategori_id',
    ];

    protected $updatedField = 'updated_at';

    public function getAllJaringanPelayanan(){
    
       $query = $this->db->table('dbo_lokasi')
       ->where('lokasi_parent = 0')
       ->join('dbo_kategori' , 'dbo_lokasi.kategori_id = dbo_kategori.kategori_id')
       ->orderBy('lokasi_id', 'asc')
       ->get()->getResultArray();  

       return $query;
    }

    public function findJaringanPelayananById($id)
    {
        $dbo_lokasi = $this
            ->asArray()
            ->where(['lokasi_id' => $id])
            ->first();
        if (!$dbo_lokasi) throw new Exception('Could not find client for specified ID');

        return $dbo_lokasi;
    }
    
}