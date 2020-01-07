<?php
session_start();
include "../../../config/koneksi.php";


$cek=$_POST[cek];
$jumlah=count($cek);
    
  for($i=0;$i<$jumlah;$i++){
  mysql_query("SELECT FROM customer WHERE id='$cek[$i]'");
  }
  header('location:../../media.php?module=customer');
?>