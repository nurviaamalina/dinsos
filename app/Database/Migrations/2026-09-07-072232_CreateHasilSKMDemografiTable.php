<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHasilSKMDemografiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'hasil_skm_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],

            'jenis' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'jumlah' => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 0,
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

        $this->forge->addForeignKey(
            'hasil_skm_id',
            'hasil_skm',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable(
            'hasil_skm_demografi'
        );
    }

    public function down()
    {
        $this->forge->dropTable(
            'hasil_skm_demografi'
        );
    }
}