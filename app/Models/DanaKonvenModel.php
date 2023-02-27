<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class DanaKonvenModel extends Model
{
    protected $table = 'dbo_konten';
    protected $primaryKey = 'konten_id';
    protected $allowedFields = [
        'konten_parent',
        'konten_menu',
        'kategori_id',
        'kategori_nama',
       
    ];
    // }
    protected $updatedField = 'updated_at';

    public function getAllDanaKonven(){
        // $query = $this->db->query("SELECT 
        // dbo_konten.konten_id,
        // dbo_konten.kategori_id,
        // dbo_konten.konten_menu,
        // dbo_konten.konten_url,
        // dbo_konten.konten_parent,
        // dbo_kategori.kategori_nama 
        // from dbo_kategori join dbo_konten on dbo_kategori.kategori_id = dbo_konten.kategori_id
        // where dbo_konten.konten_parent = 7
        // order by 
        // dbo_konten.konten_id");
        
        // return $query->getResult();

       $query = $this->db->table('dbo_konten')
       ->where('konten_parent = 7')
       ->join('dbo_kategori' , 'dbo_konten.kategori_id = dbo_kategori.kategori_id')
       ->orderBy('konten_id', 'asc')
       ->get()->getResultArray();  

       return $query;
    }

    public function findDanaKonvenById($id)
    {
        $konten = $this->db->table('dbo_konten');
        $konten->select('*');
        $konten->join('dbo_kategori', 'dbo_konten.kategori_id = dbo_kategori.kategori_id');
        $konten->where('dbo_konten.konten_id', $id);
        $query = $konten->get();
        return $query->getRowArray();
        
        // $dbo_konten = $this
        //     ->asArray()
        //     ->where(['konten_id' => $id])
        //     ->first();
       
        // if (!$dbo_konten) throw new Exception('Could not find client for specified ID');

        // return $dbo_konten;
    }

    
}