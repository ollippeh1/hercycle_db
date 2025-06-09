<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\LupapwModel; 
use App\Models\PasswordResetModel;
use CodeIgniter\I18n\Time;


class LupapwController extends BaseController
{
    protected $model;
    protected $db;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->db = \Config\Database::connect();
    }

// ===================== [1] FORM EMAIL (REQUEST OTP) =====================

    public function index()
    {

        $data = [
            'title' => 'Hercycle | Forget Password'
        ];

        return view('auth/lupapw', $data);
    }

    public function sendResetLink()
    {
        $emailAddress = $this->request->getPost('email');
        $userModel = new UserModel();
        $resetModel = new LupapwModel();

        // Cari user berdasarkan email
        $user = $userModel->where('email', $emailAddress)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan.');
        }

        // Generate OTP acak 6 digit
        $otp = random_int(100000, 999999);
        $expiresAt = Time::now()->addMinutes(50)->toDateTimeString();

        // Hapus OTP lama (opsional)
        $resetModel->where('email', $emailAddress)->delete();

        // Simpan OTP baru ke DB
        $resetModel->insert([
            'email' => $emailAddress,
            'token' => $otp, // kamu bisa ganti kolomnya ke 'otp' kalau mau
            'expires_at' => $expiresAt,
            'created_at' => Time::now()->toDateTimeString(),
        ]);

        // Kirim email ke user
        $emailService = \Config\Services::email();
        $emailService->setFrom('hercycle0@gmail.com', 'HerCycle Support');
        $emailService->setTo($emailAddress);
        $emailService->setSubject('Kode OTP Reset Password HerCycle');

        $message = "
            <p>Halo <strong>{$user['username']}</strong>,</p>
            <p>Berikut adalah kode OTP untuk mereset password akun HerCycle Anda:</p>
            <h2>$otp</h2>
            <p>Kode ini berlaku selama 3 menit.</p>
            <br>
            <p>Jika Anda tidak meminta reset, abaikan email ini.</p>
            <p>Salam,<br>Tim HerCycle</p>
        ";
        $emailService->setMessage($message);

        if ($emailService->send()) {
            return redirect()->to('/lupapw/verifikasiotp?email=' . urlencode($emailAddress))
                            ->with('success', 'Kode OTP berhasil dikirim');
        } else {
            return redirect()->back()->with('error', 'Gagal mengirim email.');
        }
    }

 // ===================== [2] FORM VERIFIKASI OTP =====================

    public function showOTPForm()
    {

        $email = $this->request->getGet('email') ?? '';
        $data = [
            'title' => 'Hercycle | Verifikasi Kode OTP',
            'email' => $email
        ];
            return view('auth/verifikasiotp', $data);
        }


    public function verifyOTP()
    {
        $email = $this->request->getPost('email');
        
        $otp1 = $this->request->getPost('otp1'); // Ambil masing-masing digit OTP
        $otp2 = $this->request->getPost('otp2');
        $otp3 = $this->request->getPost('otp3');
        $otp4 = $this->request->getPost('otp4');
        $otp5 = $this->request->getPost('otp5');
        $otp6 = $this->request->getPost('otp6');
        $otp = trim($otp1 . $otp2 . $otp3 . $otp4 . $otp5 . $otp6); // Gabungkan jadi satu string

        $resetModel = new LupapwModel();
        $record = $resetModel
            ->where('email', $email)
            ->where('token', $otp)
            ->where('expires_at >=', date('Y-m-d H:i:s'))
            ->first();

            $otp = trim($this->request->getPost('otp'));


        if (!$record) {
            return redirect()->back()->with('error', 'OTP tidak valid atau sudah kadaluarsa.');
        }

        // Sukses → arahkan ke form reset password
        return redirect()->to('/lupapw/ubahpw?email=' . urlencode($email));
    }

  // ===================== [3] FORM PASSWORD BARU =====================

    public function showPasswordForm()
    {

        $email = $this->request->getGet('email');
        $data = [
            'title' => 'Hercycle | Verifikasi Kode OTP',
            'email' => $email
        ];
        return view('auth/ubahpw', $data);
    }

    public function resetPassword()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirm = $this->request->getPost('confirm');


        $userModel = new UserModel();
        $resetModel = new LupapwModel();

        $user = $userModel->where('email', $email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        // Validasi password manual pakai regex
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
        if (!preg_match($pattern, $password)) {
            return redirect()->back()->with('error', 'Password harus mengandung minimal 1 huruf besar, 1 huruf kecil, dan 1 angka serta minimal 8 karakter.');
        }

        // Validasi konfirmasi password sama dengan password
        if ($password !== $confirm) {
            return redirect()->back()->with('error', 'Konfirmasi password tidak cocok dengan password.');
        }

        // Kalau valid, update password dengan skipValidation supaya gak double validasi
        $userModel->skipValidation(true);
        $userModel->update($user['id_user'], [
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        // Hapus data reset token OTP
        $resetModel->where('email', $email)->delete();

        return redirect()->to('/login')->with('success', 'Password berhasil diubah.');
    }



        public function testEmail()
    {
        $email = \Config\Services::email();
        $email->setTo('hercycle0@gmail.com');
        $emailService->setFrom('hercycle0@gmail.com', 'HerCycle Support');
        $email->setSubject('Test Email dari CodeIgniter');
        $email->setMessage('<p>Email ini dikirim dari server CodeIgniter.</p>');

        if ($email->send()) {
            echo "Email berhasil dikirim!";
        } else {
            echo "Email gagal dikirim!";
            print_r($email->printDebugger(['headers']));
        }
    }


}