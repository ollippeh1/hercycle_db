<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class profilController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Hercycle | Profil'
        ];

        $userId = session()->get('id_user'); // pastikan ini diset saat login
        if (!$userId) {
            return redirect()->to('/login'); // redirect kalau belum login
        }

        // Ambil data user dari DB
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login'); // jika user tidak ditemukan di DB
        }

        // Kirim data user ke view
        $data['user'] = $user;

        // Kirim juga data validasi kalau ada
        if (session()->getFlashdata('validation')) {
            $data['validation'] = session()->getFlashdata('validation');
        }

        return view('auth/profil', $data);
    }


    public function showEditForm()
    {
        $data = [
            'title' => 'Hercycle | Edit Profil'
        ];

        $userId = session()->get('id_user'); // pastikan ini diset saat login
        if (!$userId) {
            return redirect()->to('/login'); // redirect kalau belum login
        }

        // Ambil data user dari DB
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login'); // jika user tidak ditemukan di DB
        }

        // Kirim data user ke view
        $data['user'] = $user;

        // Kirim juga data validasi kalau ada
        if (session()->getFlashdata('validation')) {
            $data['validation'] = session()->getFlashdata('validation');
        }

        return view('auth/editp', $data);
    }

    public function updatep()
    {
        $userId = session()->get('id_user');
        if (!$userId) return redirect()->to('/login');

        $data = $this->request->getPost();
        unset($data['csrf_test_name']);

        $userModel = new \App\Models\UserModel();

        // Buat rules dasar
        $rules = [
            'username' => 'required|min_length[3]|max_length[255]|is_unique[user.username,id_user,' . $userId . ']',
            'email'    => 'required|valid_email|is_unique[user.email,id_user,' . $userId . ']',
            'usia'     => 'required|numeric|greater_than_equal_to[9]|less_than_equal_to[50]',
            'tinggi'   => 'required|numeric|greater_than_equal_to[140]|less_than_equal_to[200]',
            'berat'    => 'required|numeric|greater_than_equal_to[35]|less_than_equal_to[150]',
        ];

        // Jika password tidak kosong, tambahkan rule-nya
        if (!empty($data['password'])) {
            $rules['password'] = 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/]';
        }

        // Gunakan validator global dan set pesan dari model
        $validation = \Config\Services::validation();
        $validation->setRules($rules, $userModel->validationMessages);

        if (!$validation->run($data)) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Siapkan data untuk update
        $dataUpdate = [];

        // Ambil data lama untuk perbandingan
        $userLama = $userModel->find($userId);

        // Cek perubahan
        if ($data['username'] !== $userLama['username']) {
            $dataUpdate['username'] = $data['username'];
        }

        if ($data['email'] !== $userLama['email']) {
            $dataUpdate['email'] = $data['email'];
        }

        if (!empty($data['password'])) {
            $dataUpdate['password'] = $data['password']; // Hash-nya dihandle oleh beforeUpdate
        }

        if ($data['usia'] !== $userLama['usia']) {
            $dataUpdate['usia'] = $data['usia'];
        }

        if ($data['tinggi'] !== $userLama['tinggi']) {
            $dataUpdate['tinggi'] = $data['tinggi'];
        }

        if ($data['berat'] !== $userLama['berat']) {
            $dataUpdate['berat'] = $data['berat'];
        }

        if (!empty($dataUpdate)) {
            $userModel->update($userId, $dataUpdate);
            return redirect()->to('/profil')->with('success', 'Data berhasil diperbarui.');
        }

        return redirect()->to('/profil')->with('info', 'Tidak ada perubahan yang disimpan.');
    }

    public function hapusAkun()
    {
        $userId = session()->get('id_user');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Anda belum login.');
        }

        $userModel = new \App\Models\UserModel();

        // Hapus user dari database
        $userModel->delete($userId);

        // Hapus sesi
        session()->destroy();

        // Redirect ke halaman registrasi
        return redirect()->to('/register')->with('info', 'Akun Anda telah berhasil dihapus.');
    }



}