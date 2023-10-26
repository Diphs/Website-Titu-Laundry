<?php
session_start();
require "session.php";
@include 'koneksi.php';

?>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" href="style.css">
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
                <li><a href="product.php" style=" background-color: rgba(47, 128, 237, 0.16); border-radius: 8px;">
                        <i class="uil uil-box" style="color: #2F80ED;"></i>
                        <span class="link-name" style="color: #2F80ED; font-weight: 500;">Product</span>
                    </a></li>
                <li><a href="voucher.php">
                        <i class="uil uil-pricetag-alt"></i>
                        <span class="link-name">Voucher</span>
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
                    <i class="uil uil-box"></i>
                    <span class="text">Semua produk</span>

                    <a href="addproduct.php">
                        <button href="addproduct.php" type="button" class="btntambah" data-toggle="modal" data-target="#exampleModal">+ Tambah produk</button>
                    </a>
                </div>

                <!-- <div method="POST" action="tolaction.php" enctype="multipart/form-data" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah produk baru</h5>
                            </div>

                            <input type="text" class="form-control" id="nama_produk" placeholder="Nama produk" name="nama_produk">
                            <input type="text" class="form-control" id="deskripsi_produk" placeholder="Deskripsi (max: 200 kata)" name="deskripsi_produk">
                            <input type="text" class="form-control" id="durasi_produk" placeholder="Durasi (hari)" name="durasi_produk">
                            <input type="text" class="form-control" id="harga_produk" placeholder="Harga (per kg)" name="harga_produk">
                            <input type="file" name="product_image" class="form-control" id="exampleFormControlInput1" required="">
                            <button type="submit" class="btn btn-success mb-3" name="simpan-btn">Simpan</button>

                            <div class="wrapper">
                                <form action="#">
                                    <input class="file-input" type="file" name="file" hidden>
                                    <i class="uil uil-image-plus"></i>
                                    <p>Tambahkan foto produk</p>
                                </form>
                                <section class="progress-area"></section>
                                <section class="uploaded-area"></section>
                            </div>

                            <button class="simpan-btn" name="simpan-btn">Simpan</button>
                            <button class="kembali-btn" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">Kembali</span>
                            </button>

                        </div>
                    </div>
                </div> -->

                <div class="activity-data">

                    <div class="data order-id">
                        <span class="data-title">Gambar</span>
                        <?php
                        $sql = "SELECT image FROM `jasa` WHERE jenis_jasa LIKE '%$searchbox%'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($siswa = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-thumb"><img src="img/<?php echo $siswa['image'] ?>" style="height: 56; width: 56; object-fit: cover; border-radius: 5px;"></span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="data date">
                        <span class="data-title">Nama</span>
                        <?php
                        $sql = "SELECT jenis_jasa FROM `jasa` WHERE jenis_jasa LIKE '%$searchbox%'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($siswa = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-list"><?php echo $siswa['jenis_jasa'] ?></span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="data desc">
                        <span class="data-title">Deskripsi</span>
                        <?php
                        $sql = "SELECT deskripsi FROM `jasa` WHERE jenis_jasa LIKE '%$searchbox%'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($siswa = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-list"><?php echo $siswa['deskripsi'] ?></span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="data order">
                        <span class="data-title">Durasi</span>
                        <?php
                        $sql = "SELECT durasi FROM `jasa` WHERE jenis_jasa LIKE '%$searchbox%'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($siswa = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-list"><?php echo $siswa['durasi'] ?></span>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="data price">
                        <span class="data-title">Harga</span>
                        <?php
                        $sql = "SELECT harga FROM `jasa` WHERE jenis_jasa LIKE '%$searchbox%'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($siswa = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-list"><?php echo $siswa['harga'] ?></span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="data status">
                        <span class="data-title">Action</span>
                        <?php
                        $sql = "SELECT id_jasa FROM `jasa` WHERE jenis_jasa LIKE '%$searchbox%'";
                        $query = mysqli_query($koneksi, $sql);

                        while ($siswa = mysqli_fetch_array($query)) {
                        ?>
                            <span class="data-action"> <a href="edit_barang.php?id_jasa=<?php echo $siswa['id_jasa']; ?>">
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