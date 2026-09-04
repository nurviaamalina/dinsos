<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBidangDetailTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'id_bidang' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
            ],

            'tentang' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'ruang_lingkup' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'tugas_pokok' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'program_kegiatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
            ],

            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],

            'alamat' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
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

        // Relasi ke tabel bidang
        $this->forge->addForeignKey(
            'id_bidang',
            'bidang',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('bidang_detail');
    }

    public function down()
    {
        $this->forge->dropTable('bidang_detail');
    }
}