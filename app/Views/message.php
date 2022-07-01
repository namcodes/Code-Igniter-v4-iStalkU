<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iStalkU | Message</title>
    <script src="wp-plugins/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="wp-plugins/sweetalert2/sweetalert2.min.css" />
    <link rel="shortcut icon" href="assets/logo.jpg" type="image/x-icon">
    <style>
        * {
            margin: 0;
            padding: 0; 
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background-color: #131722;
            min-height: 100vh;
            display: grid;
            place-content: center;
        }

        .form-group textarea {
            resize: none;
            font-size: 18px;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            outline: none;
            background-color: transparent;
            border: 2px solid #d3d3d3;
            color: #fff;
            margin-bottom: 10px;
        }

        .form-group textarea::placeholder {
            color: #c2c2c2;
        }

        .form-group textarea:focus {
            border-color: #6c59e0;
        }

        .container {
            width: 440px;
            background-color: #151b2c;
            padding: 15px;
            border-radius: 5px;
            color: #9eadbf;
        }

        .container header {
            margin-bottom: 10px;
            padding: 10px 0;
            border-bottom: 1px solid #D3D3D3;
        }

        .container header h1 {
            text-align: center;
            padding: 5px 0;
            color: #7c6aef;
        }

        .container form button {
            background-color: #6c59e0;
            color: #fff;
            width: 100%;
            padding: 10px 0;
            border-radius: 5px;
            border: none;
            font-size: 18px;
            cursor: pointer;
            outline: none;
        }

        .container form button:hover {
            background-color: #6a5cc5;
        }

        @media screen and (max-width: 700px) {
            .container {
                width: 100%;
                background-color: transparent;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>iStalkU</h1>
            <span class="note">
                Message your friend anonymously, they will never know who sent the
                message.
            </span>
        </header>

        <form action="/auth_message" method="post">
            <?= csrf_field() ?>
            <input type="text" name="user_token" value="<?= $user_token ?>" hidden>
            <div class="form-group">
                <textarea name="message" placeholder="Write your secret message here." cols="40" rows="10" required></textarea>
            </div>
            <button>Send iStalkU message!</button>
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