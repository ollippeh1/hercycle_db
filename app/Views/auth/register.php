<?= $this->extend('layoutsm/main') ?>

<?= $this->section('content') ?>

<div class="d-flex min-vh-100">
    <!-- Panel Kiri -->
    <div class="left-panel">
        <a href="<?= base_url('register') ?>" class="nav-link nav-atas">SIGN UP</a>
        <a href="<?= base_url('login') ?>" class="nav-link nav-bawah">LOGIN</a>
    </div>

    <!-- Panel Kanan -->
    <div class="right-panel">
        <div class="card-body">
            <div class="text-center mb-3">
                <img src="<?= base_url('fotomira/logo.png') ?>" alt="Logo" style="max-width: 150px;">
            </div>
            <h4 class="text-center text-white font-croissant font-weight-bold mb-5">SIGN UP</h4>

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

            <?php if (session()->getFlashdata('validation')) : ?>
            <div id="validation-errors">
                <?= validation_list_errors() ?>
            </div>
            <?php endif; ?>

            <form action="<?= base_url('register') ?>" method="post">
                <?= csrf_field() ?>
                <div class="font-poppins d-flex align-items-center input-icon-group">
                    <img src="<?= base_url('fotomira/user.png') ?>" class="icon-regist" alt="user">
                    <input type="text" name="username" class="custom-input" placeholder="Username"
                        value="<?= old('username') ?>" required>
                </div>

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
                    <img src="<?= base_url('fotomira/lock.png') ?>" class="icon-regist" alt="lock"> <input
                        type="password" name="confirm" class="custom-input" placeholder="Konfirmasi Password" required>
                </div>

                <div class="font-poppins d-flex align-items-center input-icon-group position-relative">
                    <img src="<?= base_url('fotomira/age.png') ?>" class="icon-regist" alt="age">
                    <input type="text" name="usia" class="custom-input show-tooltip" placeholder="Usia"
                        value="<?= old('usia') ?>" required data-tooltip="Masukkan usia minimal 9 tahun.">
                    <div class="tooltip-msg"></div>
                </div>

                <div class="font-poppins d-flex align-items-center input-icon-group position-relative">
                    <img src="<?= base_url('fotomira/height.png') ?>" class="icon-regist" alt="height">
                    <input type="text" name="tinggi" class="custom-input show-tooltip" placeholder="Tinggi Badan"
                        value="<?= old('tinggi') ?>" required data-tooltip="Masukkan tinggi badan minimal 140 cm.">
                    <div class="tooltip-msg"></div>
                </div>

                <div class="font-poppins d-flex align-items-center input-icon-group position-relative">
                    <img src="<?= base_url('fotomira/scale.png') ?>" class="icon-regist" alt="scale">
                    <input type="text" name="berat" class="custom-input show-tooltip" placeholder="Berat Badan"
                        value="<?= old('berat') ?>" required data-tooltip="Masukkan berat badan minimal 35 kg.">
                    <div class="tooltip-msg"></div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn-custom">SIGN UP</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.querySelectorAll('.show-tooltip').forEach(input => {
    const tooltipBox = input.parentElement.querySelector('.tooltip-msg');

    input.addEventListener('focus', () => {
        tooltipBox.textContent = input.getAttribute('data-tooltip');
        tooltipBox.style.display = 'block';
    });

    input.addEventListener('blur', () => {
        tooltipBox.style.display = 'none';
    });
});
</script>
<?= $this->endSection() ?>