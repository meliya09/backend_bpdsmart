<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class SearchModel extends Model
{

    protected $table                = 'dbo_konten';
    protected $primaryKey           = 'konten_id';
    protected $allowedFields        = [
    'konten_id',
    'konten_menu',
    ];

    public function getAllData(){
        $query = $this->db->table('dbo_konten')
        ->orderBy('konten_id', 'asc')
        ->get()->getResultArray();  
        return $query;
     }

    public function showSearch($cari){
        $query = $this->db->table('dbo_konten')
        ->Like('LOWER (konten_menu)',strtolower($cari))
        ->orderBy('konten_id', 'asc')
        ->get()->getResultArray();  
        return $query;
    }
}
