<?php use CodeIgniter\I18n\Time; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>HerCycle - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 10px;
            font-family: 'Poppins', sans-serif;
            background-color: #FFE2EC;
        }
        .logo-container {
            background-color: #FFCCDD;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 25px;
            margin-top: -25px;
            width: 200px;
            height: 200px;
        }
        .logo {
            margin-top: 50px;
            width: 200px;
            height: 200px;
            object-fit: contain;
        }
        .sidebar {
            width: 250px;
            background-color: #e58ca9;
            padding: 20px;
            min-height: 100vh;
        }
        .nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .nav-item {
            background-color: #fbd9e0;
            padding: 12px 16px;
            margin-bottom: 15px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            font-weight: 500;
            color: #333;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .nav-item:hover {
            background-color: #f3a3b3;
            color: white;
        }
        .nav-item.active {
            background-color: #c74b71;
            color: white;
        }
        .icon {
            margin-right: 10px;
            font-size: 18px;
        }
        .kalender-baris {
            display: flex;
            justify-content: center;
            gap: 35px;
            margin-top: 20px;
        }
        .hari-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 50px;
            height: 70px;
            padding-top: 5px;
        }
        .tanggal {
            margin-top: 5px;
            margin-bottom: 6px;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
        }
        .hari-aktif .tanggal {
            background-color: white;
            font-weight: bold;
            color: #cc2b5e;
        }
        .hari-aktif .hari {
            font-weight: bold;
            color: black;
        }
        .indikator-haid {
            width: 8px;
            height: 8px;
            background-color: #e43f63;
            border-radius: 50%;
            margin-top: 4px;
        }
        .btn-pink {
            background-color: #d36c87;
            color: white;
        }
        .text-center mb-2 mt-4{
            margin-left: 500px;
        }
    </style>
</head>
<body>
<div class="d-flex min-vh-100">
    <div class="menu" style="width: 250px; background-color: #E18EA0;">
        <div class="logo">
            <div class="logo-container">
                <img src="<?= base_url('assets/logo.png') ?>" alt="Logo" class="logo">
            </div>
        </div>
        <div class="sidebar" style="margin-top: 0px;">
            <ul class="nav-list">
                <li class="nav-item active"><i class="icon">🔲</i> Dashboard</li>
                <a href="/kalender" class="nav-item"><i class="icon">📅</i> Kalender</a>
                <a href="/note" class="nav-item"><i class="icon">📝</i> Note</a>
                <a href="/chat_ai" class="nav-item"><i class="icon">💬</i> Chat AI</a>
                <a href="/edukasi" class="nav-item"><i class="icon">📄</i> Edukasi</a>
            </ul>
        </div>
    </div>
    <div class="content" style="flex: 1; padding: 30px;">
        <div class="top-bar mb-4">
    <div class="d-flex flex-column">
        <h4 class="mb-1"><strong>Selamat Datang ☀️</strong></h4>
        <span style="font-size: 16px; font-weight: 500; color: #555;"><?= esc($username) ?></span>
    </div>
</div>
                <div class="profile-section d-flex align-items-center gap-3" style="margin-left:940px; margin-top:-90px">
                <a href="/profil"><img src="<?= base_url('assets/profil.png') ?>" style="width: 40px; height: 40px; border-radius: 50%;"></a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"><img src="<?= base_url('assets/log-out.png') ?>" style="width: 32px; height: 32px;"></a>

            </div>
            

</div>
        </div>
        <?php if (!empty($kalenderMingguan)): ?>
        <div class="text-center mb-2 mt-4" style="align-content: center; margin-left:300px">
            <?php
                $bulan = $kalenderMingguan[0]['tanggal']->format('F');
                $namaBulanIndonesia = ['January'=>'Januari','February'=>'Februari','March'=>'Maret','April'=>'April','May'=>'Mei','June'=>'Juni','July'=>'Juli','August'=>'Agustus','September'=>'September','October'=>'Oktober','November'=>'November','December'=>'Desember'];
                $bulanID = $namaBulanIndonesia[$bulan] ?? $bulan;
            ?>
            <h5 style="font-weight: bold; color: black; font-size: 28px; margin-top: -800px; align-content:center"><?= $bulanID ?></h5>
        </div>

        <div class="kalender-baris" style="margin-top: -750px;margin-left:300px">
            <?php 
            $hariMap = ['Sun'=>'Min','Mon'=>'Sen','Tue'=>'Sel','Wed'=>'Rab','Thu'=>'Kam','Fri'=>'Jum','Sat'=>'Sab'];
            foreach ($kalenderMingguan as $hari): ?>
                <div class="hari-item <?= $hari['is_today'] ? 'hari-aktif' : ''?> " >
                    <div class="hari"><?= $hariMap[$hari['tanggal']->format('D')] ?></div>
                    <div class="tanggal"><?= $hari['tanggal']->format('j') ?></div>
                    <?php if ($hari['is_menstruasi']): ?>
                        <div class="indikator-haid"></div>
                    <?php endif; ?>
                </div> 
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($prediksi) && !empty($dataKalender)): ?>
            <?php
                $today = new DateTime();
                $haidBerikutnya = new DateTime($prediksi['haid_berikutnya']);
                $peluangMulai = new DateTime($prediksi['peluang_hamil_mulai']);
                $peluangSelesai = new DateTime($prediksi['peluang_hamil_selesai']);
                $statusHamil = ($today >= $peluangMulai && $today <= $peluangSelesai) ? "Peluang hamil tinggi" : "Peluang hamil rendah";

                // Penentuan teks atas berdasarkan status haid aktual
                if ($hari_ke_haid) {
                    $textHari = "Menstruasi:";
                } else {
                    $selisih = $today->diff($haidBerikutnya)->days;
                    $textHari = "Periode Menstruasi dalam";
                }
            ?>
            <div style="padding: 30px; text-align: center; max-width: 550px; margin: 50px auto; margin-left:540px">
                <h5 class="fw-semibold"><?= $textHari ?></h5>

                <?php if ($hari_ke_haid): ?>
                    <h2 style="font-size: 20px; font-weight: 700; margin-top: -7px;">
                        <?= ($hari_ke_haid === 1) ? 'Hari pertama menstruasi' : "Hari ke-$hari_ke_haid menstruasi" ?>
                    </h2>
                <?php else: ?>
                    <h1 style="font-size: 30px; font-weight: 700;"><?= $selisih ?> hari</h1>
                <?php endif; ?>
                <form action="/catat-haid-hari-ini" method="post">
        <button type="submit" class="btn btn-pink rounded-pill px-5 py-3">Catat Periode Haid</button>
    </form>

            </div>
        <?php endif; ?>

        <div class="text-center mt-5" >
            <a href="/note" class="btn btn-pink rounded-pill px-5 py-3" style="margin-left: 300px;">Catat Gejala</a>
        </div>
    </div>
</div>

<!-- Modal Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center" style="border-radius: 20px; padding: 20px;">
      <div class="modal-body">
        <img src="<?= base_url('assets/warning.png') ?>" alt="!" style="width: 50px; margin-bottom: 10px;">
        <h5 class="fw-bold">Yakin ingin keluar?</h5>
        <p class="text-muted">Data yang dihapus tidak bisa dikembalikan!</p>
        <div class="d-flex justify-content-center gap-3 mt-3">
          <a href="/splash" class="btn btn-pink">Ya!</a>
          <button class="btn" style="background-color: #fbd9e0; color: #333;" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
