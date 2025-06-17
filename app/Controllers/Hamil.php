<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Hamil extends Controller
{
    public function index()
    {
        $haid_pertama = session()->get('haid_pertama');

        if (!$haid_pertama) {
            return redirect()->to('/kalender');
        }

        $hari_ini = date('Y-m-d');
        $selisih = (strtotime($hari_ini) - strtotime($haid_pertama)) / (60 * 60 * 24);
        $minggu_ke = ceil($selisih / 7);

        return view('hamil_view', [
            'minggu_ke' => $minggu_ke,
            'current' => 'kalender'
        ]);
    }
}
