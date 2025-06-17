<?php

namespace App\Controllers;
use App\Models\EdukasiModel;

class Splash extends BaseController
{
    public function index()
    {
        $model = new EdukasiModel();
        $data['edukasi'] = $model->findAll(); // kirim data edukasi
        return view('splash_view', $data);
    }
}
