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

            <a href="<?= base_url('profil') ?>" class="menu-btn">
                <img class="icon-menu" src="<?= base_url('fotomira/backk.png') ?>" alt="back">Kembali
            </a>
        </aside>
    </div>


    <!-- Panel Kanan -->
    <div class="panel-profil-kn">
        <div class="card-profil">
            <div class="text-center mb-5">
                <img src="<?= base_url('fotomira/people.png') ?>" alt="profil" style="max-width: 150px;">
            </div>

            <?php if (session()->getFlashdata('validation')) : ?>
            <div id="validation-errors">
                <?= validation_list_errors() ?>
            </div>
            <?php endif; ?>

            <form action="<?= base_url('profil/editp') ?>" method="post">
                <?= csrf_field() ?>

                <div class="mb-3 font-poppins edit-data">
                    <label class="edit-label">Username</label>
                    <input type="text" name="username" class="edit-input" value="<?= esc($user['username']) ?>">
                </div>

                <div class="mb-3 font-poppins edit-data">
                    <label class="edit-label">Email</label>
                    <input type="email" name="email" class="edit-input" value="<?= esc($user['email']) ?>">
                </div>

                <div class="mb-3 font-poppins edit-data position-relative">
                    <label class="edit-label">Password</label>
                    <input type="password" name="password" class="edit-input show-tooltip" placeholder="Kosongkan jika tidak diubah"
                        data-tooltip="Password minimal terdiri dari 8 karakter, huruf besar, kecil, dan angka.">
                        <div class="tooltip-msg t-edit"></div>
                </div>

                <div class="mb-3 font-poppins edit-data">
                    <label class="edit-label">Jenis Kelamin</label>
                    <input type="text" name="seks" class="edit-input edit-seks" value="Perempuan" readonly>
                </div>

                <div class="mb-3 font-poppins edit-data position-relative">
                    <label class="edit-label">Usia</label>
                    <input type="text" name="usia" class="edit-input show-tooltip" value="<?= esc($user['usia']) ?>"
                        data-tooltip="Masukkan usia minimal 9 tahun.">
                        <div class="tooltip-msg t-edit"></div>
                </div>

                <div class="mb-3 font-poppins edit-data position-relative">
                    <label class="edit-label">Tinggi Badan</label>
                    <input type="text" name="tinggi" class="edit-input show-tooltip" value="<?= esc($user['tinggi']) ?>"
                        data-tooltip="Masukkan tinggi badan minimal 140 cm.">
                        <div class="tooltip-msg t-edit"></div>
                </div>

                <div class="mb-3 font-poppins edit-data position-relative">
                    <label class="edit-label">Berat Badan</label>
                    <input type="text" name="berat" class="edit-input show-tooltip" value="<?= esc($user['berat']) ?>"
                        data-tooltip="Masukkan berat badan minimal 35 kg.">
                        <div class="tooltip-msg t-edit"></div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn-custom">Simpan</button>
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