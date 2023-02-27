<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DboLevelLinkKonten extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'index' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'level_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => false,
            ],
            'konten_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => false,
            ],
        ]);
        $this->forge->addPrimaryKey('index');
        $this->forge->addForeignKey('level_id', 'dbo_level', 'level_id');
        $this->forge->addForeignKey('konten_id', 'dbo_konten', 'konten_id');
        $this->forge->createTable('dbo_level_link_konten');
    }

    public function down()
    {
        //
    }
}
