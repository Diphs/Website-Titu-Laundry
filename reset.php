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

    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>

    <section class="reset-password">
        <div class="form-input">
            <form action="" method="post">
                <h1>Reset password</h1>
                <p>Masukkan emailmu dan kami akan mengirim intruksi untuk mereset password</p>

                <input type="text" class="form-control" id="emailres" placeholder="Masukkan email kamu" name="emailres">
                <div class="tombol">
                    <button type="submit" class="resetBtn" name="resetBtn">Continue</button>
                </div>
                </from>
                <?php
                if (isset($_POST['resetBtn'])) {
                    $emailres = htmlspecialchars($_POST['emailres']);
                    $query = mysqli_query($koneksi, "SELECT email from user WHERE email='$emailres'");
                    $count = mysqli_num_rows($query);

                    if ($count > 0) {
                        $_SESSION['emailres'] = $emailres;

                        header("location:verfikaasi-kode.php");
                    } else {
                ?>
                        <div class="paskurang">
                            <i class="uil uil-exclamation-octagon"></i>
                            <span class="text">Email tidak terdaftar</span>
                        </div>

                <?php
                    }
                }
                ?>
        </div>
    </section>
</body>

</html>