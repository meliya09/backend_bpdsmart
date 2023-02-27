<?php 

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DboUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [ 
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_nama' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'user_email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
                'unique' => true
            ],
            'user_password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true
            ],
            'level_id' => [
                'type' => 'INT',
                'constraint' => '100',
                'null' => false
            ],
            'user_akses' => [
                'type' => 'INT',
                'constraint' => '100',
                'null' => false,
            ],
            'user_admin' => [
                'type' => 'INT',
                'constraint' => '100',
                'null' => false,
            ],
            'user_nip' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'user_gelar' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'user_jabatan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'user_tempat_lahir' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'user_tgl_lahir' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'user_alamat' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ],
            'user_kelamin' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'user_agama' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'user_telp' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'user_update_password' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'user_wa' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'user_foto' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'user_status' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            
            'user_time timestamp default now()'
        ]);
        $this->forge->addPrimaryKey('user_id');
        $this->forge->addForeignKey('level_id', 'dbo_level', 'level_id');
        $this->forge->createTable('dbo_user');
    }

    public function down()
    {
        $this->forge->dropTable('dbo_user');
    }
}
