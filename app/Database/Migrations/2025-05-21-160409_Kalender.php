<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use FFI;

class Kalender extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kalender' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
            ],
            'siklus_haid' => [
                'type' => 'INT',
                'constraint' => 10,
                'null' => FALSE,
            ],
            'tanggal_akhir_haid' => [
                'type' => 'DATE',
                'null' => FALSE,
            ],
            'lama_haid' => [
                'type' => 'INT',
                'constraint' => 100,
                'null' => FALSE,
            ],
            'gambar_perkembangan_janin' => [
                'type' => 'TEXT',
                'null' => FALSE,
            ],
            'siklus_hamil' => [
                'type' => 'INT',
                'constraint' => 10,
                'null' => FALSE,
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => TRUE
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => TRUE
            ]
        ]);

        $this->forge->addKey('id_kalender', TRUE);
        $this->forge->addForeignKey('user_id', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kalender');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('kalender');
    }
}