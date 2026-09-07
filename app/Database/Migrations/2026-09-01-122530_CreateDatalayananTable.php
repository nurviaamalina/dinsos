<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDatalayananTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'periode' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ],
            'layanan' => [
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => false,
            ],
            'bidang' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'kecamatan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'selesai' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'proses' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => null,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => null,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('datalayanan');
    }

    public function down()
    {
        $this->forge->dropTable('datalayanan');
    }
}