<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class CabangUtamaModel extends Model
{
    protected $table = 'dbo_lokasi';
    protected $primaryKey = 'lokasi_id';
    protected $allowedFields = [
        'konten_id',
        'lokasi_parent',
        'lokasi_nama',
        'lokasi_alamat',
        'lokasi_telp',
        'lokasi_fax',
        'lokasi_lat',
        'lokasi_lon'
       
       
    ];

    protected $updatedField = 'updated_at';

    public function getAllCabangUtama(){
        //    $query = $this->db->query("SELECT * FROM dbo_konten WHERE konten_parent=2");
           
        //    return $query->getResult();
           $query = $this->db->table('dbo_lokasi')
            ->where('lokasi_parent = 1')
           ->orderBy('lokasi_id', 'asc')
           ->get()->getResultArray();  
    
           return $query;
        }
       
    
        public function findCabangUtamaById($lokasi_id)
        {
            $dbo_lokasi = $this
                ->asArray()
                ->where(['lokasi_id' => $lokasi_id])
                ->first();
           
            if (!$dbo_lokasi) throw new Exception('Could not find client for specified ID');
    
            return $dbo_lokasi;
        }
    
}