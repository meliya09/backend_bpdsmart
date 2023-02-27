<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class LevelModel extends Model
{
    protected $table = 'dbo_level';
    protected $primaryKey = 'level_id';
    protected $allowedFields = [
        'level_nama', 
        'level_akses', 
        'level_id',
      
    ];
    protected $updatedField = 'updated_at';

    public function getAllLevel(){
    //    $query = $this->db->query("SELECT * FROM dbo_konten WHERE konten_parent=2");
       
    //    return $query->getResult();
    //    $query = $this->db->table('dbo_level')
    //    ->orderBy('level_id', 'asc')
    //    ->get()->getResultArray();   

    //    return $query;

       $query = $this->db->query("SELECT  
       dbo_level.level_id,
       dbo_level.level_nama, 
       dbo_level_link_konten.konten_id,
       dbo_konten.konten_menu
       from dbo_level left join dbo_level_link_konten on dbo_level.level_id = dbo_level_link_konten.level_id
       left join dbo_konten on dbo_level_link_konten.konten_id = dbo_konten.konten_id
       order by  
       dbo_level.level_id"); 
        
       return $query->getResult(); 
    }
    public function findLevelById($id)
    {
        $dbo_level = $this
            ->asArray()
            ->where(['level_id' => $id])
            ->first();

        if (!$dbo_level) throw new Exception('Could not find level for specified ID');

        return $dbo_level;
    }

    
}