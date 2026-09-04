<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDilihatToDokumen extends Migration
{
    public function up()
    {
        $fields = [
            'dilihat' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'after'      => 'status',
            ],
        ];

        $this->forge->addColumn('dokumen', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('dokumen', 'dilihat');
    }
}