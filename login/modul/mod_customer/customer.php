<?php
session_start();
include "../../../config/koneksi.php";
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

switch($_GET[act]){
  // Tampil Produk
  default:

    echo "
          <table>
          <tr><th>No</th><th>Nama customer</th><th>Alamat(kg)</th><th>Username</th><th>Password</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM customer ORDER BY id DESC LIMIT $posisi,$batas");
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
     
      echo "<tr><td>$no</td>
                <td>$r[nama]</td>
                <td align=center>$r[alamat]</td>
                <td>$harga</td>
        <td align=center>$r[username]</td>
                <td align=center>$r[password]</td>
                </tr>";
      $no++;
    }
    echo "</table>";

    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM customer"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
 
    break;

  }
}
?>