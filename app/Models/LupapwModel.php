<?php namespace App\Models;

use CodeIgniter\Model;

class LupapwModel extends Model
{
    protected $table = 'password_resets'; // pastikan ini sesuai dengan nama tabel OTP-mu
    protected $primaryKey = 'id'; // atau sesuai dengan kolom primary-mu

    protected $allowedFields = [
        'email',
        'token',       // pastikan kolom ini ada di database
        'expires_at',
        'created_at'
    ];

    protected $useTimestamps = false; // set true kalau kamu pakai updated_at, created_at otomatis
}

