<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use FFI;

class Admin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_admin' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
                'unique'     => TRUE
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
                'unique' => TRUE,
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

        $this->forge->addKey('id_admin', TRUE);
        $this->forge->createTable('admin');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('admin');
    }
}