<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class JasaSyariahModel extends Model
{
    protected $table = 'dbo_konten';
    protected $primaryKey = 'konten_id';
    protected $allowedFields = [
        'konten_parent',
        'konten_menu',
        'kategori_id',
       
    ];
    // }
    protected $updatedField = 'updated_at';

    public function getAllJasaSyariah(){
    //    $query = $this->db->query("SELECT * FROM dbo_konten WHERE konten_parent=2");
       
    //    return $query->getResult();
       $query = $this->db->table('dbo_konten')
       ->where('konten_parent = 47')
       ->join('dbo_kategori' , 'dbo_konten.kategori_id = dbo_kategori.kategori_id')
       ->orderBy('konten_id', 'asc')
       ->get()->getResultArray();  

       return $query;
    }

    public function findJasaSyariahById($id)
    {
        $dbo_konten = $this
            ->asArray()
            ->where(['konten_id' => $id])
            ->first();
       
        if (!$dbo_konten) throw new Exception('Could not find client for specified ID');

        return $dbo_konten;
    }

    
}