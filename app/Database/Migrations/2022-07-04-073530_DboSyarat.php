<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DboSyarat extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'syarat_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'konten_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => false,
            ],
            'syarat_nama' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false
            ],
            
        ]);
        $this->forge->addPrimaryKey('syarat_id');
        $this->forge->addForeignKey('konten_id', 'dbo_konten', 'konten_id');
        $this->forge->createTable('dbo_syarat');
    }

    public function down()
    {
        //
    }
}
