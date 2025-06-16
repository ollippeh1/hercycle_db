<?php

namespace App\Controllers;
use App\Models\EdukasiModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new EdukasiModel();
        $data['edukasi'] = $model->findAll(); // ambil semua data edukasi

        return view('splash_view', $data); // kirim ke view splash_view.php
    }
}