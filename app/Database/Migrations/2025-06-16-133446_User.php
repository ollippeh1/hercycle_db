<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use FFI;

class user extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
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
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
            ],
            'usia' => [
                'type' => 'INT',
                'constraint' => 10,
                'null' => FALSE,
            ],
            'tinggi' => [
                'type' => 'INT',
                'constraint' => 10,
                'null' => FALSE,
            ],
            'berat' => [
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

        $this->forge->addKey('id_user', TRUE);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}