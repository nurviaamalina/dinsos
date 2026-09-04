<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKategoriDokumen extends Migration
{
    public function up()
    {
        $this->forge->addField([

            // ID
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            // NAMA KATEGORI
            'nama_kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            // SLUG
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
            ],

            // DESKRIPSI
            'deskripsi' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],

            // CREATED AT
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            // UPDATED AT
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable(
            'kategori_dokumen',
            true
        );
    }


    public function down()
    {
        $this->forge->dropTable(
            'kategori_dokumen',
            true
        );
    }
}