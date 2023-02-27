<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class LevelLinkModel extends Model
{
    protected $table = 'dbo_level_link_konten';
    protected $primaryKey = 'level_link_id';
    protected $allowedFields = [
        'level_id', 
        'konten_id', 
    ];
    protected $updatedField = 'updated_at';

    public function getAllLevelLink(){
        $query = $this->db->query("SELECT  
        dbo_level_link_konten.level_id, 
        dbo_level_link_konten.konten_id, 
        dbo_konten.konten_menu 
        from dbo_level_link_konten join dbo_level on dbo_level.level_id = dbo_level_link_konten.level_id 
        join dbo_konten on dbo_konten.konten_id = dbo_level_link_konten.konten_id
        order by  
        dbo_level_link_konten.level_link_id"); 
         
        return $query->getResult(); 
    }

    public function getByLevelId($level_id){
        $query = $this->db->table('dbo_level_link_konten')
        ->where('level_id', $level_id) 
        ->orderBy('level_id', 'asc')
        ->get()->getResultArray();  
        return $query;
    }    

    public function findLevelLinkById($id)
    {
        $dbo_level_link_konten = $this
            ->asArray()
            ->where(['level_link_id' => $id])
            ->first();
 
        if (!$dbo_level_link_konten) throw new Exception('Could not find level for specified ID');

        return $dbo_level_link_konten;
    }

    
}