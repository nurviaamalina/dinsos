<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHasilSKMImportTable extends Migration
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

            'nama_file' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'format_file' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],

            'mapping_kolom' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'header_asli' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'data_asli' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],

            'created_at' => [
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
            'hasil_skm_import'
        );
    }

    public function down()
    {
        $this->forge->dropTable(
            'hasil_skm_import'
        );
    }
}