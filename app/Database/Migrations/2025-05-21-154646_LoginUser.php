<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Login_user extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_loginuser' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
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
            'created_at' => [
                'type' => 'datetime',
                'null' => TRUE
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => TRUE
            ]
        ]);

        $this->forge->addKey('id_loginuser', TRUE);
        $this->forge->addForeignKey('user_id', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('email', 'user', 'email', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('username', 'user', 'username', 'CASCADE', 'CASCADE');
        $this->forge->createTable('login_user');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('login_user');
    }
}