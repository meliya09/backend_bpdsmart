<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class DepositoSyariahModel extends Model
{
    protected $table = 'dbo_konten';
    protected $primaryKey = 'konten_id';
    protected $allowedFields = [ 
        'konten_parent',
        'konten_menu',
        'kategori_id',
        'kategori_nama',
        'konten_approval', 
       
    ];
    // }
    protected $updatedField = 'updated_at';

    public function getAllDepositoSyariah(){
    //    $query = $this->db->query("SELECT * FROM dbo_konten WHERE konten_parent=2");
       
    //    return $query->getResult();
       $query = $this->db->table('dbo_konten')
       ->where('konten_parent = 50')
       ->join('dbo_kategori' , 'dbo_konten.kategori_id = dbo_kategori.kategori_id')
       ->orderBy('konten_id', 'asc')
       ->get()->getResultArray();  

       return $query;
    }

    public function findDepositoSyariahById($id)
    {
        $konten = $this->db->table('dbo_konten');
        $konten->select('*');
        $konten->join('dbo_kategori', 'dbo_konten.kategori_id = dbo_kategori.kategori_id');
        $konten->where('dbo_konten.konten_id', $id);
        $query = $konten->get();
        return $query->getRowArray();
    }

    
}