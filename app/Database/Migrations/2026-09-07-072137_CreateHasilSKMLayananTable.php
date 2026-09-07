<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHasilSKMLayananTable extends Migration
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

            'nama_layanan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
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

        $this->forge->createTable('hasil_skm_layanan');
    }

    public function down()
    {
        $this->forge->dropTable(
            'hasil_skm_layanan'
        );
    }
}