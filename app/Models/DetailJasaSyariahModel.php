<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class DetailJasaSyariahModel extends Model
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
    ];
    // }
    protected $updatedField = 'updated_at';

    public function getAllJasaSyariah(){
        $query = $this->db->table('dbo_konten')
        ->where('konten_parent = 47')
        ->orderBy('konten_id', 'asc')
        ->get()->getResultArray();  
        return $query;
     }

        public function findDetailJasaSyariahById($id)
    {
        $dbo_konten = $this
            ->asArray()
            ->where(['konten_id' => $id])
            ->first();
        if (!$dbo_konten) throw new Exception('Could not find client for specified ID');

        return $dbo_konten;
    }

    
}