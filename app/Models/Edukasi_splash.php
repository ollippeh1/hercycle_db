<?php

namespace App\Models;

use CodeIgniter\Model;

class Edukasi_splash extends Model
{
    protected $table = 'edukasi'; // nama tabel di database kamu
    protected $primaryKey = 'id_edukasi';
    protected $allowedFields = ['judul', 'gambar','tanggal','penulis']; // sesuaikan dengan kolom tabel kamu
}
