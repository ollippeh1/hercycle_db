<?= $this->extend('layoutsm/main') ?>

<?= $this->section('content') ?>

<div class="profil-wrapper min-vh-100">
    <!-- Panel Kiri -->
    <div class="panel-profil-kr">
            <aside class="sidebar">
                <div class="logo">
                    <img src="<?= base_url('fotomira/logo.png') ?>" alt="Logo" class="logo-img">
                </div>

                <a href="<?= base_url('dashboard') ?>" class="menu-btn">
                    <img class="icon-menu" src="<?= base_url('fotomira/dashboard.png') ?>" alt="dash">Dashboard
                </a>

                <a href="<?= base_url('profil/editp') ?>" class="menu-btn">
                    <img class="icon-menu" src="<?= base_url('fotomira/editp.png') ?>" alt="edit">Edit Profil
                </a>

                <a href="<?= base_url('pengaturan') ?>" class="menu-btn">
                    <img class="icon-menu" src="<?= base_url('fotomira/settings.png') ?>" alt="settings">Pengaturan
                </a>

                <form action="<?= base_url('profil/hapusacc') ?>" method="post"
                    onsubmit="return confirm('Yakin ingin menghapus akun Anda secara permanen?');">
                    <?= csrf_field() ?>
                    <button type="submit" class="menu-btn">
                        <img class="icon-menu" src="<?= base_url('fotomira/removep.png') ?>" alt="remove">Hapus Akun
                    </button>
                </form>

                <a href="<?= base_url('logout') ?>" class="menu-btn">
                    <img class="icon-menu" src="<?= base_url('fotomira/logout.png') ?>" alt="logout">Logout
                </a>
            </aside>   
    </div>


    <!-- Panel Kanan -->
    <div class="panel-profil-kn">
        <div class="card-profil">
            <div class="text-center">
                <img src="<?= base_url('fotomira/people.png') ?>" alt="profil" style="max-width: 150px;">
            </div>
            <h4 class="usrname">
                <?= esc($user['username']) ?>
            </h4><br>

            <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success" id="flash-success">
                <?= session()->getFlashdata('success'); ?>
            </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('info')) : ?>
            <div class="alert alert-info" id="flash-error">
                <?= session()->getFlashdata('info'); ?>
            </div>
            <?php endif; ?>

            <form action="<?= base_url('profil') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3 font-poppins tampil-data">
                    <label>Email</label>
                    <input type="email" name="email" class="custom-input fc-pr" value="<?= esc($user['email']) ?>"
                        readonly>
                </div>

                <div class="mb-3 font-poppins tampil-data">
                    <label>Password</label>
                    <input type="password" name="password" class="custom-input fc-pr" value="********" readonly>
                </div>

                <div class="mb-3 font-poppins tampil-data">
                    <label>Status Reproduksi</label>
                    <select name="status" class="custom-select" aria-label="Small select example">
                        <option selected value="mens">Menstruasi</option>
                        <option value="hamil">Hamil</option>
                    </select>
                </div>

                <div class="mb-3 font-poppins custom-seks">
                    <label>Jenis Kelamin</label>
                    <input type="text" name="seks" class="custom-input fc-pr" value="Perempuan" readonly>
                </div>

                <div class="mb-3 font-poppins tampil-data">
                    <label>Usia</label>
                    <input type="text" name="usia" class="custom-input fc-pr" value="<?= esc($user['usia']) . ' tahun' ?>"
                        readonly>
                </div>

                <div class="mb-3 font-poppins tampil-data">
                    <label>Tinggi Badan</label>
                    <input type="text" name="tinggi" class="custom-input fc-pr" value="<?= esc($user['tinggi']) . ' cm' ?>"
                        readonly>
                </div>

                <div class="mb-3 font-poppins tampil-data">
                    <label>Berat Badan</label>
                    <input type="text" name="berat" class="custom-input fc-pr" value="<?= esc($user['berat']) . ' kg' ?>"
                        readonly>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>