<?php
namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table = 'edukasi';
    protected $primaryKey = 'id_edukasi';
    protected $allowedFields = ['judul','penulis','deskripsi', 'gambar', 'tanggal'];

    public function get_latest_articles($limit = 3)
    {
        return $this->select('judul, penulis, deskripsi, tanggal')
                    ->limit($limit)
                    ->find();
    }
}