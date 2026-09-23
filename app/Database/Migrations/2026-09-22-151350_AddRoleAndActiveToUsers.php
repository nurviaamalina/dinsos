<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleAndActiveToUsers extends Migration
{
    public function up()
    {
        $fields = [
            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'admin',
                'after'      => 'password',
            ],

            'active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'after'      => 'role',
            ],
        ];

        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', [
            'role',
            'active',
        ]);
    }
}