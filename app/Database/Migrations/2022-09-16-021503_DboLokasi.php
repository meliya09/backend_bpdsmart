<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DboLokasi extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'lokasi_id' => [
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
            'lokasi_level' => [
                'type' => 'INT',
                'constraint' => '50',
                'null' => false
            ],
            'lokasi_parent' => [
                'type' => 'INT',
                'constraint' => '50',
                'null' => false
            ],
            'lokasi_kategori' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            'lokasi_gambar' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false
            ],
            'lokasi_nama' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false
            ],
            'lokasi_alamat' => [
                'type' => 'TEXT',
                'null' => false
            ],
            'lokasi_telp' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            'lokasi_fax' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            'lokasi_lat' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            'lokasi_lon' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],

            
        ]);
        $this->forge->addPrimaryKey('lokasi_id');
        $this->forge->addForeignKey('konten_id', 'dbo_konten', 'konten_id');
        $this->forge->createTable('dbo_lokasi');
    }

    public function down()
    {
        //
    }
}
