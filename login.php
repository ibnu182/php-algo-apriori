<?php
@session_start();
include "config/koneksi.php";

if(@$_SESSION['level'] != ''){
	header ("location: index.php");
} else {
	$user = @$_POST['user'];
	$pass = @$_POST['pass'];
	$login = @$_POST['login'];
	
	if($login) {
		$sql	= mysql_query("select * from tb_user where username = '".$user."'");
		$cek 	= mysql_num_rows($sql);
		if($cek > 0){
			$sql 	= mysql_query("select * from tb_user where username = '".$user."' and password = '".$pass."'") or die (mysql_error());
			$data 	= mysql_fetch_array($sql);
			$cek 	= mysql_num_rows($sql);
			if($cek >= 1){
				// if($data['level'] == 'Mahasiswa'){
				// 	$s 	= mysql_query("select fakultas from tb_mahasiswa where nim = '".$user."'") or die (mysql_error());
				// 	$d 	= mysql_fetch_array($s);
				// 	@$_SESSION['fakultas'] = $d['fakultas'];
				// } else if($data['level'] == 'Staff'){
				// 	$s 	= mysql_query("select fakultas from tb_staff where kode_staff = '".$user."'") or die (mysql_error());
				// 	$d 	= mysql_fetch_array($s);
				// 	@$_SESSION['fakultas'] = $d['fakultas'];
				// 	echo "<script type='text/javascript'>alert('Fakultas ".$d['fakultas']." ');</script>";
				// }

				@$_SESSION['user'] 		= $data['username'];
				@$_SESSION['password'] 	= $data['password'];
				@$_SESSION['nama'] 		= $data['nama_lengkap'];
				@$_SESSION['level'] 	= $data['level'];

				if ($data['s_aktif'] == '1') {
					header("location: index.php");
				} else {
					echo "<script type='text/javascript'>alert('Username anda tidak aktif. Silahkan hubungi administrator');</script>"; 
				}
			} else {
				echo "<script type='text/javascript'>alert('Password salah. Silahkan cek kembali password anda');</script>"; 
			}		
		} else {
			echo "<script type='text/javascript'>alert('Username tidak ditemukan.');</script>";
		}
	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.min.css">
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<title> Login Aplikasi Inventory Klinik Bahtera </title>
</head>
<body>
	<div class="container">
		<div id="utama">
			<div id="judul">
				Login Aplikasi
			</div>
		
			<div id="inputan">
				<form action="" method="post">
					<div>
						<input type="text" name="user" id="user" class="form-control" placeholder="Username" required="required">
					</div>
					<div style="margin-top: 10px;">
						<input type="password" name="pass" id="pass" class="form-control" placeholder="Password" required="required">
					</div>
					<div style="margin-top: 10px;">
						<p align="right"><input type="submit" name="login" value="Login" class="btn"/></p>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>