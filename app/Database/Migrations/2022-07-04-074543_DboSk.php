<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DboSk extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'sk_id' => [
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
            'sk_nomor' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            'sk_tgl' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            'sk_perihal' => [
                'type' => 'TEXT',
                'null' => false
            ]
            
        ]);
        $this->forge->addPrimaryKey('sk_id');
        $this->forge->addForeignKey('konten_id', 'dbo_konten', 'konten_id');
        $this->forge->createTable('dbo_sk');
    }

    public function down()
    {
        //
    }
}
