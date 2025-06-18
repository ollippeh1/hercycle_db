<?php $current = uri_string(); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Note - HerCycle</title>
    <link rel="stylesheet" href="<?= base_url('assets/style-note.css') ?>">
</head>

<body>
    <!-- TOPBAR -->
    <div class="topbar">
        <a href="<?= base_url('profil') ?>" class="icon-link" title="Profil">
            <img src="<?= base_url('assets/img/profil.png') ?>" alt="Profil">
        </a>
        <a href="<?= base_url('logout') ?>" class="icon-link" title="Logout">
            <img src="<?= base_url('assets/img/logout.png') ?>" alt="Logout">
        </a>
    </div>

    <div class="container">
       <aside class="sidebar">
            <div class="logo">
                <img src="<?= base_url('assets/img/putihgambar.png') ?>" alt="Logo Perusahaan" class="logo-img">
            </div>
            <a href="<?= base_url('dashboard') ?>" class="menu-btn <?= ($current == 'dashboard') ? 'active' : '' ?>">
                <img class="icon-menu" src="<?= base_url('assets/img/dashboard1.png') ?>" alt="Dashboard"> Dashboard
            </a>

            <a href="<?= base_url('kalender') ?>" class="menu-btn <?= ($current == 'kalender') ? 'active' : '' ?>">
                <img class="icon-menu" src="<?= base_url('assets/img/time-and-date.png') ?>" alt=""> Kalender
            </a>

            <a href="<?= base_url('note') ?>" class="menu-btn <?= ($current == 'note') ? 'active' : '' ?>">
                <img class="icon-menu" src="<?= base_url('assets/img/clipboard.png') ?>" alt=""> Note
            </a>

            <a href="<?= base_url('user/chatbot') ?>" class="menu-btn <?= ($current == 'user/chatbot') ? 'active' : '' ?>">
                <img class="icon-menu" src="<?= base_url('assets/img/message.png') ?>" alt=""> Chat AI
            </a>

            <a href="<?= base_url('user/edukasi') ?>" class="menu-btn <?= ($current == 'user/edukasi') ? 'active' : '' ?>">
                <img class="icon-menu" src="<?= base_url('assets/img/document 2.png') ?>" alt=""> Edukasi
            </a>

        </aside>
        <!-- Content -->
        <div class="content">
            <form action="<?= base_url('/note/save') ?>" method="post">
                <div class="note-card">
                    <h2>Bagaimana kondisi Anda sekarang?</h2>
                    <div class="tags">
                        <!-- Kondisi -->
                        <?php
                        $conditions = [
                            'Tenang' => 'tenang.png',
                            'Kelelahan' => 'kelelahan.png',
                            'Gembira' => 'gembira.png',
                            'Jerawat' => 'jerawat.png'
                        ];

                        foreach ($conditions as $value => $icon): ?>
                        <label>
                            <input type="radio" name="condition" value="<?= $value ?>">
                            <span class="tag">
                                <img src="<?= base_url('assets/' . $icon) ?>" class="tag-icon" alt="<?= $value ?>">
                                <?= $value ?>
                            </span>
                        </label>
                        <?php endforeach; ?>
                    </div>

                    <!-- Ovulasi -->
                    <h3>Test Ovulasi</h3>
                    <div class="ovulation-group">
                        <label class="ovulation-option">
                            <input type="radio" name="ovulation_test" value="Positive">
                            <div class="option-content">
                                <img src="<?= base_url('assets/positive.png') ?>" alt="Positive">
                                <span>Positive</span>
                            </div>
                        </label>

                        <label class="ovulation-option">
                            <input type="radio" name="ovulation_test" value="Negative">
                            <div class="option-content">
                                <img src="<?= base_url('assets/negative.png') ?>" alt="Negative">
                                <span>Negative</span>
                            </div>
                        </label>
                    </div>


                    <!-- Intercourse -->
                    <h3>Intercourse</h3>
                    <div class="tags checkbox-group">
                        <?php
    $intercourseOptions = [
        'Tidak melakukan hubungan intim' => 'no_intercourse.png',
        'Hubungan intim dengan alat kontrasepsi' => 'contraceptive.png',
        'Hubungan intim tanpa alat kontrasepsi' => 'no_contraceptive.png',
        'Seks oral' => 'oral_sex.png',
        'Seks anal' => 'anal.png',
        'Masturbasi' => 'masturanal_sexbation.png',
        'Sentuhan sensual' => 'sensual_touch.png',
        'Orgasme' => 'orgasm.png'
    ];
    foreach ($intercourseOptions as $value => $icon): ?>
                        <div class="tag" onclick="toggleCheckbox(this)">
                            <input type="checkbox" name="intercourse[]" value="<?= $value ?>" hidden>
                            <img src="<?= base_url('assets/' . $icon) ?>" class="tag-icon" alt="<?= $value ?>">
                            <?= $value ?>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Symptoms -->
                    <h3>Symptoms</h3>
                    <div class="Symptoms-container">
                        <?php
    $symptomsOptions = [
        'Semuanya baik-baik saja' => 'baik.png',
        'Perut kram' => 'perut.png',
        'Nyeri payudara' => 'payudara.png',
        'Sakit kepala' => 'kepala.png',
        'Nyeri punggung' => 'punggung.png',
        'Jerawat' => 'jerawat.png',
        'Kelelahan' => 'kelelahan.png',
        'Insomnia' => 'insomnia.png',
        'Vagina terasa gatal' => 'gatal.png',
        'Vagina terasa kering' => 'kering.png'
    ];
    foreach ($symptomsOptions as $value => $icon): ?>
                        <div class="tag" onclick="toggleCheckbox(this)">
                            <input type="checkbox" name="symptoms[]" value="<?= $value ?>" hidden>
                            <img src="<?= base_url('assets/' . $icon) ?>" class="tag-icon" alt="<?= $value ?>">
                            <?= $value ?>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Mood -->
                    <h3>Mood</h3>
                    <div class="mood-container">
                        <?php
    $moodsOptions = [
        'Tenang' => 'emoji_tenang.png',
        'Gembira' => 'emoji_gembira.png',
        'Riang' => 'emoji_riang.png',
        'Berubah-ubah' => 'emoji_berubah.png',
        'Jengkel' => 'emoji_jengkel.png',
        'Sedih' => 'emoji_sedih.png',
        'Gelisah' => 'emoji_gelisah.png',
        'Depresi' => 'emoji_depresi.png',
        'Merasa bersalah' => 'emoji_bersalah.png',
        'Apatis' => 'emoji_apatis.png'
    ];
    foreach ($moodsOptions as $value => $icon): ?>
                        <div class="tag" onclick="toggleCheckbox(this)">
                            <input type="checkbox" name="mood[]" value="<?= $value ?>" hidden>
                            <img src="<?= base_url('assets/' . $icon) ?>" class="tag-icon" alt="<?= $value ?>">
                            <?= $value ?>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Weight & Height -->
                    <div class="flex-input">
                        <div>
                            <h3>Weight</h3>
                            <div class="unit-switch">
                                <label><input type="radio" name="weight_unit" value="kg" checked><span>Kg</span></label>
                                <label><input type="radio" name="weight_unit" value="pon"><span>Pon</span></label>
                            </div>

                            <!-- Counter -->
                            <div class="counter">
                                <button type="button" class="decrease">-</button>
                                <span class="value">0</span>
                                <button type="button" class="increase">+</button>
                                <input type="hidden" name="counter_value" class="counter-hidden" value="0">
                            </div>

                            <h3>Height</h3>
                            <div class="unit-switch">
                                <label><input type="radio" name="height_unit" value="cm" checked><span>Cm</span></label>
                                <label><input type="radio" name="height_unit" value="m"><span>M</span></label>
                            </div>

                            <!-- Counter -->
                            <div class="counter">
                                <button type="button" class="decrease">-</button>
                                <span class="value">0</span>
                                <button type="button" class="increase">+</button>
                                <input type="hidden" name="counter_value" class="counter-hidden" value="0">
                            </div>

                            <div class="note-card">
                                <div class="drink-card">
                                    <div class="drink-left">
                                        <img src="<?= base_url('assets/glass.png') ?>" alt="Gelas Air"
                                            class="drink-image" />
                                        <p class="volume">300 ml</p>
                                    </div>
                                    <div class="drink-right">
                                        <p class="drink-title">Drink Water</p>
                                        <div class="drink-counter">
                                            <button type="button" onclick="updateGlass(-1)">-</button>
                                            <span class="amount" id="glassCount">0</span>
                                            <span class="unit" id="totalMl">/ 0 ml</span>
                                            <button type="button" onclick="updateGlass(1)">+</button>
                                        </div>

                                        <script>
                                        let glassCount = 0;
                                        const glassVolume = 300; // 1 gelas = 300 ml
                                        const targetGlass = 7;

                                        function updateGlass(change) {
                                            glassCount = Math.max(0, Math.min(targetGlass, glassCount + change));
                                            document.getElementById("glassCount").innerText = glassCount;

                                            const totalMl = glassCount * glassVolume;
                                            document.getElementById("totalMl").innerText = `${totalMl} ml`;


                                            const percentage = (glassCount / targetGlass) * 100;
                                            document.getElementById("progressFill").style.width = percentage + "%";

                                            // Kalau kamu mau simpan ke input hidden
                                            const inputHidden = document.getElementById("jumlahGelasInput");
                                            if (inputHidden) inputHidden.value = glassCount;
                                        }
                                        </script>

                                        <p class="target-text">target 7 gelas</p>
                                        <div class="progress-bar">
                                            <div class="progress-fill" id="progressFill" style="width: 0%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Optional: hidden input if you want to submit this later -->
                            <input type="hidden" name="jumlah_gelas" id="jumlahGelasInput" value="0">
                            <button type="submit" class="submit-btn">Selesai &gt;&gt;&gt;&gt;&gt;&gt;</button>
                        </div>
                    </div> <!-- penutup flex-input -->
                </div> <!-- penutup note-card -->
            </form>
        </div> <!-- penutup content -->
    </div> <!-- penutup container -->

    <!-- SCRIPT -->
    <script>
    document.querySelectorAll('.counter').forEach(counter => {
        const value = counter.querySelector('.value');
        const hiddenInput = counter.querySelector('.counter-hidden');
        counter.querySelector('.increase').addEventListener('click', () => {
            const newValue = parseInt(value.textContent) + 1;
            value.textContent = newValue;
            hiddenInput.value = newValue;
        });
        counter.querySelector('.decrease').addEventListener('click', () => {
            if (parseInt(value.textContent) > 0) {
                const newValue = parseInt(value.textContent) - 1;
                value.textContent = newValue;
                hiddenInput.value = newValue;
            }
        });
    });
    </script>

    <script>
    function toggleCheckbox(tagElement) {
        const checkbox = tagElement.querySelector('input[type="checkbox"]');
        checkbox.checked = !checkbox.checked;
        tagElement.classList.toggle('selected', checkbox.checked);
    }
    </script>
</body>

</html>