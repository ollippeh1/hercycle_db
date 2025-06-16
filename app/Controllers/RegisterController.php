<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class RegisterController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Hercycle | Registrasi'
        ];

        if (session()->getFlashdata('validation')) { // Meneruskan validator instance jika ada error dari store()
            $data['validation'] = session()->getFlashdata('validation');
        }

        return view('auth/register', $data);
    }

    public function store()
    {
        $data = $this->request->getPost([
            'username', 'email', 'password', 'confirm', 'usia', 'tinggi', 'berat'
        ]);

    log_message('debug', 'Form data: ' . json_encode($data));

        $validation = \Config\Services::validation(); 
        $rules = $this->model->getValidationRules();
        $messages = $this->model->getValidationMessages();

        $rules['confirm'] = 'required|matches[password]'; // Tambah aturan 'confirm' yg gada di usermodel
        $messages['confirm'] = [
        'required' => 'Konfirmasi password wajib diisi.',
        'matches'  => 'Konfirmasi password tidak cocok dengan password.'
    ];

        $validation->setRules($rules, $messages);

        if (! $validation->run($data)) {
            log_message('error', 'VALIDATION ERRORS: ' . json_encode($validation->getErrors()));
                session()->setFlashdata('validation', $validation); // kirim validator
                return redirect()->back()->withInput();
        }

        unset($data['confirm']); // Hapus 'confirm' spy ga masuk db

        $save = $this->model->save($data);

        if ($save) {
            session()->setFlashdata('success', 'Registrasi Berhasil! Silakan login.');
            return redirect()->to(base_url('register'));
        } else {
            log_message('error', 'SAVE FAILED. Model Errors: ' . json_encode($this->model->errors()));
            session()->setFlashdata('error', 'Registrasi gagal karena masalah internal. Silakan coba lagi.');
        return redirect()->back()->withInput();
        }
    }
}
