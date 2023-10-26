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
    <link rel="stylesheet" href="css/banner.css">
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
                <li><a href="voucher.php">
                        <i class="uil uil-pricetag-alt"></i>
                        <span class="link-name">Voucher</span>
                    </a></li>
                <li><a href="adsbanner.php" style=" background-color: rgba(47, 128, 237, 0.16); border-radius: 8px;">
                        <i class="uil uil-layer-group" style="color: #2F80ED;"></i>
                        <span class="link-name" style="color: #2F80ED; font-weight: 500;">Ads banner</span>
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
                <li><a href="login.php" onclick="return confirm('Apakah anda yakin ingin keluar?')">
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
                    <span class="text">Semua banner</span>

                    <a href="addbanner.php">
                        <button href="addproduct.php" type="button" class="btntambah" data-toggle="modal" data-target="#exampleModal">+ Tambah banner</button>
                    </a>
                </div>

                <div class="activity-data">

                    <div class="data order-id">
                        <span class="data-title">Banner</span>
                        <?php
                        $sql = "SELECT image FROM `banner` WHERE nama LIKE '%$searchbox%'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($sqlbanner = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-thumb"><img src="banner/<?php echo $sqlbanner['image'] ?>" style="height: 56; width: 100; object-fit: cover; border-radius: 5px;"></span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="data date">
                        <span class="data-title">Nama</span>
                        <?php
                        $sql = "SELECT nama FROM `banner` WHERE nama LIKE '%$searchbox%'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($sqlbanner = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-list"><?php echo $sqlbanner['nama'] ?></span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="data desc">
                        <span class="data-title">Deskripsi</span>
                        <?php
                        $sql = "SELECT keterangan FROM `banner` WHERE nama LIKE '%$searchbox%'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($sqlbanner = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-list"><?php echo $sqlbanner['keterangan'] ?></span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="data status">
                        <span class="data-title">Action</span>
                        <?php
                        $sql = "SELECT id_banner FROM `banner` WHERE nama LIKE '%$searchbox%'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($sqlbanner = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-action"> <a href="edit_banner.php?id_banner=<?php echo $sqlbanner['id_banner']; ?>">
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