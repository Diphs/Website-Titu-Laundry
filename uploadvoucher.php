<?php
use LDAP\Result;
session_start();
require "session.php";
require "koneksi.php";
require "voucher.php";
$product_image = $_FILES['product_image']['name'];
$ganti = $_FILES['product_image']['tmp_name'];
$nama_produk = htmlspecialchars($_POST['nama_produk']);
$deskripsi_produk = htmlspecialchars($_POST['deskripsi_produk']);
$durasi_produk = htmlspecialchars($_POST['durasi_produk']);
$harga_produk = htmlspecialchars($_POST['harga_produk']);

if (isset($_POST['simpan-btn'])) {
    $simpan = mysqli_query($koneksi, "INSERT INTO `jasa` (`jenis_jasa`, `deskripsi`, `durasi`, `harga`, `image`) VALUES ('$nama_produk', '$deskripsi_produk', '$durasi_produk', '$harga_produk', '$product_image');");
    move_uploaded_file($ganti, 'img/' . $product_image);
    if ($simpan) {
        echo "<script> alert('berhasil');
        document.location='voucher.php';
        </script>";
    } else if ($_GET['hal'] == "hapus") {
        $hapus = mysqli_query($koneksi, "DELETE FROM `jasa` WHERE `jasa`.`id_jasa` = '$_GET[id_jasa]'");
    }
    if ($hapus) {
        echo "<script> alert('berhasil');
            document.location='data_barang.php';
            </script>";
    } else {
        echo "<script> alert('gagal');
        document.location='data_barang.php';
        </script>";
    }
}
