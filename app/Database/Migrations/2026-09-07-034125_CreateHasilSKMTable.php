<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHasilSKMTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'periode_bulan' => [
                'type'       => 'TINYINT',
                'constraint' => 2,
                'unsigned'   => true,
            ],

            'periode_tahun' => [
                'type'       => 'YEAR',
            ],

            'kecamatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'jumlah_responden' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'default'    => 0,
            ],

            'nilai_ikm' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 0,
            ],

            'dokumen' => [
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

        $this->forge->createTable('hasil_skm');
    }

    public function down()
    {
        $this->forge->dropTable('hasil_skm');
    }
}