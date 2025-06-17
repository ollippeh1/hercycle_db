<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    
    protected $table = 'user';
    protected $primaryKey = 'id_user'; 
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['username', 'email', 'password', 'usia', 'tinggi', 'berat'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'username'  => 'required|min_length[3]|max_length[255]|is_unique[user.username]',
        'email'     => 'required|valid_email|is_unique[user.email]',
        'password'  => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/]',
        'usia'      => 'required|numeric|greater_than_equal_to[9]|less_than_equal_to[50]',
        'tinggi'    => 'required|numeric|greater_than_equal_to[140]|less_than_equal_to[200]',
        'berat'     => 'required|numeric|greater_than_equal_to[35]|less_than_equal_to[150]'
    ];


    public $validationMessages = [
        'username' => [
            'is_unique' => 'Maaf, username tersebut sudah digunakan. Silakan pilih yang lain.',
            'required' => 'Username wajib diisi.',
            'min_length' => 'Username minimal 3 karakter.'
        ],
        'email' => [
            'is_unique' => 'Maaf, email tersebut sudah terdaftar. Silakan pilih yang lain.',
            'required' => 'Email wajib diisi.',
            'valid_email' => 'Format email tidak valid.'
        ],
        'password' => [
            'required' => 'Password wajib diisi.',
            'min_length' => 'Password minimal 8 karakter.',
            'regex_match'   => 'Password harus mengandung minimal 1 huruf besar, 1 huruf kecil, dan 1 angka.'
        ],
        'confirm' => [
            'required' => 'Konfirmasi password wajib diisi.',
            'matches' => 'Konfirmasi password tidak cocok dengan password.'
        ],
        'usia' => [
            'required' => 'Usia wajib diisi.',
            'numeric' => 'Usia harus berupa angka.',
            'greater_than_equal_to'=> 'Usia minimal adalah 9 tahun.',
        ],
        'tinggi' => [
            'required' => 'Tinggi wajib diisi.',
            'numeric' => 'Tinggi harus berupa angka.',
            'greater_than_equal_to'=> 'Tinggi badan minimal adalah 140 cm.',
        ],
        'berat' => [
            'required' => 'Berat wajib diisi.',
            'numeric' => 'Berat harus berupa angka.',
            'greater_than_equal_to'=> 'Berat badan minimal adalah 35 kg.',
        ]
    ];

    protected $skipValidation = false;
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];


    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) { //Cek keberadaan password
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }


}
