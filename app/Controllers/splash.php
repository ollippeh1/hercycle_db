<?php

namespace App\Controllers;

use App\Models\Edukasi_splash;
use App\Models\EdukasiModel;

class Splash extends BaseController
{
    public function index()
    {
        $model = new Edukasi_splash();
        $data['edukasi'] = $model->findAll(); // kirim data edukasi
        return view('splash_view', $data);
    }
}
