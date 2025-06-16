<?php if (!empty($errors)): ?>
    <?php
        $errorCount = count($errors);
        $alertClass = ($errorCount === 1) ? 'validation-single-error' : 'validation-multi-error';
    ?>
    <div class="alert alert-danger <?= $alertClass ?>" role="alert">
        <?php if ($errorCount === 1): ?>
            <?php // Jika hanya ada 1 error, tampilkan tanpa UL/LI ?>
            <?php foreach ($errors as $error): ?>
                <p class="mb-0"><?= esc($error) ?></p>
            <?php endforeach ?>
        <?php else: ?>
            <?php // Jika lebih dari 1 error, tampilkan dengan UL/LI ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </div>
<?php endif ?>