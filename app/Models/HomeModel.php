<?php
 
namespace App\Models;

use CodeIgniter\Model;
use Exception;

class HomeModel extends Model
{ 
    protected $table = 'dbo_konten';
    protected $primaryKey = 'konten_id';
    protected $allowedFields = [
        'konten_parent',
        'konten_menu',
        'konten_judul',
        'konten_subjudul',
        'konten_gambar',
        'file_path',
        'konten_deskripsi', 
        'konten_url',  
        'konten_approval',
    ];
    
    protected $updatedField = 'updated_at';

    public function getAllListHome(){
        $query = $this->db->table('dbo_konten')
        ->where('konten_parent = 93') 
        ->limit(3)      
        ->orderBy('konten_id', 'desc')
        ->get()->getResultArray(); 
        return $query;
     }

    //  public function getNotif(){
    //     $query = $this->db->table('dbo_konten')
    //     ->where('konten_approval = 0')  
    //     ->get()->getResultArray(); 
    //     return $query;
    //  }

     public function getNotif(){
        $query = $this->db->query("SELECT 
        count(dbo_konten.konten_approval)
        from dbo_konten 
        where dbo_konten.konten_approval= 0");
        
        return $query->getResult();
     }

     public function getHome($id)
     {
         $dbo_konten = $this
             ->asArray()
             ->where(['konten_id' => $id])
             ->first();
         if (!$dbo_konten) throw new Exception('Could not find client for specified ID');
 
         return $dbo_konten;
     }
 
    
}