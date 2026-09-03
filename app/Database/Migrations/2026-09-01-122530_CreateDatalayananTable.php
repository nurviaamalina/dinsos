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
            'pendaftar' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
                'default' => 'Pending',
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'jenis_kendaraan' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'merek_kendaraan' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'warna_kendaraan' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => true,
            ],
            'lokasi_kendaraan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'kategori_kendaraan' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
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