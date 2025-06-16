<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
</head>

<body>
    <div class="form-container">
        <h2 class="form-title">➕ Tambah Materi Edukasi</h2>

        <form action="<?= base_url('admin/materi/simpan') ?>" method="post">
            <?= csrf_field() ?>

            <label for="judul">Judul</label>
            <input type="text" id="judul" name="judul" required>

            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" required></textarea>

            <label for="gambar">URL Gambar</label>
            <input type="text" id="gambar" name="gambar">

            <label for="kategori">Kategori</label>
            <select id="kategori" name="kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Haid">Haid</option>
                <option value="Hamil">Hamil</option>
            </select>

            <label for="penulis">Penulis</label>
<input type="text" id="penulis" name="penulis" required>

            
            <div class="form-buttons">
                <button type="submit" class="btn simpan">Simpan</button>
                <a href="<?= base_url('admin/materi') ?>" class="btn kembali">Kembali</a>
            </div>
        </form>
    </div>
</body>

</html>