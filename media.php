<?php 
 error_reporting(0);
  session_start();  
  include "config/koneksi.php";
  include "config/fungsi_indotgl.php";
  include "config/class_paging.php";
  include "config/fungsi_combobox.php";
  include "config/library.php";
  include "config/fungsi_autolink.php";
  include "config/fungsi_rupiah.php";
  include "hapus_orderfiktif.php";

 
?>



<!DOCTYPE html>
<html lang="en">
<head>
 
    <title>Toko</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/scrolling-nav.css">
<link rel="stylesheet" type="text/css" href="admin/css/index.css">

<link href="style.css" rel="stylesheet" type="text/css" />
<link href="css/contentslider.css" rel="stylesheet" type="text/css" />
<link href="css/default.advanced.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.ad-gallery.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css" />
<link href="css/slider.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="config/jquery.js"></script>


  <link rel="stylesheet" type="text/css" href="css/index.css">


  

    <style type="text/css">
        .jumbotron {
           background-color: #008080;
            border-color: #009090;
            
        }

        .navbar-inverse{ 
            background-color: #008080;
            border-color: #009090;


        }
    .panel-tite{
        background-color: #008080;
            border-color: #009090;
    }

.caret.caret-up {
    border-top-width: 0;
    border-bottom: 4px solid #fff;

  }
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  .footer{
  background-color: #008080;
  text-align: center;
}


    </style>
</head>
<body class="">
<div class="container">
  <nav >
    <ul class="left">
      <li><a href="index.php">Home</a></li>
    </ul>
    <ul class="right">
    <?php
    session_start();
    if (isset($_SESSION['username_cust'])) {
      ?>
      <li><a href="keranjang-belanja.php">Lihat Keranjang</a></li>
      <li><a href="selesai-belanja.php">Selesai Belanja</a></li>
      <li><a href="hand.php?act=logout"><?= $_SESSION['nama_cust'] ?> (Logout)</a></li>
    
      <?php
    }else{ ?>
      <li><a href="login.php">Login</a></li>
      <li><a href="daftar.php">Daftar</a></li>
      <?php } ?>
    </ul>
    <div class="both"></div>
  </nav>
<header>
  <?php
$tanggal= mktime(date("m"),date("d"),date("Y"));
echo "Tanggal : <b>".date("d-M-Y", $tanggal)."</b> ";
date_default_timezone_set('Asia/Jakarta');
$jam=date("H:i:s");
echo "| Pukul : <b>". $jam." "."</b>";
$hari = date ("H");
if (($hari>=6) && ($hari<=11)){
echo "<b>, Selamat Pagi !!</b>";
}
else if(($hari>11) && ($hari<=15))
{
echo ", Selamat Pagi !!";}
else if (($hari>15) && ($hari<=18)){
echo ", Selamat Siang !!";}
else { echo ", <b> Selamat Malam </b>";}
?>
  </header>
  <nav class="navbar navbar-inverse" >
  <div id="navbar" class="navbar-collapse  collapse ">
    <ul class="nav navbar-nav">
     <?php
            $kategori=mysql_query("select nama_kategori, kategori.id_kategori, kategori_seo,  
                                  count(produk.id_produk) as jml 
                                  from kategori left join produk 
                                  on produk.id_kategori=kategori.id_kategori 
                                  group by nama_kategori");
            $no=1;
            while($k=mysql_fetch_array($kategori)){
              if(($no % 2)==0){
                echo "<li><a href='kategori-$k[id_kategori]-$k[kategori_seo].php'> $k[nama_kategori] ($k[jml])</a></li>";
              }
              else{
                echo "<li><a href='kategori-$k[id_kategori]-$k[kategori_seo].php'> $k[nama_kategori] ($k[jml])</a></li>";              
              }
              $no++;
            }
            ?>
            
    </ul>


</div>
</nav>
 <div>
   
 </div>
        
   <div class="clear"></div>

   <div id="content_sec">
      <div class="col1">
        
            <table width="100%" border="0" cellspacing="10" cellpadding="0">
              
              <tr>
                <td><?php include "tengah.php";?></td>
              </tr>
            </table>
           
      </div>
       <div class="clear"></div>
        <div class="copyright_network ">
          <p ><center>Copyright ©2019 by: Fahrul Rizki </center></p>
    
        </div>
        
  </div>



</body>
</html>













