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
            <h4 class="text-forget">Verifikasi OTP</h4><br>

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

            <form action="<?= base_url('/lupapw/verifikasiotp') ?>" method="post">
                <?= csrf_field() ?>
                <p class="pesan"><?php echo "Kami baru saja mengirim kode ke $email <br>
                    Masukkan kode OTP 6 digit di bawah ini"?>
                </p>

                <div class="otp-wrapper">
                    <input type="hidden" name="email" value="<?= esc($email) ?>">
                    <input type="text" class="otp-input" maxlength="1" name="otp1" required>
                    <input type="text" class="otp-input" maxlength="1" name="otp2" required>
                    <input type="text" class="otp-input" maxlength="1" name="otp3" required>
                    <input type="text" class="otp-input" maxlength="1" name="otp4" required>
                    <input type="text" class="otp-input" maxlength="1" name="otp5" required>
                    <input type="text" class="otp-input" maxlength="1" name="otp6" required>
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

<script>
const inputs = document.querySelectorAll(".otp-input");

inputs.forEach((input, index) => {
    input.addEventListener("input", () => {
        if (input.value.length === 1 && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }
    });

    input.addEventListener("keydown", (e) => {
        if (e.key === "Backspace" && input.value === "" && index > 0) {
            inputs[index - 1].focus();
        }
    });
});
</script>

<?= $this->endSection() ?>