<?php

namespace App\Controllers;

use App\Models\Kalender_splash;
use App\Models\User_splash;
use CodeIgniter\Controller;
use DateTime;

class Dashboard extends BaseController
{
    public function index()
    {
        $userId = session()->get('id_user');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userModel = new User_splash();
        $kalenderModel = new Kalender_splash();

        $user = $userModel->find($userId);
        $username = $user['username'] ?? 'Pengguna';

        $dataKalender = $kalenderModel->getLatestPeriodEntry($userId);

        if (!$dataKalender || empty($dataKalender['tanggal_haid'])) {
            return view('dashboard', [
                'current' => 'dashboard',
                'kalenderMingguan' => [],
                'dataKalender' => [],
                'prediksi' => [],
                'hari_ke_haid' => null,
                'teks_menstruasi' => 'Belum ada data periode haid. Silakan catat periode haid Anda.',
                'status_hamil' => '',
                'username' => $username
            ]);
        }

        $siklus = (int) $dataKalender['siklus_haid'];
        $lamaHaid = (int) $dataKalender['lama_haid'];

        $tanggalMulaiHaidTerakhir = new DateTime($dataKalender['tanggal_haid']);
        $haidBerikutnya = clone $tanggalMulaiHaidTerakhir;
        $haidBerikutnya->modify("+$siklus days");

        $ovulasi = clone $haidBerikutnya;
        $ovulasi->modify('-14 days');

        $peluangHamilMulai = clone $ovulasi;
        $peluangHamilMulai->modify('-4 days');

        $peluangHamilSelesai = clone $ovulasi;
        $peluangHamilSelesai->modify('+1 days');

        $today = new DateTime();
        $hari_ke_haid = $kalenderModel->getCurrentMenstruationDay($userId, $today);

        if ($hari_ke_haid) {
            $teksMenstruasi = ($hari_ke_haid === 1) ? "Hari pertama menstruasi" : "Hari ke-$hari_ke_haid menstruasi";
        } else {
            $selisih = $today->diff($haidBerikutnya)->days;
            $teksMenstruasi = ($haidBerikutnya > $today) ? "Periode Menstruasi dalam $selisih hari" : "Menstruasi";
        }

        $statusHamil = ($today >= $peluangHamilMulai && $today <= $peluangHamilSelesai)
            ? "Peluang hamil tinggi"
            : "Peluang hamil rendah";

        $kalenderMingguan = [];
        $minggu = clone $today;
        $minggu->modify('last sunday');

        for ($i = 0; $i < 7; $i++) {
            $tanggal = clone $minggu;
            $tanggal->modify("+$i days");

            $isToday = $tanggal->format('Y-m-d') === $today->format('Y-m-d');
            $isMenstruasi = $kalenderModel->isDateMenstruating($userId, $tanggal);

            $kalenderMingguan[] = [
                'tanggal' => $tanggal,
                'is_today' => $isToday,
                'is_menstruasi' => $isMenstruasi
            ];
        }

        return view('dashboard', [
            'current' => 'dashboard',
            'kalenderMingguan' => $kalenderMingguan,
            'dataKalender' => $dataKalender,
            'prediksi' => [
                'haid_berikutnya' => $haidBerikutnya->format('Y-m-d'),
                'ovulasi' => $ovulasi->format('Y-m-d'),
                'peluang_hamil_mulai' => $peluangHamilMulai->format('Y-m-d'),
                'peluang_hamil_selesai' => $peluangHamilSelesai->format('Y-m-d')
            ],
            'hari_ke_haid' => $hari_ke_haid,
            'teks_menstruasi' => $teksMenstruasi,
            'status_hamil' => $statusHamil,
            'username' => $username
        ]);
    }

    public function catatHaidHariIni()
    {
        $userId = session()->get('id_user');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $kalenderModel = new Kalender_splash();
        $kalenderModel->recordPeriodToday($userId, 5, 28);

        return redirect()->to('/dashboard')->with('message', 'Periode haid hari ini berhasil dicatat!');
    }

    public function catatHaid()
    {
        $userId = session()->get('id_user');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $tanggalMulai = $this->request->getPost('tanggal_mulai');
        $durasi = (int)$this->request->getPost('durasi');
        $siklus = (int)$this->request->getPost('siklus_haid') ?? 28;

        if ($durasi <= 0 || $durasi > 15) {
            return redirect()->back()->with('error', 'Durasi haid tidak valid.');
        }

        $model = new Kalender_splash();
        $model->insert([
            'user_id' => $userId,
            'tanggal_haid' => $tanggalMulai,
            'lama_haid' => $durasi,
            'siklus_haid' => $siklus,
        ]);

        return redirect()->to('/dashboard');
    }
}
