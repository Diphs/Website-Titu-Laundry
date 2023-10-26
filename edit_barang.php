<?php

use LDAP\Result;

session_start();
require "session.php";
require('koneksi.php');
// require('update_jasa.php');

$id_jasa = $_GET['id_jasa'];
$ambilData = "SELECT * FROM jasa WHERE id_jasa='$id_jasa'";
$result = mysqli_query($koneksi, $ambilData) or die();
while ($data = mysqli_fetch_array($result)) {
    $id_jasa = isset($data['id_jasa']) ? $data['id_jasa'] : '';
    $nama_produk = isset($data['jenis_jasa']) ? $data['jenis_jasa'] : '';
    $deskripsi_produk = isset($data['deskripsi']) ? $data['deskripsi'] : '';
    $durasi_produk = isset($data['durasi']) ? $data['durasi'] : '';
    $harga_produk = isset($data['harga']) ? $data['harga'] : '';
    $product_image = isset($data['image']) ? $data['image'] : '';
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
            <img src="./img/profile.svg" alt="">
        </div>
        <?php
        $searchbox = "";
        if (isset($_POST['search-box'])) {
            $searchbox = htmlspecialchars($_POST['search-box']);
        }
        ?>

        <div class="form-input">
            <form method="POST" action="update_jasa.php" enctype="multipart/form-data">
                <h5>Edit produk</h5>
                <input type="hidden" class="form-control" name="txt_id_jasa" value="<?php echo $id_jasa; ?>">
                <span>Nama produk</span>
                <input type="text" class="form-control" id="nama_produk" placeholder="Nama produk" name="txt_jenis_jasa" value="<?php echo $nama_produk; ?>">
                <span>Deskripsi produk</span>
                <input type="text" class="form-control" id="deskripsi_produk" placeholder="Deskripsi (max: 200 kata)" name="txt_deskripsi" value="<?php echo $deskripsi_produk; ?>">
                <span>Durasi produk</span>
                <input type="text" class="form-control" id="durasi_produk" placeholder="Durasi (hari)" name="txt_durasi" value="<?php echo $durasi_produk; ?>">
                <span>Harga produk</span>
                <input type="text" class="form-control" id="harga_produk" placeholder="Harga (per kg)" name="txt_harga" value="<?php echo $harga_produk; ?>">
                <span>Photo produk</span>
                <input class="file-input" type="file" id="product_image" name="product_image" value="<?php echo $product_image; ?>">
                <script></script>
                <img src="img/<?php echo $product_image; ?>" alt="" id="imgedit" name="txt_valuehidden" style="height: 300; width: 300; object-fit: cover; border-radius: 5px;">
                <input type="text" hidden class="form-control" id="oldfile" placeholder="Harga (per kg)" name="oldfile" value="<?php echo $product_image; ?>">

                <script>
                    document.getElementById("product_image").onchange = function() {
                        document.getElementById("imgedit").src = URL.createObjectURL(product_image.files[0]);
                    }
                </script>

                <div class="tomboledit">
                    <button type="submit" class="simpan-btn" name="bupdate">Simpan</button>
                    <span class="data-action"> <a href="hapus_produk.php?id_jasa=<?php echo $id_jasa; ?>" onclick="return confirm('Apakah anda yakin mau menghapus item ini?')">
                            <button type="button" class="btnhapus" data-toggle="modal" data-target="#exampleModal">Hapus produk</button>
                        </a></span>
                    <button type="button" class="kembali-btn" data-dismiss="modal" aria-label="Close" onclick="history.back()">
                        <span aria-hidden="true" style="color: #2F80ED;">Kembali</span>
                    </button>
                </div>

            </form>
        </div>

    </section>

    <script type="text/javascript" src="js/bootstrap.bundle.min.js>"></script>
</body>

</html>