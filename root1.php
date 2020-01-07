<?php
Class bigdata
{
	
	function __construct()
	{
		mysql_connect("localhost","root","");
		mysql_select_db("db_jual");
	}
	function login($username,$password){
		$query=mysql_query("select * from customer where username='$username' and password='$password'");
		$check=mysql_num_rows($query);
		if ($check > 0) {
			$data=mysql_fetch_array($query);
			session_start();
			$_SESSION['id_cust']=$data['id'];
			$_SESSION['nama_cust']=$data['nama'];
			$_SESSION['username_cust']=$data['username'];



			header("location:index.php");
		}
		else{
			?>
			<script type="text/javascript">
				alert("Login gagal, username atau password salah");
				window.location.href="login.php";
			</script>
			<?php
		}
	}
	function daftar($nama,$alamat,$username,$password){
		$query=mysql_query("select * from customer where username='$username'");
		$check=mysql_num_rows($query);
		if ($check == 0) {
			$q=mysql_query("insert into customer set nama='$nama',alamat='$alamat',username='$username',password='$password'");
					if ($q) {
						?>
						<script type="text/javascript">
							alert("Pendaftaran berhasil, silahkan login");
						window.location.href="login.php";
						</script>
						<?php
					}else{
						echo "galat";
					}
		}else{
					?>
					<script type="text/javascript">
						alert("Username sudah digunakan, silahkan gunakan yang lainnya");
						window.location.href="daftar.php";
					</script>
					<?php
		}
	}

		

}

$data=new bigdata();
	?>