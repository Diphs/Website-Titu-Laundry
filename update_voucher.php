<?php
use LDAP\Result;
session_start();
require "session.php";
require ('koneksi.php');
// require ('edit_barang.php');

if (isset($_POST['bupdate'])){
  $id_voucher = $_POST['txt_id_voucher'];
  $nama_voucher = $_POST['txt_nama_voucher'];
  $potongan_harga = $_POST['txt_potongan_harga'];
  $slot_voucher = $_POST['txt_slot_voucher'];
  $tgl_expired = $_POST['txt_tgl_expired'];

  $update = mysqli_query($koneksi, "UPDATE voucher SET nama='$nama_voucher', 
          potongan_harga='$potongan_harga', slot_voucher='$slot_voucher', tgl_expired='$tgl_expired' WHERE id_voucher ='$id_voucher'");
  if($update){
    echo "<script> alert('berhasil diupdate');
    document.location='voucher.php';
    </script>";
    } else{
    echo "<script> alert('gagal');
    document.location='voucher.php';
    </script>";
    }
}
