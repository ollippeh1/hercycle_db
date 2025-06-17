<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KalenderModel;
use CodeIgniter\API\ResponseTrait;

class KalenderController extends BaseController
{
    use ResponseTrait;

    public function index()
{
    return view('kalenderv');
}

    public function save()
    {
        $model = new KalenderModel();

        $tanggal_akhir_haid = $this->request->getPost('tanggal_akhir_haid');
        $lama_haid = $this->request->getPost('lama_haid');
        $siklus_haid = $this->request->getPost('siklus_haid');
        $siklus_hamil = $this->request->getPost('siklus_hamil');

        $user_id = 1; // contoh, nanti ambil dari session login

        $data = [
            'user_id' => $user_id,
            'tanggal_akhir_haid' => $tanggal_akhir_haid,
            'lama_haid' => $lama_haid,
            'siklus_haid' => $siklus_haid,
            'siklus_hamil' => $siklus_hamil,
            'gambar_perkembangan_janin' => '', // bisa digenerate otomatis nanti
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $model->insert($data);

        return $this->respond(['status' => 'success']);
    }

    public function events()
    {
        $model = new KalenderModel();
        $user_id = 1;

        $entries = $model->where('user_id', $user_id)->findAll();
        $events = [];

        foreach ($entries as $e) {
            // Haid
            $start_haid = date('Y-m-d', strtotime($e['tanggal_akhir_haid'] . ' -' . ($e['lama_haid'] - 1) . ' days'));
            $end_haid = $e['tanggal_akhir_haid'];

            $events[] = [
                'title' => 'Haid',
                'start' => $start_haid,
                'end' => date('Y-m-d', strtotime($end_haid . ' +1 day')),
                'className' => 'event-haid',
            ];

            // Ovulasi (hari ke-14 dari hari pertama haid)
            $start_haid_date = date('Y-m-d', strtotime($start_haid));
            $ovulasi_date = date('Y-m-d', strtotime($start_haid_date . ' +14 days'));

            $events[] = [
                'title' => 'Ovulasi',
                'start' => $ovulasi_date,
                'className' => 'event-ovulasi',
            ];
        }

        return $this->response->setJSON($events);
    }
}
