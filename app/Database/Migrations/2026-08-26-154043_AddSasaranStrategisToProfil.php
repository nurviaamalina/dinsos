<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSasaranStrategisToProfil extends Migration
{
    public function up()
    {
        $this->forge->addColumn('profil', [

            'sasaran_strategis' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'visi_misi',
            ],

        ]);
    }

    public function down()
    {
        $this->forge->dropColumn(
            'profil',
            'sasaran_strategis'
        );
    }
}