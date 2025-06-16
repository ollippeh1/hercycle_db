<?php $current = uri_string(); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edukasi Pengguna</title>
    <link rel="stylesheet" href="<?= base_url('assets/style-user.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <img src="<?= base_url('assets/img/putihgambar.png') ?>" alt="Logo" class="logo-img">
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
                <div class="search-wrapper">
                    <input type="text" class="search" placeholder="Cari..." id="searchInput">
                </div>
                <div class="top-icons">
                    <button class="profile-btn" id="profil-btn">
                        <img src="<?= base_url('assets/img/people.png') ?>" alt="Profil" class="icon-btn">
                    </button>
                    <button class="logout-btn" id="logout-btn">
                        <img src="<?= base_url('assets/img/log-out 1.png') ?>" alt="Logout" class="icon-btn">
                    </button>
                </div>
            </div>

            <div class="content-box">
                <div class="tabs">
                    <button class="tab-btn active" data-tab="semua">
                        <img src="<?= base_url('assets/img/🦆 icon _book_.png') ?>" alt="Semua" class="icon"> Semua
                    </button>
                    <button class="tab-btn" data-tab="haid">
                        <img src="<?= base_url('assets/img/🦆 icon _library books_.png') ?>" alt="Artikel Haid" class="icon"> Artikel Haid
                    </button>
                    <button class="tab-btn" data-tab="hamil">
                        <img src="<?= base_url('assets/img/🦆 icon _library books_.png') ?>" alt="Artikel Hamil" class="icon"> Artikel Hamil
                    </button>
                </div>

                <div class="articles">
                    <?php if (!empty($articles)): ?>
                        <?php foreach ($articles as $article): ?>
                            <div class="article-box tab-content" data-content="<?= strtolower($article['category']) ?>">
                                <a href="<?= base_url('user/edukasi/' . $article['id']) ?>" class="article-image-link">
                                    <?php if (!empty($article['gambar'])): ?>
                                        <img src="<?= esc($article['gambar']) ?>" alt="<?= esc($article['title']) ?>" class="article-image" onerror="this.src='<?= base_url('assets/img/default-article.jpg') ?>'">
                                    <?php else: ?>
                                        <img src="<?= base_url('assets/img/default-article.jpg') ?>" alt="Default image" class="article-image">
                                    <?php endif; ?>
                                </a>
                                <div class="article-content">
                                    <h3><a href="<?= base_url('user/edukasi/' . $article['id']) ?>" class="article-link"><?= esc($article['title']) ?></a></h3>
                                    <p><?= substr(esc($article['content']), 0, 100) ?>...</p>
                                    <p><strong>Penulis:</strong> <?= esc($article['penulis']) ?></p>
                                    <small class="article-date"><?= date('d M Y', strtotime($article['tanggal'])) ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="no-articles">
                            <p>Tidak ada materi edukasi tersedia saat ini.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

    <script src="<?= base_url('assets/script-user.js') ?>"></script>
</body>

</html>