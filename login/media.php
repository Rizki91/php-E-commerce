<?php
session_start();
error_reporting(0);
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'><link href='css/reset.css' rel='stylesheet' type='text/css'>


 <center><br><br><br><br><br><br>Maaf, untuk masuk <b>Halaman Administrator</b><br>
  <center>anda harus <b>Login</b> dahulu!<br><br>";
 echo "<div> <a href='index.php'><img src='images/kunci.png'  height=176 width=143></a>
             </div>";
  echo "<input type=button class=simplebtn value='LOGIN DI SINI' onclick=location.href='index.php'></a></center>";
}
else{
?>




<!DOCTYPE html>
<html lang="en">
<head>
 
    <title>Toko</title>


    <link rel="stylesheet" type="text/css" href="css/scrolling-nav.css">
<link rel="stylesheet" type="text/css" href="admin/css/index.css">

<link href="style.css" rel="stylesheet" type="text/css" />
<link href="css/contentslider.css" rel="stylesheet" type="text/css" />
<link href="css/default.advanced.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.ad-gallery.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css" />
<link href="css/slider.css" rel="stylesheet" type="text/css" />


  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link rel="stylesheet" type="text/css" href="bootstrap.min.css">

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

<body class="say">
<div class="container">
	<div class="row">
        <div class="col-md-12">
        
                <nav class="navbar navbar-inverse" >

  <div class="container-fluid">
    <div class="navbar-header ">
      <a class="navbar-brand" href="#"></a>
    </div>
    <div id="navbar" class="navbar-collapse  collapse ">
                		<ul  class="nav navbar-nav"> 
                			<li><a href="?module=home">Home</a></li>
                		</ul>



<ul class="right">
                		<ul class="nav navbar-nav" >
                			<li><a href="logout.php">Logout</a></li>
                		</ul>
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
	
	  <nav class="navbar navbar-inverse">

		  <ul class="nav navbar-nav">
		  	<li>
			 
				  <?php include "menu.php"; ?>
			  
			</li>
			
					<?php include "menu3.php"; ?>
				
			</li>
			</ul>
		</nav>
	
		
		
		
			<!-- CONTENT BOXES -->
			<!-- end of content-box -->
<div >

     <center><?php include "content.php"; ?></td></center> 
 
  
</div>
			<div class="clear">
				<!-- end of content-box -->
			
		</div><!-- end of page -->
		
		<div class="footer clear"></div>
	</div>
	</div>

</div>

</body>


</html>
<?php
}
?>