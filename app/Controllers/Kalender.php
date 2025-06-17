<?php

namespace App\Controllers;
use App\Models\KalenderModel;

class Kalender extends BaseController
{
    public function index()
    {
        $model = new KalenderModel();
        $haid = $model->orderBy('id_kalender', 'DESC')->first();

        $haidTanggal = null;
        $haidSelesai = null;
        $ovulasi = null;

        if ($haid && isset($haid['tanggal_haid'])) {
            $haidTanggal = $haid['tanggal_haid'];
            $haidSelesai = date('Y-m-d', strtotime($haidTanggal . ' +5 days'));
            $ovulasi = date('Y-m-d', strtotime($haidTanggal . ' +14 days'));
        }

        $daysInMonth = date('t');
        $startDay = date('w', strtotime(date('Y-m-01')));

        return view('kalender_view', [
            'haid_tanggal' => $haidTanggal,
            'haid_selesai' => $haidSelesai,
            'ovulasi' => $ovulasi,
            'days_in_month' => $daysInMonth,
            'start_day' => $startDay,
            'current' => 'kalender' // ✅ ini ditambahkan
        ]);
    }

    public function simpan()
    {
        $tanggal = $this->request->getPost('tanggal');
        $model = new KalenderModel();

        $data = [
            'tanggal_haid' => date('Y') . '-' . date('m') . '-' . str_pad($tanggal, 2, '0', STR_PAD_LEFT),
            'siklus_haid' => 28 // default
        ];

        $model->insert($data);
        return redirect()->to('/kalender');
    }
}
