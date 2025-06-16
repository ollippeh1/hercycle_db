<?php $current = uri_string(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <link rel="stylesheet" href="/assets/style-chatbotview.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <img src="<?= base_url('assets/img/putihgambar.png') ?>" alt="Logo Perusahaan" class="logo-img">
            </div>
            <a href="<?= base_url('dashboard') ?>" class="menu-btn <?= ($current == 'dashboard') ? 'active' : '' ?>">
                <img class="icon-menu" src="<?= base_url('assets/img/dashboard1.png') ?>" alt="Dashboard"> Dashboard
            </a>

            <a href="<?= base_url('kalender') ?>" class="menu-btn <?= ($current == 'kalender') ? 'active' : '' ?>">
                <img class="icon-menu" src="<?= base_url('assets/img/time-and-date.png') ?>" alt=""> Kalender
            </a>

            <a href="<?= base_url('note') ?>" class="menu-btn <?= ($current == 'note') ? 'active' : '' ?>">
                <img class="icon-menu" src="<?= base_url('assets/img/clipboard.png') ?>" alt=""> Note
            </a>

            <a href="<?= base_url('user/chatbot') ?>" class="menu-btn <?= ($current == 'user/chatbot') ? 'active' : '' ?>">
                <img class="icon-menu" src="<?= base_url('assets/img/message.png') ?>" alt=""> Chat AI
            </a>

            <a href="<?= base_url('user/edukasi') ?>" class="menu-btn <?= ($current == 'user/edukasi') ? 'active' : '' ?>">
                <img class="icon-menu" src="<?= base_url('assets/img/document 2.png') ?>" alt=""> Edukasi
            </a>

        </aside>

        <main class="main-content">
            <div class="topbar">
                <div class="top-icons">
                    <a href="<?= base_url('profil') ?>" class="profile-btn" id="profil-btn" aria-label="Profil Pengguna">
                        <img src="<?= base_url('assets/img/people.png') ?>" alt="Ikon Profil" class="icon-btn">
                    </a>

                    <a href="#" class="logout-btn" id="logout-btn" aria-label="Keluar">
                        <img src="<?= base_url('assets/img/log-out 1.png') ?>" alt="Ikon Logout" class="icon-btn">
                    </a>
                </div>
            </div>


            <!-- Konten Utama -->
            <div class="card-container">
                <div class="chatbot-section">
                    <div class="content-header">
                        <span class="date"><?= esc($content['date']) ?></span>
                        <span class="category"><?= esc($content['category']) ?></span>
                    </div>

                    <div class="welcome-section">
                        <h2><?= esc($content['title']) ?></h2>
                        <p class="subtitle">Asisten Edukasi khususnya untuk haid & hamil</p>

                        <div class="buttons">
                            <?php foreach ($content['buttons'] as $button): ?>
                                <a href="<?= esc($button['url']) ?>" class="btn"><?= esc($button['text']) ?></a>
                            <?php endforeach; ?>
                        </div>

                        <div>
                            <p class="chatbot-disclaimer">
                                Chat AI ini dibangun dengan menggunakan API key dari Gemini.
                                Fitur ini memungkinkan Anda bertanya berbagai hal, termasuk seputar kehamilan dan menstruasi.
                                Harap diingat bahwa setiap jawaban yang diberikan oleh Chat AI ini hanya bersifat rekomendasi,
                                bukan diagnosis atau pengganti saran medis profesional.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>
    </div>
    <script>
document.getElementById('logout-btn').addEventListener('click', function(e) {
    e.preventDefault(); // Hindari langsung redirect

    Swal.fire({
        title: 'Yakin ingin keluar?',
        text: "Anda akan keluar dari akun ini.",
        icon: 'warning',
        background: '#ffe6f0',
        iconColor: '#ff69b4',
        showCancelButton: true,
        confirmButtonColor: '#ff4d88',
        cancelButtonColor: '#ffb6c1',
        confirmButtonText: 'Ya, logout',
        cancelButtonText: 'Batal',
        customClass: {
            popup: 'swal-custom',
            confirmButton: 'swal-confirm',
            cancelButton: 'swal-cancel'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= base_url('logout') ?>";
        }
    });
});
</script>

</body>

</html>