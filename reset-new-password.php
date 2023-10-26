<?php

use LDAP\Result;

session_start();
require "koneksi.php";
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <section class="reset-password">

        <div class="form-input">
            <form action="" method="post">

                <h1>Buat password baru</h1>
                <p>Email kamu sudah berhasil diverifikasi, sekarang kamu dapat membuat password baru</p>
                <label for="password" class="form-label">Password baru</label>
                <input type="password" name="new_password" class="form-control" id="password" placeholder="Enter your password">

                <label for="password" class="form-label">Ulangi password</label>
                <input type="password" name="konfirmasi_password" class="form-control" id="password" placeholder="Enter your password">

                <button class="confirmBtn" name="confirmBtn">Confirm</button>
            </form>
            <?php
            if (isset($_POST['confirmBtn'])) {
                $new_password = htmlspecialchars($_POST['new_password']);
                $konfirmasi_password = htmlspecialchars($_POST['konfirmasi_password']);
                $emailres = $_SESSION['emailres'];

                if (strlen($new_password) < 6 & strlen($konfirmasi_password) < 6) {
            ?>
                    <div class="paskurang">
                        <i class="uil uil-exclamation-octagon"></i>
                        <span class="text">Password Harus Lebih Dari 6 Karakter</span>
                    </div>

                    <?php
                } else {
                    if ($new_password == $konfirmasi_password) {
                        $query =  mysqli_query($koneksi, "UPDATE `user` SET `password`='$new_password' WHERE email='$emailres'");
                        header("location:login.php");
                    } else {
                    ?>
                        <div class="paskurang">
                            <i class="uil uil-exclamation-octagon"></i>
                            <span class="text">Password tidak sama</span>
                        </div>
            <?php }
                }
            }
            ?>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>