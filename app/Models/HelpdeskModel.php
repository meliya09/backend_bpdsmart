<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class HelpdeskModel extends Model
{
    protected $table = 'dbo_staf';
    protected $primaryKey = 'staf_id';
    protected $allowedFields = [
        'level_id',
        'staf_nama', 
        'staf_jabatan',
        'staf_telp',
        'staf_email',
    ];
    protected $updatedField = 'updated_at';

    public function getHelpdesk(){
        $query = $this->db->table('dbo_staf')
        ->join('dbo_level' , 'dbo_staf.level_id = dbo_level.level_id')
        ->orderBy('staf_id', 'asc')
        ->get()->getResultArray();  
        return $query;
     }

    public function findHelpdeskById($id)
    {
        $helpdesk = $this
            ->asArray()
            ->where(['staf_id' => $id])
            ->first();

        if (!$helpdesk) throw new Exception('Could not find helpdesk for specified ID');

        return $helpdesk;
    }
}