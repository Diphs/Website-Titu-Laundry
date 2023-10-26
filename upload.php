<?php
use LDAP\Result;
session_start();
require "session.php";
  $file_name =  $_FILES['file']['name']; //mendapatkan nama file
  $tmp_name = $_FILES['file']['tmp_name']; //mendapatkan temp_name file
  $file_up_name = time().$file_name; //membuat file menjadi dinamis dengan menambahkan waktu seblum nama file
  move_uploaded_file($tmp_name, "img/".$file_up_name); //memindahkan file ke spesifik folder dengan nama dinamis
?>