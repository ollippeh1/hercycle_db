<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class materi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'judul' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'deskripsi' => [
                'type' => 'TEXT'
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'tanggal' => [
                'type' => 'DATE'
            ],
            'kategori' => [
                'type' => 'ENUM',
                'constraint' => ['haid', 'hamil']
            ],
            'penulis' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('materi');
    }

    public function down()
    {
        $this->forge->dropTable('materi');
    }
}
