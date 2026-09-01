<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLayananTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_layanan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'bidang' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            // Kolom untuk Rich Text Editor (Quill)
            'deskripsi_layanan' => [
                'type' => 'LONGTEXT', // Diubah ke LONGTEXT agar muat HTML panjang
                'null' => true,
            ],
            'standar_layanan' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'prosedur_layanan' => [
                'type' => 'LONGTEXT', // Diubah ke LONGTEXT agar muat HTML panjang
                'null' => true,
            ],
            'status_layanan' => [
                'type'       => 'ENUM',
                'constraint' => ['Aktif', 'Nonaktif'],
                'default'    => 'Aktif',
            ],
            // Kolom untuk Upload Gambar
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
                'after'      => 'status_layanan',
            ],
            // Kolom untuk Upload Dokumen (SOP)
            'dokumen' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
                'after'      => 'gambar',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('layanan');
    }

    public function down()
    {
        $this->forge->dropTable('layanan');
    }
}