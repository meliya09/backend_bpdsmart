<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class KreditProgramModel extends Model
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

    public function getAllKreditProgram(){
        // $query = $this->db->query("SELECT  
        // dbo_konten.konten_id,
        // dbo_konten.kategori_id, 
        // dbo_konten.konten_menu,
        // dbo_konten.konten_parent,
        // dbo_konten.konten_approval,
        // dbo_kategori.kategori_nama 
        // from dbo_kategori join dbo_konten on dbo_kategori.kategori_id = dbo_konten.kategori_id
        // where dbo_konten.konten_parent= 26
        // order by 
        // dbo_konten.konten_id");
        
        // return $query->getResult();

        $query = $this->db->table('dbo_konten')
       ->where('konten_parent = 26')
       ->join('dbo_kategori' , 'dbo_konten.kategori_id = dbo_kategori.kategori_id')
       ->orderBy('konten_id', 'asc')
       ->get()->getResultArray();  

       return $query;


    }

    public function findKreditProgramById($id)
    {
        $dbo_konten = $this
            ->asArray()
            ->where(['konten_id' => $id])
            ->first();
       
        if (!$dbo_konten) throw new Exception('Could not find client for specified ID');

        return $dbo_konten;
    }

    
}