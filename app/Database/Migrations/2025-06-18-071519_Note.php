<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Note extends Migration
{
  public function up()
{
    $this->forge->addField([
        'id'              => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
        'condition'       => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
        'intercourse'     => ['type' => 'TEXT', 'null' => true],
        'moods'           => ['type' => 'TEXT', 'null' => true],
        'symptoms'        => ['type' => 'TEXT', 'null' => true],
        'weight'          => ['type' => 'INT', 'null' => true],
        'height'          => ['type' => 'INT', 'null' => true],
        'drink_water'     => ['type' => 'INT', 'default' => 0],
        'ovulation_test'  => ['type' => 'ENUM', 'constraint' => ['Positive', 'Negative'], 'null' => true],
        'created_at'      => ['type' => 'DATETIME', 'null' => true],
        'updated_at'      => ['type' => 'DATETIME', 'null' => true],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('notes');
}


    public function down()
    {
        $this->forge->dropTable('notes');
    }
}
