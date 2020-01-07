<?php 
include "root1.php";
if (isset($_GET["act"])) {
	if ($_GET["act"]=="login") {
		$data->login($_POST['username'],$_POST['password']);
	}
	if ($_GET["act"]=="daftar") {
		$data->daftar($_POST['nama'],$_POST['alamat'],$_POST['username'],$_POST['password']);
	}
	if ($_GET["act"]=="logout") {
		session_start();
		unset($_SESSION['id_cust'],$_SESSION['nama_cust'],$_SESSION['username_cust']);
		header("location:index.php");
}
}
?>