<link href="style.css" rel="stylesheet" type="text/css" />
<link href="css/contentslider.css" rel="stylesheet" type="text/css" />
<link href="css/default.advanced.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.ad-gallery.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/slider.css" rel="stylesheet" type="text/css" />

<?php

session_start();
error_reporting(0);
include "config/koneksi.php";
include "config/library.php";
include "root1.php";

$module=$_GET[module];
$act=$_GET[act];

if ($module=='keranjang' AND $act=='tambah'){
if (isset($_SESSION['username_cust'])) {
	$sid = session_id();

	$sql2 = mysql_query("SELECT stok FROM produk WHERE id_produk='$_GET[id]'");
	$r=mysql_fetch_array($sql2);
	$stok=$r[stok];
  }else{
 	 echo  "<br><br><br><br><br><br><br><br><br><center><h3>Silahkan Login Untuk Membeli Barang<h3></center>";
							?>
								<center><button><a class="btn btn-success" href="login.php">Login</a></button><br></center>

							<?php
						}
  if ($stok == 0){
     
  }
  else{
	// check if the product is already
	// in cart table for this session
	$sql = mysql_query("SELECT id_produk FROM orders_temp
			WHERE id_produk='$_GET[id]' AND id_session='$sid'");
	$ketemu=mysql_num_rows($sql);
	if ($ketemu==0){
		// put the product in cart table
		mysql_query("INSERT INTO orders_temp (id_produk, jumlah, id_session, tgl_order_temp, jam_order_temp, stok_temp)
				VALUES ('$_GET[id]', 1, '$sid', '$tgl_sekarang', '$jam_sekarang', '$stok')");
	} else {
		// update product quantity in cart table
		mysql_query("UPDATE orders_temp 
		        SET jumlah = jumlah + 1
				WHERE id_session ='$sid' AND id_produk='$_GET[id]'");		
	}
		
	deleteAbandonedCart();
	header('Location:keranjang-belanja.php');
  }				
}


elseif ($module=='keranjang' AND $act=='hapus'){
	mysql_query("DELETE FROM orders_temp WHERE id_orders_temp='$_GET[id]'");
	header('Location:keranjang-belanja.php');				
}

elseif ($module=='keranjang' AND $act=='update'){
  $id       = $_POST[id];
  $jml_data = count($id);
  $jumlah   = $_POST[jml]; // quantity
  for ($i=1; $i <= $jml_data; $i++){
	$sql2 = mysql_query("SELECT stok_temp FROM orders_temp	WHERE id_orders_temp='".$id[$i]."'");
	while($r=mysql_fetch_array($sql2)){
if ($jumlah[$i] > $r[stok_temp]){
echo "<script>window.alert('Jumlah yang dibeli melebihi stok yang ada');
window.location=('keranjang-belanja.php')</script>";
}
elseif($jumlah[$i] == 0){
echo "<script>window.alert('Anda tidak boleh menginputkan angka 0 atau mengkosongkannya!');
window.location=('keranjang-belanja.php')</script>";
} // tambahan update ada disini
else{
mysql_query("UPDATE orders_temp SET jumlah = '".$jumlah[$i]."'
WHERE id_orders_temp = '".$id[$i]."'");
header('Location:keranjang-belanja.php');
    }
  }
  }
}



/*
	Delete all cart entries older than one day
*/
function deleteAbandonedCart(){
	$kemarin = date('Y-m-d', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
	mysql_query("DELETE FROM orders_temp 
	        WHERE tgl_order_temp < '$kemarin'");
}
?>
