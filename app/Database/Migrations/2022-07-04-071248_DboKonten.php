<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DboKonten extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'konten_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'konten_parent' => [
                'type' => 'INT',
                'constraint' => '100',
                'null' => false
            ],
            'konten_urut' => [
                'type' => 'INT',
                'constraint' => '100',
                'null' => false,
            ],
            'kategori_id' => [
                'type' => 'INT',
                'constraint' => '5',
                'null' => false,
            ],
            'konten_simulasi' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ],
            'konten_suku_bunga' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ],
            'konten_menu' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ],
            'konten_judul' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ],
            'konten_subjudul' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ],
            'konten_gambar' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ],
            'konten_gambar2' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ],
            'konten_gambar3' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ],
            'konten_deskripsi' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'konten_syarat' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'konten_ketentuan' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'konten_fasilitas' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'konten_promosi_gambar' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ],
            'konten_promosi_text' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'konten_sk' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'konten_status' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ],
            'konten_update' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'konten_approval' => [
                'type' => 'INT',
                'constraint' => '50',
                'null' => false,
            ],
        ]);
        $this->forge->addPrimaryKey('konten_id');
        $this->forge->addForeignKey('kategori_id', 'dbo_kategori', 'kategori_id');
        $this->forge->createTable('dbo_konten');
    }

    public function down()
    {
        //
    }
}
