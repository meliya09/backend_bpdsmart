<?php
 
namespace App\Models;

use CodeIgniter\Model;
use Exception;

class LokasiLayananATMModel extends Model
{
    protected $table = 'dbo_lokasi';
    protected $primaryKey = 'lokasi_id';
    protected $allowedFields = [
        'lokasi_id',
        'konten_id',
        'lokasi_parent',
        'lokasi_gambar',
        'lokasi_nama',
        'lokasi_alamat',
        'lokasi_telp',
        'lokasi_fax',
        'lokasi_lat',
        'lokasi_lon',
        'file_path', 
    ];
    // } 
    protected $updatedField = 'updated_at';

    public function getAllLokasiLayananATM(){
        $query = $this->db->table('dbo_lokasi')
        ->where('lokasi_parent = 160') 
        ->orderBy('lokasi_id', 'asc')
        ->get()->getResultArray();  
        return $query;
     }

        public function findLokasiLayananATMById($id)
    {
        $dbo_lokasi = $this
            ->asArray()
            ->where(['lokasi_id' => $id])
            ->first();
        if (!$dbo_lokasi) throw new Exception('Could not find client for specified ID');

        return $dbo_lokasi;
    }


    
}