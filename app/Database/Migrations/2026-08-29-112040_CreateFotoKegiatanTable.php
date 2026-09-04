<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFotoKegiatanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'kegiatan_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],

            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey(
            'kegiatan_id',
            'kegiatan',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('foto_kegiatan');
    }

    public function down()
    {
        $this->forge->dropTable('foto_kegiatan');
    }
}