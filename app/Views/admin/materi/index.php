<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <img src="<?= base_url('assets/img/putihgambar.png') ?>" alt="Logo" class="logo-img">
            </div>
            <ul class="menu">
                <li class="active menu-sidebar">
                    <img class="icon" src="<?= base_url('assets/img/document 2.png') ?>" alt="Edukasi Admin">
                    Edukasi Admin
                </li>
            </ul>
        </aside>
        <main class="main-content">
            <div class="user-menu">
                <a href="<?= base_url('logout') ?>" class="icon-btn" title="Logout">
                    <img src="<?= base_url('assets/img/log-out 1.png') ?>" alt="Logout">
                </a>
            </div>

            <header>
                <h1>
                    <img src="<?= base_url('assets/img/semua.png') ?>" alt="Ikon Buku"
                        style="width:50px; height:50px; vertical-align: middle; margin-right: 8px;">
                    Daftar Materi Edukasi
                </h1>
                <a href="<?= base_url('admin/materi/tambah') ?>" class="btn-add">➕ Tambah</a>
            </header>

            <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert">
                <?= session()->getFlashdata('pesan') ?>
            </div>
            <?php endif; ?>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                        <th>Penulis</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($materi as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= esc($row['judul']) ?></td>
                        <td><?= esc(substr($row['deskripsi'], 0, 50)) . '...'; ?></td>
                        <td>
                            <?php if ($row['gambar']) : ?>
                            <img src="<?= esc($row['gambar']) ?>" alt="gambar" style="width:80px;">
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url('admin/materi/detail/' . $row['id']) ?>" class="btn detail">
                                    <img src="<?= base_url('assets/img/document 2.png') ?>" alt="Detail"> Detail
                                </a>
                                <a href="<?= base_url('admin/materi/edit/' . $row['id']) ?>" class="btn edit">
                                    <img src="<?= base_url('assets/img/document 2.png') ?>" alt="Edit"> Edit
                                </a>
                                <button class="btn hapus" onclick="hapusLangsung(<?= $row['id'] ?>)">
                                    <img src="<?= base_url('assets/img/document 2.png') ?>" alt="Hapus"> Hapus
                                </button>
                            <td><?= esc($row['penulis']) ?></td>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
<script>
function hapusLangsung(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data yang dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        background: '#ffe6f0', // Warna pink muda
        iconColor: '#ff69b4', // Warna ikon pink
        showCancelButton: true,
        confirmButtonColor: '#ff4d88', // Pink tua
        cancelButtonColor: '#ffb6c1', // Pink muda
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        customClass: {
            popup: 'swal-custom',
            confirmButton: 'swal-confirm',
            cancelButton: 'swal-cancel'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= base_url('admin/materi/hapus/') ?>' + id;
        }
    });
}
</script>

</body>

</html>