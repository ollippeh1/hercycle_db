<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Kalender Haid</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('public/css/style.css') ?>">
  <style>
    <?php include(FCPATH . 'css/kalender.css'); ?>
  </style>
</head>

<body>
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="logo">
        <img src="<?= base_url('assets/img/logo.png') ?>" class="logo-img">
      </div>
      <a class="menu-btn"><img src="<?= base_url('assets/img/dashboard.png') ?>" class="icon-menu"> Dashboard</a>
      <a class="menu-btn active"><img src="<?= base_url('assets/img/kalender.png') ?>" class="icon-menu"> Kalender</a>
      <a class="menu-btn"><img src="<?= base_url('assets/img/note.png') ?>" class="icon-menu"> Note</a>
      <a class="menu-btn"><img src="<?= base_url('assets/img/chat_ai.png') ?>" class="icon-menu"> Chat AI</a>
      <a class="menu-btn"><img src="<?= base_url('assets/img/edukasi.png') ?>" class="icon-menu"> Edukasi</a>
    </div>

    <!-- Konten -->
    <div class="main-content" style="position:relative;">
      <div class="top-right-floating">
        <a href="#"><img src="<?= base_url('assets/img/profil.png') ?>" alt="Profil"></a>
        <a href="#"><img src="<?= base_url('assets/img/logout.png') ?>" alt="Logout"></a>
      </div>

      <!-- Top Bar: Dropdown Haid (Hari Saja) Kiri + Profil & Logout Kanan -->
        <div class="top-bar" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">

          <!-- KIRI: Dropdown Input Hari Haid -->
          <div class="dropdown-form" style="margin-left: 20px;">
            <form action="<?= base_url('kalender/simpan') ?>" method="post" style="display:flex; align-items:center; margin-left: 20px;">
              <select name="tanggal" style="padding:5px; border-radius:5px; background-color: #CD4C77; color: #333;">
                <option selected disabled>Pilih Hari Pertama Haid</option>
                <?php for ($d = 1; $d <= $days_in_month; $d++): ?>
                  <option value="<?= $d ?>"><?= $d ?></option>
                <?php endfor; ?>
              </select>
             <button type="submit" style="margin-left:10px; padding:5px 10px; border-radius:5px; background-color: #CD4C77; color: #333;">Simpan</button>
            </form>
          </div>
        </div>

      <div class="calendar-section">

        <!-- Judul Bulan -->
        <h2 style="text-align:center; margin-top:-10px;">
          <?= strtoupper(date('F')) ?>
        </h2>

        <!-- Kalender -->
        <table class="calendar">
          <tr>
            <th>Min</th>
            <th>Sen</th>
            <th>Sel</th>
            <th>Rab</th>
            <th>Kam</th>
            <th>Jum</th>
            <th>Sab</th>
          </tr>
          <?php
          $day = 1;
          for ($i = 0; $i < 6; $i++) {
            echo "<tr>";
            for ($j = 0; $j < 7; $j++) {
              if ($i == 0 && $j < $start_day) {
                echo "<td></td>";
              } elseif ($day > $days_in_month) {
                echo "<td></td>";
              } else {
                $tgl = date('Y-m-') . str_pad($day, 2, '0', STR_PAD_LEFT);
                $class = '';

                if ($haid_tanggal && $tgl >= $haid_tanggal && $tgl <= $haid_selesai) {
                  $class = 'haid';
                } elseif ($tgl == $ovulasi) {
                  $class = 'ovulasi';
                }

                echo "<td class='$class'>$day</td>";
                $day++;
              }
            }
            echo "</tr>";
            if ($day > $days_in_month) break;
          }
          ?>
        </table>

        <!-- Keterangan Warna -->
        <div class="legend">
          <span class="dot haid-dot"></span> Haid Hari Pertama s.d. ke-5 &nbsp;&nbsp;
          <span class="dot ovulasi-dot"></span> Ovulasi (Hari ke-14)
        </div>
      </div>
    </div>
  </div>
</body>

</html>