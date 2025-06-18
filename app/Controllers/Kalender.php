<?php

namespace App\Controllers;
use App\Models\KalenderModel;
class Kalender extends BaseController
{
    public function index()
    {
        $userId = session()->get('id_user');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $model = new KalenderModel();
        $haid = $model->where('user_id', $userId)->orderBy('id_kalender', 'DESC')->first();

        $haidTanggal = null;
        $haidSelesai = null;
        $ovulasi = null;

        if ($haid && isset($haid['tanggal_haid'])) {
            $haidTanggal = $haid['tanggal_haid'];
            $lamaHaid = $haid['lama_haid'] ?? 5;
            $siklus = $haid['siklus_haid'] ?? 28;

            $haidSelesai = date('Y-m-d', strtotime($haidTanggal . " +$lamaHaid days"));
            $ovulasi = date('Y-m-d', strtotime($haidTanggal . " +" . ($siklus - 14) . " days"));
        }

        $daysInMonth = date('t');
        $startDay = date('w', strtotime(date('Y-m-01')));

        return view('kalender_view', [
            'haid_tanggal' => $haidTanggal,
            'haid_selesai' => $haidSelesai,
            'ovulasi' => $ovulasi,
            'days_in_month' => $daysInMonth,
            'start_day' => $startDay,
            'current' => 'kalender'
        ]);
    }

    public function simpan()
    {
        $userId = session()->get('id_user');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $tanggal = $this->request->getPost('tanggal');
        $model = new KalenderModel();

        $data = [
            'user_id' => $userId,
            'tanggal_haid' => date('Y') . '-' . date('m') . '-' . str_pad($tanggal, 2, '0', STR_PAD_LEFT),
            'lama_haid' => 5,
            'siklus_haid' => 28
        ];

        $model->insert($data);
        return redirect()->to('/kalender');
    }
}
