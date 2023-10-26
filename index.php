<?php
session_start();
require "session.php";
require "koneksi.php";
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title> Admin Dashboard Panel </title>
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
                <li><a href="index.php" style=" background-color: rgba(47, 128, 237, 0.16); border-radius: 8px;">
                        <i class="uil uil-estate" style="color: #2F80ED;"></i>
                        <span class="link-name" style="color: #2F80ED; font-weight: 500;">Dashboard</span>
                    </a></li>
                <li><a href="product.php">
                        <i class="uil uil-box"></i>
                        <span class="link-name">Product</span>
                    </a></li>
                <li><a href="voucher.php">
                        <i class="uil uil-pricetag-alt"></i>
                        <span class="link-name">Voucher</span> </a></li>
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
        </div> <?php
                $searchbox = "";
                $tgl = date("Y-m-d");
                if (isset($_POST['search-box'])) {
                    $searchbox = htmlspecialchars($_POST['search-box']);
                }  ?>
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-arrow-circle-up"></i>
                    <span class="text">Dashboard</span>
                </div> <?php
                        $query = mysqli_query($koneksi, "SELECT COUNT(id_user) FROM user");
                        $row = mysqli_fetch_array($query);
                        $jmlpengguna = $row['COUNT(id_user)'];

                        $query1 = mysqli_query($koneksi, "SELECT COUNT(id_pesanan) FROM pesanan WHERE MONTH(tanggal) = MONTH(CURRENT_DATE())");
                        $row1 = mysqli_fetch_array($query1);
                        $jmlpesanan = $row1['COUNT(id_pesanan)'];


                        $query3 = mysqli_query($koneksi, "SELECT SUM(total_harga) FROM pesanan WHERE status_pesanan='Pesanan selesai' AND MONTH(tanggal) = MONTH(CURRENT_DATE())");
                        $row1 = mysqli_fetch_array($query3);
                        $jmlharga = $row1['SUM(total_harga)'];
                        if ($jmlharga != "") {
                            $jmlharga = $row1['SUM(total_harga)'];
                        } else {
                            $jmlharga = "0";
                        }

                        $query2 = mysqli_query($koneksi, "SELECT COUNT(status_pesanan) FROM pesanan WHERE status_pesanan='Sedang diproses'");
                        $row2 = mysqli_fetch_array($query2);
                        $jmlstatus = $row2['COUNT(status_pesanan)'];
                        ?>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-user"></i>
                        <span class="text">Pengguna</span>
                        <span class="number"><?php echo $jmlpengguna ?></span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-shopping-bag"></i>
                        <span class="text">Pesanan</span>
                        <span class="number"><?php echo $jmlpesanan ?></span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-money-bill"></i>
                        <span class="text">Pendapatan</span>
                        <span class="number">Rp. <?php echo $jmlharga ?></span>
                    </div>
                    <div class="box box4">
                        <i class="uil uil-shopping-cart"></i>
                        <span class="text">Pesanan berjalan</span>
                        <span class="number"><?php echo $jmlstatus ?></span>
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <i class="uil uil-shopping-cart"></i>
                    <span class="text">Pesanan terbaru</span>
                </div>
                <div class="activity-data">
                    <div class="data order-id">
                        <span class="data-title">Order ID</span>
                        <?php
                        $sql = "SELECT id_pesanan, tanggal, user.nama, jasa.jenis_jasa, total_berat, total_harga, status_pesanan FROM `pesanan`  JOIN user ON pesanan.id_user = user.id_user JOIN jasa ON pesanan.id_jasa = jasa.id_jasa WHERE (id_pesanan LIKE '%$searchbox%' OR nama LIKE '%$searchbox%') AND tanggal = '$tgl'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($siswa = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-list">#<?php echo $siswa['id_pesanan'] ?></span>
                        <?php  }
                        ?>
                    </div>
                    <div class="data date">
                        <span class="data-title">Tanggal</span>
                        <?php
                        $sql = "SELECT id_pesanan, tanggal, user.nama, jasa.jenis_jasa, total_berat, total_harga, status_pesanan FROM `pesanan`  JOIN user ON pesanan.id_user = user.id_user JOIN jasa ON pesanan.id_jasa = jasa.id_jasa WHERE (id_pesanan LIKE '%$searchbox%' OR nama LIKE '%$searchbox%') AND tanggal = '$tgl'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($siswa = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-list"><?php echo $siswa['tanggal'] ?></span>
                        <?php  }
                        ?>
                    </div>
                    <div class="data name">
                        <span class="data-title">Nama</span>
                        <?php
                        $sql = "SELECT id_pesanan, tanggal, user.nama, jasa.jenis_jasa, total_berat, total_harga, status_pesanan FROM `pesanan`  JOIN user ON pesanan.id_user = user.id_user JOIN jasa ON pesanan.id_jasa = jasa.id_jasa WHERE (id_pesanan LIKE '%$searchbox%' OR nama LIKE '%$searchbox%') AND tanggal = '$tgl'";
                        $query = mysqli_query($koneksi, $sql);
                        while ($siswa = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-list"><?php echo $siswa['nama'] ?></span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="data order">
                        <span class="data-title">Pesanan</span>
                        <?php
                        $sql = "SELECT id_pesanan, tanggal, user.nama, jasa.jenis_jasa, total_berat, total_harga, status_pesanan FROM `pesanan`  JOIN user ON pesanan.id_user = user.id_user JOIN jasa ON pesanan.id_jasa = jasa.id_jasa WHERE (id_pesanan LIKE '%$searchbox%' OR nama LIKE '%$searchbox%') AND tanggal = '$tgl'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($siswa = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-list"><?php echo $siswa['jenis_jasa'] ?></span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="data weight">
                        <span class="data-title">Berat</span>
                        <?php
                        $sql = "SELECT id_pesanan, tanggal, user.nama, jasa.jenis_jasa, total_berat, total_harga, status_pesanan FROM `pesanan`  JOIN user ON pesanan.id_user = user.id_user JOIN jasa ON pesanan.id_jasa = jasa.id_jasa WHERE (id_pesanan LIKE '%$searchbox%' OR nama LIKE '%$searchbox%') AND tanggal = '$tgl'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($siswa = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-list"><?php echo $siswa['total_berat'] ?> KG</span>
                        <?php  }  ?>
                    </div>
                    <div class="data price">
                        <span class="data-title">Harga</span>
                        <?php
                        $sql = "SELECT id_pesanan, tanggal, user.nama, jasa.jenis_jasa, total_berat, total_harga, status_pesanan FROM `pesanan`  JOIN user ON pesanan.id_user = user.id_user JOIN jasa ON pesanan.id_jasa = jasa.id_jasa WHERE (id_pesanan LIKE '%$searchbox%' OR nama LIKE '%$searchbox%') AND tanggal = '$tgl'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($siswa = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-list"><?php echo $siswa['total_harga'] ?></span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="data status">
                        <span class="data-title">Status</span>
                        <?php
                        $sql = "SELECT id_pesanan, tanggal, user.nama, jasa.jenis_jasa, total_berat, total_harga, status_pesanan FROM `pesanan`  JOIN user ON pesanan.id_user = user.id_user JOIN jasa ON pesanan.id_jasa = jasa.id_jasa WHERE (id_pesanan LIKE '%$searchbox%' OR nama LIKE '%$searchbox%') AND tanggal = '$tgl'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($siswa = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-list"><?php echo $siswa['status_pesanan'] ?></span>
                        <?php }  ?>
                    </div>
                </div>
            </div>
    </section>
    <script src="script.js"></script>
</body>

</html>