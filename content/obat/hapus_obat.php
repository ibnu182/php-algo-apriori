<?php
@session_start();
if(@$_SESSION['level'] != "kasir"){
	$kd = @$_GET['kd'];
	$sql = mysql_query("delete from tb_obat where kode_obat = '".$kd."'");
	if ($sql){
		echo "<script type='text/javascript'>alert('Data berhasil dihapus');</script>";
		echo "<meta http-equiv='refresh' content='0; url=?page=obat'>";
	} else {
		echo "<script type='text/javascript'>alert('Data gagal dihapus');</script>";
		echo "<meta http-equiv='refresh' content='0; url=?page=obat'>";
	}
} else {
	echo " Anda tidak memiliki akses ";
}
?>