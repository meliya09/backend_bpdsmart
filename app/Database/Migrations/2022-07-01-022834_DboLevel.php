<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DboLevel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'level_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'level_kode' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'level_nama' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'level_akses' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
        ]);
        $this->forge->addPrimaryKey('level_id');
        $this->forge->createTable('dbo_level');
    }

    public function down()
    {
        //
    }
}
