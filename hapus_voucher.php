<?php
use LDAP\Result;
session_start();
require "session.php";
require ('koneksi.php');

$id_voucher = $_GET['id_voucher'];

mysqli_query($koneksi,"DELETE FROM `voucher` WHERE id_voucher=$id_voucher");
 
echo "<script>
eval(\"parent.location='voucher.php '\");
alert (' Data Berhasil Dihapus!');
</script>";

?>