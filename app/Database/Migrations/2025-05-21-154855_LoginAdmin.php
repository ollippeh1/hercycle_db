<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Login_admin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_loginadmin' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'admin_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
                'unique' => TRUE
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

        $this->forge->addKey('id_loginadmin', TRUE);
        $this->forge->addForeignKey('admin_id', 'admin', 'id_admin', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('email', 'admin', 'email', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('username', 'admin', 'username', 'CASCADE', 'CASCADE');
        $this->forge->createTable('login_admin');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('login_admin');
    }
}