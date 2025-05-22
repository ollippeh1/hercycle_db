<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use FFI;

class Edukasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_edukasi' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
            ],
            'admin_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
            ],
            'artikel' => [
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

        $this->forge->addKey('id_edukasi', TRUE);
        $this->forge->addForeignKey('user_id', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('admin_id', 'admin', 'id_admin', 'CASCADE', 'CASCADE');
        $this->forge->createTable('edukasi');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('edukasi');
    }
}