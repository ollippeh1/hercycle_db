<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class LoginController extends BaseController
{
    protected $model;
    protected $db;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if ($this->isLoggedIn()) {
            return redirect()->to(base_url('dashboard'));
        }

        $data = [
            'title' => 'Hercycle | Login'
        ];

        return view('auth/login', $data);
    }

    public function logout()
    {
        session()->destroy(); // hapus semua data session
        return redirect()->to(base_url('login'))->with('success', 'Berhasil logout.');
    }

    public function login()
    {
        if (!$this->validate([
            'email' => 'required|valid_email',
            'password' => 'required',
            'login_sebagai' => 'required|in_list[adm,usr]'
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $loginSebagai = $this->request->getPost('login_sebagai');

        $user = $this->db->table($loginSebagai === 'adm' ? 'admin' : 'user') // Ambil user dari tabel yang sesuai
            ->where('email', $email)
            ->get()
            ->getRowArray();

        if (!$user || !password_verify($password, $user['password'])) {
            session()->setFlashdata('error', 'Email atau password anda salah.');
            return redirect()->back()->withInput();
        }

        $userData = [
            'name' => $user['username'],
            'email' => $user['email'],
            'role' => $loginSebagai === 'adm' ? 'admin' : 'user',
            'logged_in' => TRUE
        ];

        session()->set($userData); //bedakan halaman user dan admin pas login
        if ($userData['role'] === 'admin') {
            return redirect()->to(base_url('edukasiadmin'));
        } else {
            session()->set('id_user', $user['id_user']);
            return redirect()->to(base_url('dashboad'));
        }
    }

    private function isLoggedIn(): bool
    {
        return session()->get('logged_in') === TRUE;
    }

    
}


