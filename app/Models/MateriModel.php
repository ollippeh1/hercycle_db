<?php namespace App\Models;

use CodeIgniter\Model;

class MateriModel extends Model
{
    protected $table = 'materi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul', 'deskripsi', 'gambar', 'tanggal', 'kategori', 'penulis'];

    protected $useTimestamps = false;

    public function getMateri($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getMateriByKategori($kategori)
    {
        return $this->where('kategori', $kategori)->findAll();
    }

    public function getAllMateri()
    {
        return $this->orderBy('tanggal', 'DESC')->findAll();
    }
}