<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iStalkU</title>
    <link rel="shortcut icon" href="assets/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="wp-plugins/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="wp-plugins/stylesheets/dashboard.css">
    <script src="wp-plugins/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="wp-plugins/sweetalert2/sweetalert2.min.css" />
</head>

<body id="body">
    <div id="root">
        <div id="container" class="light-container">
            <div class="container-card">
                <h3>iStalkU</h3>
                <div class="color-theme" id="theme">
                    <i id="ic_light" class="light-mode fa fa-sun"></i>
                    <i id="ic_dark" class="dark-mode fa fa-moon"></i>
                </div>
            </div>
            <div class="container-header">
                <div class="container-left">
                    <div class="iStalkU-details">
                        <span class="iStalkU-link">Share Link :
                            <input class="share-input" onclick="copylink()"  type="text" name="link" value="http://localhost:3000/dashboard" readonly>
                            <a class="share-link" id="copy" href="#" onclick="copylink()"><i class="fas fa-clipboard"></i></a>
                            <a class="share-link" href="https://www.facebook.com/sharer.php?u=http://localhost:8080/message/<?= $user_data['token'] ?>"><i class="fab fa-facebook"></i></a>
                        </span>
                        <span class="code-name">Name : <a href="/logout"><?= ucfirst($user_data['name']) ?></a></span>
                        <span class="iStalkU-id">User Id : <?= $user_data['token'] ?></span>
                    </div>
                </div>
                <div class="container-right">
                    <h2>Dashboard</h2>
                    <span class="date-created"><?= $user_data['date'] ?></span>
                </div>
            </div>

            <?php
            if (!$record) {
            ?>
                <div class="container-body">
                    <div class="container-message">
                        <p>
                            <center>No message record found.</center>
                        </p>
                    </div>
                </div>
                <?php
            } else {
                foreach ($record as $row) {
                ?>
                    <div class="container-body">
                        <div class="container-message">
                            <div class="text-message">
                                <p>
                                    <?= $row->message ?>
                                </p>
                            </div>
                            <div class="message-tools">
                                <span class="text-date-time"><?= $row->created ?></span>
                                <div class="tools">
                                    <a data-id="<?= $row->id ?>" class="btn-delete" href="#"><i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <div class="container-footer">
            <p>
                Copy Right &copy; 2022-2023 Alright Reserved | Developed By :
                <a href="#">Noel Mallari</a>
            </p>
        </div>
    </div>

    <?php
    if (!empty(session()->getFlashdata('success'))) : ?>
        <script>
            Swal.fire({
                icon: "success",
                title: "success!",
                text: "<?= session()->getFlashdata('success') ?>",
                showConfirmButton: false,
                timer: 1500,
            });
        </script>
    <?php endif ?>

    <script>
        const theme = document.getElementById("theme");
        const container = document.getElementById("container");
        const ic_light = document.getElementById("ic_light");
        const ic_dark = document.getElementById("ic_dark");
        const root = document.getElementById("root");
        const copy = document.getElementById("copy");
        const footer = document.querySelector(".container-footer");

        let isDark = false;

        theme.addEventListener("click", function() {
            if (isDark == false) {
                container.setAttribute("class", "dark-container");
                ic_light.style.display = "none";
                ic_dark.style.display = "block";
                isDark = true;
                footer.style.color = "#fff";
                root.style.backgroundColor = "var(--dark-primary-color)";
            } else {
                container.setAttribute("class", "light-container");
                ic_light.style.display = "block";
                ic_dark.style.display = "none";
                footer.style.color = "#000";
                root.style.backgroundColor = "var(--light-primary-color)";
                isDark = false;
            }
        });

        if (
            /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                navigator.userAgent
            )
        ) {
            alert("Android Browser");

            function copylink() {
                let copyText =
                    "http://localhost:8080/message/<?= $user_data['token'] ?>";
                var TempText = document.createElement("input");
                TempText.value = copyText;
                document.body.appendChild(TempText);
                TempText.select();
                document.execCommand("copy");
                document.body.removeChild(TempText);
                Swal.fire({
                    icon: "success",
                    title: "success",
                    text: "Successfully copied",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        } else {
            function copylink() {
                let copyText =
                    "http://localhost:8080/message/<?= $user_data['token'] ?>";
                navigator.clipboard.writeText(copyText);
                Swal.fire({
                    icon: "success",
                    title: "success",
                    text: "Successfully copied",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        }
    </script>
    <script src="wp-plugins/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on("click", ".btn-delete", function() {
                let message_id = $(this).data("id");
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: "success",
                            title: "success",
                            text: "Successfully copied",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        setTimeout(function() {
                            location.href = "dashboard/" + message_id;
                        }, 1500)
                    }
                });
            })
        })
    </script>
</body>

</html>