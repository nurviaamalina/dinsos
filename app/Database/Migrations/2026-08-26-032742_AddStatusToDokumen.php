<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusToDokumen extends Migration
{
    public function up()
    {
        $fields = [
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'draft',
                'after'      => 'tahun',
            ],
        ];

        $this->forge->addColumn('dokumen', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('dokumen', 'status');
    }
}