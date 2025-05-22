<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Chat extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_chat' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
            ],
            'respon' => [
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

        $this->forge->addKey('id_chat', TRUE);
        $this->forge->addForeignKey('user_id', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('chat');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('chat');
    }
}