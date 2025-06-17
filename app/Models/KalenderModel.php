<?php

namespace App\Models;

use CodeIgniter\Model;

class KalenderModel extends Model
{
    protected $table      = 'kalender';
    protected $primaryKey = 'id_kalender';

    protected $allowedFields = [
        'user_id',
        'tanggal_haid',
        'siklus_haid',
        'lama_haid',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
}
