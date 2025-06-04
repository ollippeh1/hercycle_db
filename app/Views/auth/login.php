<?= $this->extend('layoutsm/main') ?>

<?= $this->section('content') ?>

<div class="d-flex min-vh-100">
    <!-- Panel Kiri -->
    <div class="left-panel">
        <a href="<?= base_url('register') ?>" class="nav-link nav-bawah">SIGN UP</a>
        <a href="<?= base_url('login') ?>" class="nav-link nav-atas">LOGIN</a>
    </div>

    <!-- Panel Kanan -->
    <div class="right-panel">
        <div class="card-body">
            <div class="text-center mb-3">
                <img src="<?= base_url('fotomira/logo.png') ?>" alt="Logo" style="max-width: 150px;">
            </div>
            <h4 class="text-center text-white font-croissant font-weight-bold">SIGN UP</h4><br>

            <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success">
                <?php echo session()->getFlashdata('success'); ?>
            </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger">
                <?php echo session()->getFlashdata('error'); ?>
            </div>
            <?php endif; ?>

            <?= validation_list_errors() ?>


            <form action="<?= base_url('login') ?>" method="post">
                <?= csrf_field() ?>
                <div class="font-poppins d-flex align-items-center input-icon-group">
                    <img src="<?= base_url('fotomira/email.png') ?>" class="icon-regist" alt="email">
                    <input type="email" name="email" class="custom-input" placeholder="Email"
                        value="<?= old('email') ?>" required>
                </div>

                <div class="font-poppins d-flex align-items-center input-icon-group position-relative">
                    <img src="<?= base_url('fotomira/key.png') ?>" class="icon-regist" alt="key">
                    <input type="password" name="password" class="custom-input show-tooltip" placeholder="Password"
                        required
                        data-tooltip="Password minimal terdiri dari 8 karakter, huruf besar, kecil, dan angka.">
                    <div class="tooltip-msg"></div>
                </div>

                <div class="font-poppins d-flex align-items-center input-icon-group">
                    <img src="<?= base_url('fotomira/selection.png') ?>" class="icon-regist" alt="selection">
                    <select name="login_sebagai" class="custom-select" aria-label="Small select example">
                        <option selected value="usr">Pengguna</option>
                        <option value="adm">Admin</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-custom">LOGIN</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>

<?= $this->endSection() ?>