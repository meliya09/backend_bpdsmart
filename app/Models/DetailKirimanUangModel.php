<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class DetailKirimanUangModel extends Model
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
        'konten_syarat',
        'konten_ketentuan',
        'konten_fasilitas',
        'konten_promosi_gambar',
        'konten_promosi_text',
        'konten_simulasi',
        'konten_sk',
        'konten_approval',
    ];
    // }
    protected $updatedField = 'updated_at';

    public function getAllKirimanUang(){
        $query = $this->db->table('dbo_konten')
        ->where('konten_parent = 39')
        ->orderBy('konten_id', 'asc')
        ->get()->getResultArray();  
        return $query;
     }

        public function findDetailKirimanUangById($id)
    {
        $dbo_konten = $this
            ->asArray()
            ->where(['konten_id' => $id])
            ->first();
        if (!$dbo_konten) throw new Exception('Could not find client for specified ID');

        return $dbo_konten;
    }

    
}