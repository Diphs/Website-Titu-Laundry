<?php
session_start();
require "koneksi.php";
$_SESSION['logged_in'] = false;
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
    <section class="login d-flex">
        <div class="login-left w-50 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-8">
                    <div class="header">
                        <h1>Halo, Selamat datang kembali!</h1>
                        <p>Masuk untuk menggunakan layanan kami</p>
                    </div>
                    <div class="login-form">
                        <form action="" method="post">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="emaillog" class="form-control" id="email" placeholder="yourname@gmail.com">

                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="passwordlog" class="form-control" id="password" placeholder="Enter your password">
                            <a href="./reset.php" class="text-decoration-none">Lupa password?</a>

                            <button class="signin" name="signin">Sign In</button>
                            </from>
                            <?php
                            if (isset($_POST['signin'])) {
                                $emaillog = htmlspecialchars($_POST['emaillog']);
                                $passwordlog = htmlspecialchars($_POST['passwordlog']);

                                $query =  mysqli_query($koneksi, "SELECT * FROM user WHERE email='$emaillog' and password='$passwordlog'");
                                $count = mysqli_num_rows($query);

                                if ($count > 0) {
                                    $_SESSION['username'] = $username;
                                    $_SESSION['logged_in'] = true;

                                    header("location:index.php");
                                } else {
                            ?>
                                    <div class="passalah">
                                    <i class="uil uil-exclamation-octagon"></i>
                                    <span class="text">Email atau password salah!</span>
                                    </div>
                                    
                            <?php
                                }
                            }
                            ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="login-right w-50 h-100">
            <img src="img/image-right.jpg" class="img-fluid h-100 w-100" alt="Responsive image">
        </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>