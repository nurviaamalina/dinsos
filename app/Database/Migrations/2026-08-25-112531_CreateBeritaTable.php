<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBeritaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            // ==========================================
            // ID
            // ==========================================

            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],


            // ==========================================
            // KODE BERITA
            // ==========================================

            'kode' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],


            // ==========================================
            // JUDUL
            // ==========================================

            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],


            // ==========================================
            // SLUG
            // ==========================================

            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],


            // ==========================================
            // ISI BERITA
            // ==========================================

            'isi' => [
                'type' => 'TEXT',
                'null' => false,
            ],


            // ==========================================
            // GAMBAR / THUMBNAIL
            // ==========================================

            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],


            // ==========================================
            // PUBLIKATOR
            // ==========================================

            'publikator' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => false,
            ],


            // ==========================================
            // TANGGAL
            // ==========================================

            'tanggal' => [
                'type' => 'DATE',
                'null' => false,
            ],


            // ==========================================
            // VIEWS
            // ==========================================

            'views' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'default'    => 0,
                'null'       => false,
            ],


            // ==========================================
            // STATUS
            // ==========================================

            'status' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'draft',
                    'publik',
                ],
                'default'    => 'draft',
                'null'       => false,
            ],


            // ==========================================
            // TIMESTAMP
            // ==========================================

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

        ]);


        // ==========================================
        // PRIMARY KEY
        // ==========================================

        $this->forge->addKey('id', true);


        // ==========================================
        // UNIQUE SLUG
        // ==========================================

        $this->forge->addUniqueKey('slug');


        // ==========================================
        // CREATE TABLE
        // ==========================================

        $this->forge->createTable('berita');
    }


    public function down()
    {
        $this->forge->dropTable('berita');
    }
}