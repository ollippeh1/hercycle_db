<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
    <title><?= $title; ?></title>
    <link rel="icon" href="<?= base_url('logo.ico') ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Croissant+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/stylemira.css') ?>">

</head>

<body>

    <!-- Content -->
    <?= $this->renderSection('content') ?>


    <!-- /.Content -->

    <footer class="text-center mt-5">
        <p><em><small>2025. Dari Awal Siklus ke Awal Kehidupan, HerCycle Ada untukmu. <a
                        href="https://qadrlabs.com/">@hercycle_</a></small></em></p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <?= $this->renderSection('scripts') ?>
    <!-- untuk tooltip-msg -->
    <?= $this->section('scripts') ?>
    <script>
    setTimeout(function() {
        const success = document.getElementById('flash-success');
        const error = document.getElementById('flash-error');
        if (success) success.style.display = 'none';
        if (error) error.style.display = 'none';
    }, 3000);
    </script>

    <script>
    setTimeout(function() {
        const validation = document.getElementById('validation-errors');
        if (validation) {
            validation.style.transition = 'opacity 0.5s ease';
            validation.style.opacity = '0';
            setTimeout(() => validation.remove(), 500);
        }
    }, 5000);
    </script>

</body>

</html>