<?php
include "root.php";

$nama 		= $_POST['nama'];
$email 		= $_POST['email'];
$user 		= $_POST['username'];
$pass 		= $_POST['password'];
$password	= sha1($pass);

$query = "INSERT INTO customer (nama, email, username, password) VALUES ('$nama','$email','$user','$password')";

if (mysqli_query($koneksi, $query)) {
	echo "<script language='JavaScript'>
	alert('Data berhasil ditambahkan')
	document.location = 'login.php'
	</script>";
}else{
	echo "Error: ".$query."<br/>".mysqli_error($koneksi);
}