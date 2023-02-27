<?php 
 
namespace App\Models; 
 
use CodeIgniter\Model; 
use Exception; 
 
class StafModel extends Model 
{ 
    protected $table = 'dbo_user'; 
    protected $primaryKey = 'user_id'; 
    protected $allowedFields = [ 
        'user_nama', 
        'user_jabatan',
        'user_email',
        'user_password',
        'user_telp',
        'level_id', 
        'level_nama',
        'user_admin', 
    ]; 
    // } 
    protected $updatedField = 'updated_at'; 
 
    public function getAllUser(){ 
        $query = $this->db->query("SELECT  
        -- dbo_user.user_id, 
        -- dbo_user.user_nama,
        -- dbo_user.user_jabatan,
        -- dbo_user.user_email,
        -- dbo_user.user_telp,
        -- dbo_user.level_id, 
        -- dbo_user.user_admin, 
        -- dbo_level.level_nama  
        -- from dbo_user join dbo_level on dbo_level.level_id = dbo_user.level_id 
        -- join dbo_level_link_konten on dbo_level_link_konten.level_id = dbo_user.level_id  

        dbo_user.user_id,
        dbo_user.user_nama, 
        dbo_user.user_jabatan,
        dbo_user.user_email,
        dbo_user.user_telp,
        dbo_user.user_admin,
        dbo_level.level_nama,
        dbo_level_link_konten.konten_id, 
        dbo_level_link_konten.level_id,
        dbo_konten.konten_menu
        from dbo_user left join dbo_level on dbo_level.level_id = dbo_user.level_id 
        left join dbo_level_link_konten on dbo_user.level_id = dbo_level_link_konten.level_id
        left join dbo_konten on dbo_level_link_konten.konten_id = dbo_konten.konten_id
        order by  
        dbo_user.user_id"); 
         
        return $query->getResult(); 
    } 
 
    public function findUserById($id) 
    { 
        $users = $this->db->table('dbo_user'); 
        $users->select('*'); 
        $users->join('dbo_level', 'dbo_user.level_id = dbo_level.level_id'); 
        $users->where('dbo_user.user_id', $id); 
        $query = $users->get(); 
        return $query->getRowArray(); 
    } 

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data): array
    {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    protected function beforeUpdate(array $data): array
    {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    private function getUpdatedDataWithHashedPassword(array $data): array
    {
        if (isset($data['data']['user_password'])) {
            $plaintextPassword = $data['data']['user_password'];
            $data['data']['user_password'] = $this->hashPassword($plaintextPassword);
        }
        return $data;
    } 


    private function hashPassword(string $plaintextPassword): string
    {
        return password_hash($plaintextPassword, PASSWORD_BCRYPT);
    }
                                      
    public function findUserByEmailAddress(string $emailAddress)
    {
        $dbo_user = $this
            ->asArray()
            ->where(['user_email' => $emailAddress])
            ->first();

        if (!$dbo_user) 
            throw new Exception('User does not exist for specified email address');

        return $dbo_user;
    }
 
     
}
