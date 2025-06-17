<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kalender extends Migration
{
    public function up()
    {
        $this->forge->addField([
             'tanggal_mulai_haid' => [
                'type' => 'DATE',
                'null' => FALSE,
             ],

             'tanggal_akhir_haid' => [
                'type' => 'DATE',
                'null'=>FALSE,
             ],

            'id_kalender' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true, // Boleh null kalau belum login
            ],
            'tanggal_haid' => [
                'type' => 'DATE',
            ],
            'siklus_haid' => [
                'type'       => 'INT',
                'constraint' => 3,
                'default'    => 28,
            ],
            'lama_haid' => [
                'type'       => 'INT',
                'constraint' => 2,
                'default'    => 5,
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
        $this->forge->addKey('id_kalender', true);
        $this->forge->createTable('kalender');
    }

    public function down()
    {
        $this->forge->dropTable('kalender');
    }
}
