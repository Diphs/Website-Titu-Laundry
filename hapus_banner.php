<?php
use LDAP\Result;
session_start();
require "session.php";
require ('koneksi.php');

$id_banner = $_GET['id_banner'];

mysqli_query($koneksi,"DELETE FROM `banner` WHERE id_banner=$id_banner");
 
echo "<script>
eval(\"parent.location='adsbanner.php '\");
alert (' Data Berhasil Dihapus!');
</script>";

?>