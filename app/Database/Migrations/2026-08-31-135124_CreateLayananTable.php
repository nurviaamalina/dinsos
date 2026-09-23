<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLayananTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_layanan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'bidang' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            // Kolom untuk Rich Text Editor (Quill)
            'deskripsi_layanan' => [
                'type' => 'LONGTEXT', // Diubah ke LONGTEXT agar muat HTML panjang
                'null' => true,
            ],
            'dasar_hukum' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'persyaratan' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'sistem_mekanisme_prosedur' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'jangka_waktu_pelayanan' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'biaya_tarif' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'produk_pelayanan' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'penanganan_pengaduan' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'sarana_prasarana_fasilitas' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'kompetensi_pelaksana' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'pengawasan_internal' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'jumlah_pelaksana' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'jaminan_pelayanan' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'jaminan_keamanan_keselamatan' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'evaluasi_kinerja_pelaksana' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'status_layanan' => [
                'type'       => 'ENUM',
                'constraint' => ['Aktif', 'Nonaktif'],
                'default'    => 'Aktif',
            ],
            // Kolom untuk Upload Gambar
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
                'after'      => 'status_layanan',
            ],
            // Kolom untuk Upload Dokumen (SOP)
            'dokumen' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
                'after'      => 'gambar',
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
        $this->forge->createTable('layanan');
    }

    public function down()
    {
        $this->forge->dropTable('layanan');
    }
}