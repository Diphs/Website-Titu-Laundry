<?php

use LDAP\Result;

session_start();
require "session.php";
require "koneksi.php";
// require('update_jasa.php');

$id_banner = $_GET['id_banner'];
$ambilData = "SELECT * FROM banner WHERE id_banner='$id_banner'";
$result = mysqli_query($koneksi, $ambilData) or die();
while ($data = mysqli_fetch_array($result)) {
    $id_banner = isset($data['id_banner']) ? $data['id_banner'] : '';
    $nama_banner = isset($data['nama']) ? $data['nama'] : '';
    $keterangan = isset($data['keterangan']) ? $data['keterangan'] : '';
    $banner_image = isset($data['image']) ? $data['image'] : '';
}
?>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/addproduct.css">
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
            <img src="./img/profile.svg" alt="">
        </div>
        <?php
        $searchbox = "";
        if (isset($_POST['search-box'])) {
            $searchbox = htmlspecialchars($_POST['search-box']);
        }
        ?>

        <div class="form-input">
            <form method="POST" action="update_banner.php" enctype="multipart/form-data">
                <h5>Edit iklan banner</h5>

                <input type="hidden" class="form-control" name="txt_id_banner" value="<?php echo $id_banner; ?>">
                <span>Nama banner</span>
                <input type="text" class="form-control" id="nama_banner" placeholder="Nama produk" name="txt_nama_banner" value="<?php echo $nama_banner; ?>">
                <span>Keterangan</span>
                <input rows="5" cols="200" id="keterangan" placeholder="Deskripsi (max: 200 kata)" name="txt_keterangan" value="<?php echo $keterangan; ?>">
                <span>Gambar banner</span>
                <input class="file-input" type="file" id="banner_image" name="banner_image" value="<?php echo $banner_image; ?>">
                <img src="banner/<?php echo $banner_image; ?>" alt="" id="imgedit" style=" min-height: 200px; width: 100%; object-fit: cover; border-radius: 5px;">
                <input type="text" hidden class="form-control" id="oldfile" name="oldfile" value="<?php echo $banner_image; ?>">

                <script>
                    document.getElementById("banner_image").onchange = function() {
                        document.getElementById("imgedit").src = URL.createObjectURL(banner_image.files[0]);

                    }
                </script>

                <div class="tomboledit">
                    <button type="submit" class="simpan-btn" name="bupdate">Simpan</button>
                    <span class="data-action"> <a href="hapus_banner.php?id_banner=<?php echo $id_banner; ?>" onclick="return confirm('Apakah anda yakin mau menghapus banner ini?')">
                            <button type="button" class="btnhapus" data-toggle="modal" data-target="#exampleModal">Hapus produk</button>
                        </a></span>
                    <button type="button" class="kembali-btn" name="backbtn" data-dismiss="modal" aria-label="Close" onclick="history.back()">
                        <span aria-hidden="true" style="color: #2F80ED;">Kembali</span>
                    </button>
                </div>

            </form>
        </div>

    </section>

    <script type="text/javascript" src="js/bootstrap.bundle.min.js>"></script>
</body>

</html>