<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DboFasilitas extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'fasilitas_id' => [
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
            'fasilitas_nama' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false
            ],
            
        ]);
        $this->forge->addPrimaryKey('fasilitas_id');
        $this->forge->addForeignKey('konten_id', 'dbo_konten', 'konten_id');
        $this->forge->createTable('dbo_fasilitas');
    }

    public function down()
    {
        //
    }
}
