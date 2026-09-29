<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInstagramPostsTable extends Migration
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

            // ==========================
            // CRUD MANUAL
            // ==========================

            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'thumbnail' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            'instagram_url' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'tanggal_post' => [
                'type' => 'DATE',
                'null' => true,
            ],

            'caption' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            // ==========================
            // PERSIAPAN INSTAGRAM API
            // ==========================

            'instagram_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],

            'media_url' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'thumbnail_url' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'permalink' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'media_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'default'    => 'IMAGE',
            ],

            'posted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            // ==========================
            // TIMESTAMP
            // ==========================

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

        $this->forge->createTable('instagram_posts');
    }

    public function down()
    {
        $this->forge->dropTable('instagram_posts');
    }
}