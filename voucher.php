<?php

use LDAP\Result;

session_start();
require "session.php";
@include 'koneksi.php';

?>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" href="css/voucher.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="./img/vmware.svg" alt="">
            </div>

            <span class="logo_name">Titu Laundry</span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="index.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li><a href="product.php">
                        <i class="uil uil-box"></i>
                        <span class="link-name">Product</span>
                    </a></li>
                <li><a href="voucher.php" style=" background-color: rgba(47, 128, 237, 0.16); border-radius: 8px;">
                        <i class="uil uil-pricetag-alt" style="color: #2F80ED;"></i>
                        <span class="link-name" style="color: #2F80ED; font-weight: 500;">Voucher</span>
                    </a></li>
                <li><a href="adsbanner.php">
                        <i class="uil uil-layer-group"></i>
                        <span class="link-name">Ads banner</span>
                    </a></li>
                <li><a href="order.php">
                        <i class="uil uil-shopping-cart"></i>
                        <span class="link-name">Order</span>
                    </a></li>
                <li><a href="performance.php">
                        <i class="uil uil-tachometer-fast-alt"></i>
                        <span class="link-name">Performance</span>
                    </a></li>
            </ul>

            <ul class="logout-mode">
                <li><a href="login.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a>
                </li>
                <li class="mode" style="display: none;">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark mode</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <form action="" method="post">
                    <input type="text" name="search-box" placeholder="Cari disini..">
                    </from>
            </div>
            <img src="./img/profile.svg" alt="">
        </div>
        <?php
        $searchbox = "";
        if (isset($_POST['search-box'])) {
            $searchbox = htmlspecialchars($_POST['search-box']);
        }
        ?>


        <div class="dash-content">

            <div class="activity">
                <div class="title">
                    <i class="uil uil-layer-group"></i>
                    <span class="text">Semua voucher</span>

                    <a href="addvoucher.php">
                        <button href="addvoucher.php" type="button" class="btntambah" data-toggle="modal" data-target="#exampleModal">Buat voucher baru</button>
                    </a>
                </div>

                <div class="activity-data">

                    <div class="data date">
                        <span class="data-title">Nama</span>
                        <?php
                        $sql = "SELECT nama FROM `voucher` WHERE nama LIKE '%$searchbox%'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($sqlvoucher = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-list"><?php echo $sqlvoucher['nama'] ?></span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="data desc">
                        <span class="data-title">Potongan harga</span>
                        <?php
                        $sql = "SELECT potongan_harga FROM `voucher` WHERE nama LIKE '%$searchbox%'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($sqlvoucher = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-list"><?php echo $sqlvoucher['potongan_harga'] ?></span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="data date">
                        <span class="data-title">Slot voucher</span>
                        <?php
                        $sql = "SELECT slot_voucher FROM `voucher` WHERE nama LIKE '%$searchbox%'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($sqlvoucher = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-list"><?php echo $sqlvoucher['slot_voucher'] ?></span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="data desc">
                        <span class="data-title">Tanggal terbit</span>
                        <?php
                        $sql = "SELECT 	tgl_terbit FROM `voucher` WHERE nama LIKE '%$searchbox%'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($sqlvoucher = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-list"><?php echo $sqlvoucher['tgl_terbit'] ?></span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="data desc">
                        <span class="data-title">Tanggal expired</span>
                        <?php
                        $sql = "SELECT 	tgl_expired FROM `voucher` WHERE nama LIKE '%$searchbox%'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($sqlvoucher = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-list"><?php echo $sqlvoucher['tgl_expired'] ?></span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="data date">
                        <span class="data-title">Status</span>
                        <?php
                        $sql = "SELECT status FROM `voucher` WHERE nama LIKE '%$searchbox%'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($sqlvoucher = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-list"><?php echo $sqlvoucher['status'] ?></span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="data status">
                        <span class="data-title">Action</span>
                        <?php
                        $sql = "SELECT id_voucher  FROM `voucher` WHERE nama LIKE '%$searchbox%'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($sqlvoucher = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-action"> <a href="edit_voucher.php?id_voucher=<?php echo $sqlvoucher['id_voucher']; ?>">
                                    <button type="button" class="btntambah" data-toggle="modal" data-target="#exampleModal">Manage</button>
                                </a> </span>

                        <?php
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
    <!-- <script src="product.js"></script> -->
</body>

</html>