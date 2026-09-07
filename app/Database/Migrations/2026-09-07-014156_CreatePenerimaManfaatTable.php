<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenerimaManfaatTable extends Migration
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

            'kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'jumlah' => [
                'type'       => 'INT',
                'unsigned'   => true,
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

        $this->forge->createTable('penerima_manfaat');
    }

    public function down()
    {
        $this->forge->dropTable('penerima_manfaat');
    }
}