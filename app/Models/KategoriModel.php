<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class KategoriModel extends Model
{
    protected $table = 'dbo_kategori';
    protected $primaryKey = 'kategori_id';
    protected $allowedFields = [
        'kategori_id',
        'kategori_nama',
       
    ];
    protected $updatedField = 'updated_at';

    public function getAllKategori(){
    //    $query = $this->db->query("SELECT * FROM dbo_konten WHERE konten_parent=2");
       
    //    return $query->getResult();
       $query = $this->db->table('dbo_kategori')
      
    //    ->orderBy('kategori_id', 'asc')
       ->get()->getResultArray();  

       return $query;
    }

    
}