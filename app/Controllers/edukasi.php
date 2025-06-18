<?php 
namespace App\Controllers;

use App\Models\MateriModel;

class Edukasi extends BaseController
{
    protected $materiModel;

    public function __construct()
    {
        $this->materiModel = new MateriModel();
    }

    public function index()
    {
        $materi = $this->materiModel->getAllMateri();

        $data['articles'] = array_map(function($item) {
            return [
                'id' => $item['id'],
                'title' => $item['judul'],
                'content' => $item['deskripsi'],
                'category' => $item['kategori'],
                'gambar' => $item['gambar'],
                'tanggal' => $item['tanggal'],
                'penulis' => $item['penulis']
            ];
        }, $materi);

        return view('user/edukasi/index', $data);
    }

    public function detail($id)
    {
        $artikel = $this->materiModel->find($id);

        if (!$artikel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Artikel tidak ditemukan.");
        }

        $data = [
            'title' => $artikel['judul'],
            'content' => $artikel['deskripsi'],
            'category' => $artikel['kategori'],
            'gambar' => $artikel['gambar'],
            'tanggal' => $artikel['tanggal'],
            'penulis' => $artikel['penulis']
        ];

        return view('user/edukasi/detail', $data);
    }

    public function haid()
    {
        $materi = $this->materiModel->where('kategori', 'haid')->findAll();

        $data['articles'] = array_map(function($item) {
            return [
                'id' => $item['id'],
                'title' => $item['judul'],
                'content' => $item['deskripsi'],
                'category' => $item['kategori'],
                'gambar' => $item['gambar'],
                'tanggal' => $item['tanggal'],
                'penulis' => $item['penulis']
            ];
        }, $materi);

        return view('user/edukasi/index', $data);
    }

    public function hamil()
    {
        $materi = $this->materiModel->where('kategori', 'hamil')->findAll();

        $data['articles'] = array_map(function($item) {
            return [
                'id' => $item['id'],
                'title' => $item['judul'],
                'content' => $item['deskripsi'],
                'category' => $item['kategori'],
                'gambar' => $item['gambar'],
                'tanggal' => $item['tanggal'],
                'penulis' => $item['penulis']
            ];
        }, $materi);

        return view('user/edukasi/index', $data);
    }
}
