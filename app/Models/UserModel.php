<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user'; // ganti sesuai PK kamu
    protected $allowedFields = ['username', 'email', 'password']; // ganti sesuai isi field tabel kamu
}
