<?php
    $id_pesanan = $_GET['id_pesanan'];
    @include 'koneksi.php';

    $query = mysqli_query($koneksi, "UPDATE `pesanan` SET status_pesanan='Menunggu pembayaran' WHERE id_pesanan='$id_pesanan'");
    header("location:order.php");
    ?>