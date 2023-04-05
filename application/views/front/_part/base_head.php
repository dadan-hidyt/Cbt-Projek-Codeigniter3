<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/cbt_front/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/cbt_front/css/cbt.css') ?>">
    <!-- SCRIPTS -->
    <script src="<?= base_url('assets/cbt_front/app.bundle.js') ?>"></script>
    <script src="<?= base_url('assets/cbt_front/js/ping.min.js') ?>"></script>
    <title><?= ($title ?? false) ? $title . " | Cbt" : "CBT"; ?></title>

    <script>
        const base_url = '<?= base_url(); ?>';
        window.base_url = base_url;
    </script>
</head>
<?php if ($bodyClass ?? false) : ?>

    <body class="<?= $bodyClass ?>">
    <?php else : ?>

        <body>
        <?php endif; ?>