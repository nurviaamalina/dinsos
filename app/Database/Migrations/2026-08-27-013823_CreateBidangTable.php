<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBidangTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'nama_bidang' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],

            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['aktif', 'tidak_aktif'],
                'default'    => 'aktif',
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

        $this->forge->createTable('bidang');
    }


    public function down()
    {
        $this->forge->dropTable('bidang');
    }
}