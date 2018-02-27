<?php
@session_start();
if(@$_SESSION['level'] != "pasien"){
	$kd = @$_GET['nmr'];
	$sql = mysql_query("delete from tb_pasien where no_pasien = '".$kd."'");
	if ($sql){
		echo "<script type='text/javascript'>alert('Data berhasil dihapus');</script>";
		echo "<meta http-equiv='refresh' content='0; url=?page=pasien'>";
	} else {
		echo "<script type='text/javascript'>alert('Data gagal dihapus');</script>";
		echo "<meta http-equiv='refresh' content='0; url=?page=pasien'>";
	}
} else {
	echo " Anda tidak memiliki akses ";
}
?>