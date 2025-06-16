<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
</head>

<body>
  <div class="form-container">
    <h2 class="form-title">Edit Materi Edukasi</h2>

    <form action="<?= base_url('admin/materi/update/' . $materi['id']) ?>" method="post">
      <?= csrf_field() ?>

      <label for="judul">Judul</label>
      <input type="text" id="judul" name="judul" value="<?= esc($materi['judul']) ?>" required>

      <label for="deskripsi">Deskripsi</label>
      <textarea id="deskripsi" name="deskripsi" rows="4" required><?= esc($materi['deskripsi']) ?></textarea>

      <label for="gambar">URL Gambar</label>
      <input type="text" id="gambar" name="gambar" value="<?= esc($materi['gambar']) ?>">

      <label for="kategori">Kategori</label>
      <select id="kategori" name="kategori" required>
        <option value="Haid" <?= (stripos($materi['kategori'], 'haid') !== false) ? 'selected' : '' ?>>Haid</option>
        <option value="Hamil" <?= (stripos($materi['kategori'], 'hamil') !== false) ? 'selected' : '' ?>>Hamil</option>
        <option value="Haid" <?= ($materi['kategori'] === 'Haid') ? 'selected' : '' ?>>Haid</option>
        <option value="Hamil" <?= ($materi['kategori'] === 'Hamil') ? 'selected' : '' ?>>Hamil</option>
      </select>

      <label for="penulis">Penulis</label>
      <input type="text" id="penulis" name="penulis" value="<?= esc($materi['penulis']) ?>" required>


      <div class="form-buttons">
        <button type="submit" class="btn simpan">Update</button>
        <a href="<?= base_url('admin/materi') ?>" class="btn kembali">Kembali</a>
      </div>
    </form>
  </div>
</body>

</html>