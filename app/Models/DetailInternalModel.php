<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class DetailInternalModel extends Model
{
    protected $table = 'dbo_konten';
    protected $primaryKey = 'konten_id';
    protected $allowedFields = [
        'konten_parent',
        'konten_menu',
        'konten_judul',
        'konten_gambar',
        'file_path',
        'konten_deskripsi',  
    ]; 
    // }
    protected $updatedField = 'updated_at';

    public function getAllDetailInternal(){
        $query = $this->db->table('dbo_konten')
        ->where('konten_parent = 93')       
        ->orderBy('konten_id', 'desc')
        ->get()->getResultArray();   
        return $query; 
     } 

     public function getByKontenParent($konten_parent){
        $query = $this->db->table('dbo_konten')
        ->where('konten_parent', $konten_parent) 
        ->orderBy('konten_id', 'desc')
        ->get()->getResultArray();  
        return $query;
    }   

     public function getByKontenParentID($konten_parent,$konten_id){
        $query = $this->db->table('dbo_konten')
        ->where('konten_parent', $konten_parent) 
        ->where('konten_id', $konten_id) 
        ->orderBy('konten_id', 'desc')
        ->get()->getResultArray();  
        return $query;
    }   

        public function findDetailInternalById($id)
    {
        $dbo_konten = $this
            ->asArray()
            ->where(['konten_id' => $id])
            ->first();
        if (!$dbo_konten) throw new Exception('Could not find client for specified ID');

        return $dbo_konten;
    }

    
}