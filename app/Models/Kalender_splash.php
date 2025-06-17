<?php namespace App\Models;

use CodeIgniter\Model;
use DateTime; // Pastikan menggunakan PHP's native DateTime untuk konsistensi

class Kalender_splash extends Model
{
    protected $table      = 'kalender';
    protected $primaryKey = 'id_kalender';
    // Pastikan semua kolom yang akan Anda gunakan dalam insert/update ada di sini
    protected $allowedFields = ['user_id', 'tanggal_haid', 'lama_haid', 'siklus_haid', 'tanggal_akhir_haid'];

    /**
     * Mencatat hari ini sebagai tanggal mulai periode haid baru atau memperbarui yang terakhir.
     * Mengasumsikan 'tanggal_mulai_haid' adalah kolom utama untuk melacak awal periode.
     *
     * @param int $userId ID pengguna
     * @param int $defaultLamaHaid Durasi haid default jika tidak ada data sebelumnya
     * @param int $defaultSiklusHaid Panjang siklus default jika tidak ada data sebelumnya
     * @return int|bool ID record yang di-update/insert, atau false jika sudah tercatat hari ini
     */
    public function recordPeriodToday(int $userId, int $defaultLamaHaid = 5, int $defaultSiklusHaid = 28)
    {
        $today = date('Y-m-d');

        // Cari entri terakhir untuk pengguna ini berdasarkan tanggal mulai haid
        $existing = $this->where('user_id', $userId)
                         ->orderBy('tanggal_haid', 'DESC') // Penting: Urutkan berdasarkan tanggal mulai haid
                         ->first();

        // Jika tanggal mulai haid terakhir sudah hari ini, anggap sudah tercatat
        if ($existing && $existing['tanggal_haid'] === $today) {
            return false; // Sudah dicatat untuk hari ini
        }

        $data = [
            'user_id' => $userId,
            'tanggal_haid' => $today, // Tanggal mulai periode yang baru dicatat
            'lama_haid' => $existing['lama_haid'] ?? $defaultLamaHaid, // Pertahankan yang sudah ada atau gunakan default
            'siklus_haid' => $existing['siklus_haid'] ?? $defaultSiklusHaid, // Pertahankan yang sudah ada atau gunakan default
            // Anda bisa mengosongkan atau menghitung 'tanggal_akhir_haid' di sini jika diperlukan
            // Misalnya: 'tanggal_akhir_haid' => (new DateTime($today))->modify('+' . ($existing['lama_haid'] ?? $defaultLamaHaid - 1) . ' days')->format('Y-m-d'),
        ];

        if ($existing) {
            // Update entri yang sudah ada jika Anda hanya ingin satu record terbaru per user
            $this->update($existing['id_kalender'], $data);
            return $existing['id_kalender'];
        } else {
            // Sisipkan entri baru jika belum ada record sama sekali
            $this->insert($data);
            return $this->insertID();
        }
    }

    /**
     * Memeriksa apakah suatu tanggal tertentu jatuh dalam periode menstruasi yang tercatat.
     * Digunakan untuk menandai hari di kalender.
     *
     * @param int $userId ID pengguna
     * @param DateTime $dateToCheck Objek DateTime dari tanggal yang akan diperiksa
     * @return bool True jika tanggal tersebut adalah hari menstruasi, false jika tidak
     */
    public function isDateMenstruating(int $userId, DateTime $dateToCheck): bool
    {
        // Ambil semua record periode haid untuk pengguna
        // Urutkan untuk efisiensi, dari yang terbaru
        $allPeriods = $this->where('user_id', $userId)
                           ->orderBy('tanggal_haid', 'DESC')
                           ->findAll();

        foreach ($allPeriods as $period) {
            // Pastikan kolom penting ada dan tidak kosong
            if (empty($period['tanggal_haid']) || empty($period['lama_haid'])) {
                continue; // Lewati record yang tidak lengkap
            }
            $periodStartDate = new DateTime($period['tanggal_haid']);
            $periodEndDate = clone $periodStartDate;
            $periodEndDate->modify('+' . ($period['lama_haid'] - 1) . ' days');

            // Cek apakah tanggal yang diperiksa berada di antara tanggal mulai dan akhir periode ini
            if ($dateToCheck >= $periodStartDate && $dateToCheck <= $periodEndDate) {
                return true;
            }
        }
        return false;
    }

    /**
     * Mengambil entri periode haid terbaru untuk pengguna tertentu.
     * Berguna untuk dasar perhitungan prediksi siklus.
     *
     * @param int $userId ID pengguna
     * @return array|null Entri periode haid terbaru, atau null jika tidak ada
     */
    public function getLatestPeriodEntry(int $userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('tanggal_haid', 'DESC') // Penting: Ambil yang terbaru berdasarkan tanggal mulai haid
                    ->first();
    }

    /**
     * Menghitung hari ke berapa menstruasi saat ini, jika hari ini dalam periode.
     *
     * @param int $userId ID pengguna
     * @param DateTime $todayDate Objek DateTime untuk hari ini
     * @return int|null Hari ke-menstruasi (1-based), atau null jika tidak sedang menstruasi
     */
    public function getCurrentMenstruationDay(int $userId, DateTime $todayDate): ?int
    {
        $latestPeriod = $this->getLatestPeriodEntry($userId);

        if ($latestPeriod && !empty($latestPeriod['tanggal_haid']) && !empty($latestPeriod['lama_haid'])) {
            $periodStartDate = new DateTime($latestPeriod['tanggal_haid']);
            $periodEndDate = clone $periodStartDate;
            $periodEndDate->modify('+' . ($latestPeriod['lama_haid'] - 1) . ' days');

            // Cek apakah hari ini berada dalam periode menstruasi terbaru
            if ($todayDate >= $periodStartDate && $todayDate <= $periodEndDate) {
                return $periodStartDate->diff($todayDate)->days + 1; // Hari ke-X menstruasi
            }
        }
        
        return null;
    }
}