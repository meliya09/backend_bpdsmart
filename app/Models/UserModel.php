<?php
 
namespace App\Models;

use CodeIgniter\Model;
use Exception;

class UserModel extends Model
{
    protected $table = 'dbo_user';
    protected $primaryKey = 'user_id';
    protected $allowedFields = [
        'user_nama',
        'user_email',
        'user_password',
        'user_jabatan',
        'user_telp',
        'level_id',
    ];
    protected $updatedField = 'updated_at';

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