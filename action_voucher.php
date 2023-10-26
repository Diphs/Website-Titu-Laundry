<?php
use LDAP\Result;
session_start();
require "session.php";
require "koneksi.php";
$nama_voucher = htmlspecialchars($_POST['nama_voucher']);
$potongan_harga = htmlspecialchars($_POST['potongan_harga']);
$slot_voucher = htmlspecialchars($_POST['slot_voucher']);
$tgl_terbit = date("Y-m-d"); 
$tgl_expired = htmlspecialchars($_POST['tgl_expired']);
$status = htmlspecialchars($_POST['status']);
if (isset($_POST['simpan-btn'])) {
    $simpan = mysqli_query($koneksi, "INSERT INTO `voucher` (`nama`, `potongan_harga`, `slot_voucher`, `tgl_terbit`, `tgl_expired`, `status`) 
    VALUES ('$nama_voucher', '$potongan_harga', '$slot_voucher', '$tgl_terbit', '$tgl_expired', 'Active');");
    if ($simpan) {
        echo "<script> alert('berhasil');
        document.location='voucher.php';
        </script>";
    } else if ($_GET['hal'] == "hapus") {
        $hapus = mysqli_query($koneksi, "DELETE FROM `voucher` WHERE `voucher`.`id_voucher` = '$_GET[id_voucher]'");
    }
    if ($hapus) {
        echo "<script> alert('berhasil');
            document.location='voucher.php';
            </script>";
    } else {
        echo "<script> alert('gagal woiii');
        document.location='voucher.php';
        </script>";
    }
}
