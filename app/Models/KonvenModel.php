<?php 
 
namespace App\Models; 
 
use CodeIgniter\Model; 
use Exception; 
 
class KonvenModel extends Model 
{ 
    protected $table = 'dbo_konten'; 
    protected $primaryKey = 'konten_id'; 
    protected $allowedFields = [ 
        'konten_parent', 
        'konten_menu', 
        'kategori_id', 
        'kategori_nama', 
        
    ]; 
    // } 
    protected $updatedField = 'updated_at'; 
 
    public function getAllKonven(){ 
        // $query = $this->db->query("SELECT  
        // --  dbo_konten.kategori_id, 
        // -- dbo_konten.konten_menu, 
        // -- dbo_konten.konten_url, 
        // -- dbo_kategori.kategori_nama,
        // -- dbo_level_link_konten.konten_id,
		// -- dbo_level_link_konten.level_id
        // -- from dbo_konten join dbo_kategori on dbo_kategori.kategori_id = dbo_konten.kategori_id 
		// -- join dbo_level_link_konten on dbo_level_link_konten.konten_id = dbo_konten.konten_id

        // -- dbo_konten.konten_id, 
        // -- dbo_konten.kategori_id, 
        // -- dbo_konten.konten_menu, 
        // -- dbo_konten.konten_url, 
        // -- dbo_kategori.kategori_nama  
        // -- from dbo_kategori join dbo_konten on dbo_kategori.kategori_id = dbo_konten.kategori_id 
        // where dbo_konten.konten_parent=2 
        // order by  
        // dbo_konten.konten_id"); 
         
        // return $query->getResult(); 
       $query = $this->db->table('dbo_konten') 
       ->where('konten_parent = 2') 
       ->join('dbo_kategori' , 'dbo_konten.kategori_id = dbo_kategori.kategori_id') 
       ->orderBy('konten_id', 'asc') 
       ->get()->getResultArray();   
 
       return $query; 
    } 
    
    // public function findKonvenByLevelId($level_id) 
    // { 
    //     $konten = $this->db->table('dbo_konten'); 
    //     $konten->select(' dbo_konten.kategori_id, 
    //     dbo_konten.konten_menu, 
    //     dbo_konten.konten_url, 
    //     dbo_kategori.kategori_nama,
    //     dbo_level_link_konten.konten_id,
	// 	dbo_level_link_konten.level_id'); 
    //     $konten->join('dbo_kategori', 'dbo_konten.kategori_id = dbo_kategori.kategori_id'); 
    //     $konten->join('dbo_level_link_konten', 'dbo_konten.konten_id = dbo_level_link_konten.konten_id'); 
    //     $konten->where('dbo_level_link_konten.level_id', $level_id); 
    //     $query = $konten->get(); 
    //     return $query->getRowArray(); 
    // } 

    public function findKonvenByLevelId($id){
        $query = $this->db->table('dbo_konten')
        ->join('dbo_kategori' , 'dbo_konten.kategori_id = dbo_kategori.kategori_id')
        ->join('dbo_level_link_konten' , 'dbo_konten.konten_id = dbo_level_link_konten.konten_id')
        ->where('dbo_level_link_konten.level_id', $id) 
        
        ->get()->getResultArray();  
        return $query;
    }    
    
 
    public function findKonvenById($id) 
    { 
        $konten = $this->db->table('dbo_konten'); 
        $konten->select('*'); 
        $konten->join('dbo_kategori', 'dbo_konten.kategori_id = dbo_kategori.kategori_id'); 
        $konten->where('dbo_konten.konten_id', $id); 
        $query = $konten->get(); 
        return $query->getRowArray(); 
 
        // $dbo_konten = $this 
        //     ->asArray() 
        //     ->where(['konten_id' => $id]) 
        //     ->first(); 
        
        // if (!$dbo_konten) throw new Exception('Could not find client for specified ID'); 
 
        // return $dbo_konten; 
    } 
 
     
}
