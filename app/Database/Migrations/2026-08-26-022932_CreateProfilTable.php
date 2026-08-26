<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProfilTable extends Migration
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

            'sejarah' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'visi' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'misi' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'sasaran_strategis' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'kontak' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],

            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],

            'instagram' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            'facebook' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            'struktur' => [
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

        $this->forge->createTable('profil');
    }

    public function down()
    {
        $this->forge->dropTable('profil');
    }
}