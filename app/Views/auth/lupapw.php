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
            <h4 class="text-forget">Forget Password?</h4><br>

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

            <form action="<?= base_url('lupapw') ?>" method="post">
                <?= csrf_field() ?>
                <p class="pesan"><?php echo "Mohon masukkan email yang benar" ?></p>

                <div class="font-poppins d-flex align-items-center input-forget">
                    <img src="<?= base_url('fotomira/email.png') ?>" class="icon-regist" alt="email">
                    <input type="email" name="email" class="custom-input" placeholder="Email"
                        value="<?= old('email') ?>" required>
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