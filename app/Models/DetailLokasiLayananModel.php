<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class DetailLokasiLayananModel extends Model
{
    protected $table = 'dbo_lokasi';
    protected $primaryKey = 'lokasi_id';
    protected $allowedFields = [
        'lokasi_id',
        'konten_id',
        'lokasi_parent',
        'lokasi_nama',
        'lokasi_alamat',
        'lokasi_telp',
        'lokasi_fax', 
        'lokasi_lat',
        'lokasi_lon',
        
       
    ];
    // }
    protected $updatedField = 'updated_at';

    public function getAllDetailLokasiLayanan(){
        $query = $this->db->table('dbo_lokasi')
        ->where('lokasi_parent between 1 and 7') 
        ->orderBy('lokasi_id', 'asc')
        ->get()->getResultArray();  
        return $query;
     }
     
    public function getByLokasiParent($lokasi_parent){
        $query = $this->db->table('dbo_lokasi')
        ->where('lokasi_parent', $lokasi_parent) 
        ->orderBy('lokasi_id', 'asc')
        ->get()->getResultArray();  
        return $query;
    }    

    public function findDetailLokasiLayananById($id)
    {
        $dbo_lokasi = $this
            ->asArray()
            ->where(['lokasi_id' => $id])
            ->first();
        if (!$dbo_lokasi) throw new Exception('Could not find client for specified ID');

        return $dbo_lokasi;
    }
}