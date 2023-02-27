<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DboKategori extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'kategori_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kategori_nama' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            
        ]);
        $this->forge->addPrimaryKey('kategori_id');
        $this->forge->createTable('dbo_kategori');
    }

    public function down()
    {
        //
    }
}
