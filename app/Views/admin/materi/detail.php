<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
</head>
<body>
    <div class="container">
        <main class="main-content">
            <h2><?= esc($materi['judul']) ?></h2>
            <?php if ($materi['gambar']) : ?>
                <img src="<?= esc($materi['gambar']) ?>" alt="gambar" style="width:300px;">
            <?php endif; ?>
            <div class="deskripsi">
                <h3>Deskripsi:</h3>
                <p><?= nl2br(esc($materi['deskripsi'])) ?></p>
                <p><strong>Tanggal:</strong> <?= esc($materi['tanggal']) ?></p>
                <p><strong>Penulis:</strong> <?= esc($materi['penulis']) ?></p>
                <a href="<?= base_url('admin/materi') ?>" class="btn kembali">Kembali</a>
            </div>
        </main>
    </div>
</body>
</html>