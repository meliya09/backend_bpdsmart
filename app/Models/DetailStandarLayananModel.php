<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class DetailStandarLayananModel extends Model
{
    protected $table = 'dbo_konten';
    protected $primaryKey = 'konten_id';
    protected $allowedFields = [
        'konten_parent',
        'konten_menu',
        'konten_judul',
        'konten_subjudul',
        'konten_gambar',
        'konten_gambar2',
        'konten_gambar3',
        'file_path',
        'file_path2',
        'file_path3',
        'konten_deskripsi', 
    ];
    // }
    protected $updatedField = 'updated_at';

    public function getAllDetailLayanan(){
        $query = $this->db->table('dbo_konten')
        ->where('konten_parent = 100')
        ->orderBy('konten_id', 'asc')
        ->get()->getResultArray();  
        return $query;
     } 

        public function findDetailLayananById($id)
    {
        $dbo_konten = $this
            ->asArray()
            ->where(['konten_id' => $id])
            ->first();
        if (!$dbo_konten) throw new Exception('Could not find client for specified ID');

        return $dbo_konten;
    }

    
}