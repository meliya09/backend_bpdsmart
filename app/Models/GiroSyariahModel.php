<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class GiroSyariahModel extends Model
{
    protected $table = 'dbo_konten';
    protected $primaryKey = 'konten_id';
    protected $allowedFields = [
        'konten_parent',
        'konten_menu',
        'kategori_id',
        'konten_approval',
       
    ];
    // }
    protected $updatedField = 'updated_at';

    public function getAllGiroSyariah(){
    //    $query = $this->db->query("SELECT * FROM dbo_konten WHERE konten_parent=2");
       
    //    return $query->getResult();
       $query = $this->db->table('dbo_konten')
       ->where('konten_parent = 49')
       ->join('dbo_kategori' , 'dbo_konten.kategori_id = dbo_kategori.kategori_id')
       ->orderBy('konten_id', 'asc')
       ->get()->getResultArray();  

       return $query;
    }

    public function findGiroSyariahById($id)
    {
        $konten = $this->db->table('dbo_konten');
        $konten->select('*');
        $konten->join('dbo_kategori', 'dbo_konten.kategori_id = dbo_kategori.kategori_id');
        $konten->where('dbo_konten.konten_id', $id);
        $query = $konten->get();
        return $query->getRowArray();
    }

    
}