<?php

namespace App\Models;

use CodeIgniter\Model;

class NoteModel extends Model
{
    protected $table            = 'notes';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'condition', 'intercourse', 'moods', 'symptoms',
        'weight', 'height', 'drink_water', 'ovulation_test'
    ];
    protected $useTimestamps = true;
}
