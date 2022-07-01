<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iStalkU</title>
    <link rel="shortcut icon" href="assets/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="wp-plugins/stylesheets/style.css">
    <script src="wp-plugins/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="wp-plugins/sweetalert2/sweetalert2.min.css" />
</head>

<body>
    <div class="container">
        <header class="container-header">
            <img src="assets/logo.jpg" alt="logo">
            <h3>iStalkU</h3>
            <small>Get unknown message from your friends, fans and etc.</small>
        </header>
        <form action="/auth_user" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="name">Enter your full name</label>
                <input type="text" name="name" />
                <span class="error"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
            </div>
            <div class="form-group">
                <button type="submit">Create i-Stalk-U link</button>
            </div>
        </form>
    </div>
    <?php
    if (!empty(session()->getFlashdata('error'))) : ?>
        <script>
            Swal.fire({
                icon: "error",
                title: "error",
                text: "<?= session()->getFlashdata('error') ?>",
                showConfirmButton: false,
                timer: 1500,
            });
        </script>
    <?php endif ?>
    <?php
    if (!empty(session()->getFlashdata('success'))) : ?>
        <script>
            Swal.fire({
                icon: "success",
                title: "success",
                text: "<?= session()->getFlashdata('success') ?>",
                showConfirmButton: false,
                timer: 1500,
            });
        </script>
    <?php endif ?>
</body>

</html>