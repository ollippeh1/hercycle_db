<?php

namespace App\Controllers;

use App\Models\MateriModel;

class Materi extends BaseController
{
    protected $materiModel;

    public function __construct()
    {
        $this->materiModel = new MateriModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Materi Edukasi',
            'materi' => $this->materiModel->findAll()
        ];

        return view('admin/materi/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Materi',
            'materi' => $this->materiModel->getMateri($id)
        ];

        if (empty($data['materi'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }

        return view('admin/materi/detail', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Materi Edukasi'
        ];

        return view('admin/materi/tambah', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'judul' => 'required',
            'deskripsi' => 'required'
        ])) {
            return redirect()->back()->withInput();
        }

        $this->materiModel->save([
            'judul' => $this->request->getVar('judul'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'gambar' => $this->request->getVar('gambar'),
            'kategori' => $this->request->getVar('kategori'),
            'penulis' => $this->request->getVar('penulis'),
            'tanggal' => date('Y-m-d H:i:s')
        ]);


        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('admin/materi');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Materi Edukasi',
            'materi' => $this->materiModel->getMateri($id)
        ];

        return view('admin/materi/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'judul' => 'required',
            'deskripsi' => 'required'
        ])) {
            return redirect()->back()->withInput();
        }
        $this->materiModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'gambar' => $this->request->getVar('gambar'),
            'kategori' => $this->request->getVar('kategori'),
            'penulis' => $this->request->getVar('penulis')
        ]);


        session()->setFlashdata('pesan', 'Data berhasil diupdate.');

        return redirect()->to('admin/materi');
    }

    public function hapus($id)
    {
        $this->materiModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('admin/materi');
    }
}
