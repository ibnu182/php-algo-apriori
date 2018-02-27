<?php
@session_start();
if(@$_SESSION['level'] != "pasien"){
	$tanggal = @$_GET['nmr'];
	$sql = mysql_query("DELETE FROM tb_jadwal where tanggal = '".$tanggal."'");
	if ($sql){
		echo "<script type='text/javascript'>alert('Data berhasil dihapus');</script>";
		echo "<meta http-equiv='refresh' content='0; url=?page=jadwal'>";
	} else {
		echo "<script type='text/javascript'>alert('Data gagal dihapus');</script>";
		echo "<meta http-equiv='refresh' content='0; url=?page=jadwal'>";
	}
} else {
	echo " Anda tidak memiliki akses ";
}
?>