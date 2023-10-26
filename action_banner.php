<?php
use LDAP\Result;
session_start();
require "session.php";
require "koneksi.php";
$nama_banner = htmlspecialchars($_POST['nama_banner']);
$keterangan = htmlspecialchars($_POST['keterangan']);
$banner_image = $_FILES['banner_image']['name'];
$ganti = $_FILES['banner_image']['tmp_name'];
if (isset($_POST['simpan-btn'])) {
    $simpan = mysqli_query($koneksi, "INSERT INTO `banner` (`nama`, `keterangan`, `image`) VALUES ('$nama_banner', '$keterangan', '$banner_image');");
    move_uploaded_file($ganti, 'banner/' . $banner_image);
    if ($simpan) {
        echo "<script> alert('berhasil');
        document.location='adsbanner.php';
        </script>";
    } else if ($_GET['hal'] == "hapus") {
        $hapus = mysqli_query($koneksi, "DELETE FROM `banner` WHERE `banner`.`id_banner` = '$_GET[id_banner]'");
    }
    if ($hapus) {
        echo "<script> alert('berhasil');
            document.location='adsbanner.php';
            </script>";
    } else {
        echo "<script> alert('gagal woiii');
        document.location='adsbanner.php';
        </script>";
    }
}
