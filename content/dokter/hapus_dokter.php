<?php
@session_start();
if(@$_SESSION['level'] != "pasien"){
	$kd = @$_GET['nmr'];
	$sql = mysql_query("delete from tb_dokter where kd_dokter = '".$kd."'");
	if ($sql){
		$sql = mysql_query("delete from tb_user where username = '".@$_SESSION['username']."'");
		if ($sql){
			echo "<script type='text/javascript'>alert('Data berhasil dihapus');</script>";
			echo "<meta http-equiv='refresh' content='0; url=?page=dokter'>";
		}
	} else {
		echo "<script type='text/javascript'>alert('Data gagal dihapus');</script>";
		echo "<meta http-equiv='refresh' content='0; url=?page=dokter'>";
	}
} else {
	echo " Anda tidak memiliki akses ";
}
?>