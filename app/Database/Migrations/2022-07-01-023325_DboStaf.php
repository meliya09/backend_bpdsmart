<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DboStaf extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'staf_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'level_id' => [
                'type' => 'INT',
                'constraint' => '100',
                'null' => false
            ],
            'staf_akses' => [
                'type' => 'INT',
                'constraint' => '100',
                'null' => false,
            ],
            'staf_admin' => [
                'type' => 'INT',
                'constraint' => '100',
                'null' => false,
            ],
            'staf_nip' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'staf_nama' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'staf_gelar' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'staf_jabatan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'staf_tempat_lahir' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'staf_tgl_lahir' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'staf_alamat' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ],
            'staf_kelamin' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'staf_agama' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'staf_telp' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'staf_email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
                'unique' => true
            ],
            'staf_password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true
            ],
            'staf_update_password' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'staf_wa' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'staf_foto' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'staf_status' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
        
        ]);
        $this->forge->addPrimaryKey('staf_id');
        $this->forge->addForeignKey('level_id', 'dbo_level', 'level_id');
        $this->forge->createTable('dbo_staf');
    }

    public function down()
    {
        //
    }
}
