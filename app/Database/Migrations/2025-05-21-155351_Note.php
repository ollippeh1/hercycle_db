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
            'keluhan' => [
                'type' => 'TEXT',
                'null' => FALSE,
            ],
            'mood' => [
                'type' => 'ENUM',
                'constraint' => ['Tenang', 'Senang', 'Enerjik', 'Lincah'],
                'null' => FALSE,
            ],
            'symptoms' => [
                'type' => 'ENUM',
                'constraint' => ['Semuanya baik-baik saja', 'Kram', 'Sakit kepala', 'Jerawat', 'Sakit punggung', 'Kelelahan', 'Mengidam', 'Insomnia', 'Sakit perut', 'Gatal pada vagina', 'Vagina kering'],
                'null' => FALSE,
            ],
            'intercourse' => [
                'type' => 'ENUM',
                'constraint' => ['Tidak berhubungan seks', 'Seks yang dilindungi', 'Seks tanpa perlindungan', 'Seks oral', 'Seks anal', 'Onani', 'Sentuhan sensual', 
                        'Mainan seks', 'Orgasme', 'Gairah seks tinggi', 'Dorongan seks netral', 'Gairah seks rendah'],
                'null' => FALSE,
            ],
            'gelas_perhari' => [
                'type' => 'INT',
                'constraint' => 10,
                'null' => FALSE,
            ],
            'test_ovulasi' => [
                'type' => 'ENUM',
                'constraint' => ['Tidak mengikuti tes', 'Tes : positif', 'Tes : negatif', 'Ovulasi : metode saya'],
                'null' => FALSE,
            ],
            'pilih' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE,
            ],
            'pesan' => [
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