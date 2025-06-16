<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/style-user.css') ?>">
</head>

<body>
    <div class="main-wrapper">
        <div class="card">
            <div class="header">
                <h2><?= esc($title) ?></h2>
                <p class="meta"><?= date('d M Y', strtotime($tanggal)) ?> - Kategori: <?= esc($category) ?> - Penulis: <?= esc($penulis) ?></p>
            </div>

            <?php if ($gambar): ?>
                <div class="image-wrapper">
                    <img src="<?= esc($gambar) ?>" alt="<?= esc($title) ?>" onerror="this.src='<?= base_url('assets/img/default-article.jpg') ?>'">
                </div>
            <?php endif; ?>

            <div class="content">
                <?= nl2br(esc($content)) ?>
            </div>
            <a class="back-link" href="<?= base_url('user/edukasi') ?>">Kembali</a>
        </div>
    </div>
</body>

</html>