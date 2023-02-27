<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DboKetentuan extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'ketentuan_id' => [
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
            'ketentuan_judul' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false
            ],
            'ketentuan_deskripsi' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false
            ],
            'ketentuan_ket' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false
            ],
            
        ]);
        $this->forge->addPrimaryKey('ketentuan_id');
        $this->forge->addForeignKey('konten_id', 'dbo_konten', 'konten_id');
        $this->forge->createTable('dbo_ketentuan');
    }

    public function down()
    {
        //
    }
}
