<?php

namespace App\Controllers;

use App\Models\Kalender_splash;
use App\Models\KalenderModel;
use App\Models\User_splash;
use App\Models\UserModel;
use CodeIgniter\Controller;
use DateTime; // Pastikan menggunakan PHP's native DateTime

class Dashboard extends BaseController
{
    public function index()
    {
        $userModel = new User_splash();
        $kalenderModel = new Kalender_splash(); // Inisiasi KalenderModel

        $userId = session()->get('id_user') ?? 1; // Fallback untuk user ID
        $user = $userModel->find($userId);
        $username = $user['username'] ?? 'Pengguna';

        // Ambil data kalender terakhir yang relevan untuk prediksi
        // Ini akan mengambil entri terbaru berdasarkan 'tanggal_mulai_haid'
        $dataKalender = $kalenderModel->getLatestPeriodEntry($userId);

        // Jika tidak ada data kalender sama sekali
        if (!$dataKalender || empty($dataKalender['tanggal_haid'])) {
            return view('dashboard', [
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
        
        // Referensi utama adalah tanggal MULAI haid terakhir yang tercatat
        $tanggalMulaiHaidTerakhir = new DateTime($dataKalender['tanggal_haid']);
        
        // Prediksi Haid Berikutnya (tanggal mulai haid terakhir + siklus)
        $haidBerikutnya = clone $tanggalMulaiHaidTerakhir;
        $haidBerikutnya->modify("+$siklus days");

        // Prediksi Ovulasi (sekitar 14 hari sebelum haid berikutnya)
        $ovulasi = clone $haidBerikutnya;
        $ovulasi->modify('-14 days');

        // Prediksi Peluang Hamil (masa subur, sekitar 4 hari sebelum ovulasi sampai 1 hari setelah)
        $peluangHamilMulai = clone $ovulasi;
        $peluangHamilMulai->modify('-4 days');

        $peluangHamilSelesai = clone $ovulasi;
        $peluangHamilSelesai->modify('+1 days');

        $today = new DateTime();
        $hari_ke_haid = null;
        $teksMenstruasi = '';
        $statusHamil = '';

        // Tentukan apakah hari ini sedang menstruasi dan hari ke berapa
        $hari_ke_haid = $kalenderModel->getCurrentMenstruationDay($userId, $today);

        if ($hari_ke_haid) {
            $teksMenstruasi = ($hari_ke_haid === 1) ? "Hari pertama menstruasi" : "Hari ke-$hari_ke_haid menstruasi";
        } else {
            // Jika tidak sedang menstruasi, hitung selisih hari menuju periode berikutnya
            $selisih = $today->diff($haidBerikutnya)->days;
            $teksMenstruasi = ($haidBerikutnya > $today) ? "Periode Menstruasi dalam $selisih hari" : "Menstruasi";
        }
        
        // Cek status peluang hamil hari ini
        $statusHamil = ($today >= $peluangHamilMulai && $today <= $peluangHamilSelesai)
            ? "Peluang hamil tinggi"
            : "Peluang hamil rendah";

        // Buat data untuk kalender mingguan
        $kalenderMingguan = [];
        $minggu = clone $today;
        // Set awal minggu ke hari Minggu terakhir (Sunday)
        $minggu->modify('last sunday'); 
        
        for ($i = 0; $i < 7; $i++) {
            $tanggal = clone $minggu;
            $tanggal->modify("+$i days");

            $isToday = $tanggal->format('Y-m-d') === $today->format('Y-m-d');
            
            // Gunakan KalenderModel untuk memeriksa apakah tanggal ini adalah hari menstruasi yang tercatat
            $isMenstruasi = $kalenderModel->isDateMenstruating($userId, $tanggal);

            $kalenderMingguan[] = [
                'tanggal' => $tanggal,
                'is_today' => $isToday,
                'is_menstruasi' => $isMenstruasi
            ];
        }

        return view('dashboard', [
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

    // Fungsi catat haid otomatis (hari ini)
    public function catatHaidHariIni()
    {
        $kalenderModel = new Kalender_splash();
        $userId = session()->get('id_user') ?? 1;

        // Panggil fungsi di model untuk mencatat periode hari ini (tanggal mulai haid)
        // Default lamaHaid dan siklusHaid bisa disesuaikan atau diambil dari user profile jika ada
        $lamaHaidDefault = 5;
        $siklusHaidDefault = 28;
        $kalenderModel->recordPeriodToday($userId, $lamaHaidDefault, $siklusHaidDefault);

        return redirect()->to('/dashboard')->with('message', 'Periode haid hari ini berhasil dicatat!');
    }

    // Fungsi catatHaid() yang lama (input manual tanggal_mulai dan durasi)
    // Anda bisa mempertahankan ini jika ada form terpisah untuk input manual
    // Tetapi jika tujuan "Catat periode haid" hanya untuk hari ini, fungsi ini mungkin tidak terpakai
    public function catatHaid()
    {
        $tanggalMulai = $this->request->getPost('tanggal_mulai');
        $durasi = $this->request->getPost('durasi');
        $siklus = $this->request->getPost('siklus_haid') ?? 28; // Tambahkan siklus jika ini form lengkap

        $model = new Kalender_splash();
        $model->insert([
            'user_id' => session()->get('id_user'),
            'tanggal_haid' => $tanggalMulai, // Pastikan kolom ini diizinkan di model
            'lama_haid' => $durasi,
            'siklus_haid' => $siklus, // Simpan siklus juga
            // 'tanggal_akhir_haid' => (new DateTime($tanggalMulai))->modify('+' . ($durasi - 1) . ' days')->format('Y-m-d'), // Bisa dihitung
        ]);

        return redirect()->to('/dashboard');
    }
}