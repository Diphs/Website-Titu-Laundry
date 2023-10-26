<?php
use LDAP\Result;
session_start();
require "session.php";
require ('koneksi.php');

$id_jasa = $_GET['id_jasa'];

mysqli_query($koneksi,"DELETE FROM `jasa` WHERE id_jasa=$id_jasa");
 
echo "<script>
eval(\"parent.location='product.php '\");
alert (' Data Berhasil Dihapus!');
</script>";

?>