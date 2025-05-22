<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use FFI;

class Note extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_note' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
            ],
            'hasil_saran' => [
                'type' => 'TEXT',
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

        $this->forge->addKey('id_note', TRUE);
        $this->forge->addForeignKey('user_id', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('note');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('note');
    }
}