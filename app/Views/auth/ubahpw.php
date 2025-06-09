<?= $this->extend('layoutsm/main') ?>

<?= $this->section('content') ?>

<div class="d-flex min-vh-100">
    <!-- Panel Kiri -->
    <div class="kiri-panel">
        <div class="logo-forget text-center mb-3">
            <img src="<?= base_url('fotomira/logo.png') ?>" alt="Logo" style="max-width: 300px;">
        </div>
        <div class="pink"></div>
        <div class="muda"></div>
    </div>

    <!-- Panel Kanan -->
    <div class="kanan-panel">
        <div class="kotak-pw">
            <h4 class="text-forget">Password Baru</h4><br>

            <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success" id="flash-success">
                <?= session()->getFlashdata('success'); ?>
            </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger" id="flash-error">
                <?= session()->getFlashdata('error'); ?>
            </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('_ci_validation_errors')) : ?>
            <div class="alert alert-danger" id="validation-errors">
                <?= validation_list_errors() ?>
            </div>
            <?php endif; ?>

            <form action="<?= base_url('/lupapw/ubahpw') ?>" method="post">
                <?= csrf_field() ?>
                <p class="pesan">
                    <?php echo "Buat kata sandi baru yang minimal terdiri dari 8 <br> 
                    karakter, huruf besar, kecil, dan angka" ?>
                </p>

                <div class="font-poppins d-flex align-items-center input-forget">
                    <input type="hidden" name="email" value="<?= esc($email) ?>">
                    <img src="<?= base_url('fotomira/key.png') ?>" class="icon-regist" alt="key">
                    <input type="password" name="password" class="custom-input" placeholder="Password" required>
                </div>

                <div class="font-poppins d-flex align-items-center input-forget">
                    <img src="<?= base_url('fotomira/lock.png') ?>" class="icon-regist" alt="lock"> <input
                        type="password" name="confirm" class="custom-input" placeholder="Konfirmasi Password" required>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="continue">Continue</button>
                </div>
                <div class="daftar">
                    <?php echo "Belum punya akun?" ?>
                    <a href="<?= base_url('register') ?>">Daftar</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>

<?= $this->endSection() ?>