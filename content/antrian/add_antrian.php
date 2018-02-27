<?php
@session_start();
	$pasien	=	@$_GET['nmr'];
	$poli	=	@$_GET['poli'];
	$tanggal = date('Y-m-d');
	$sql = mysql_query("insert into tb_antrian set tanggal='".$tanggal."', s_antri='1', no_pasien='".$pasien."', poli='".$poli."'") or die (mysql_error());
	if ($sql){
		echo "<script type='text/javascript'>alert('Tambah antrian berhasil');</script>";
		echo "<meta http-equiv='refresh' content='0; url=?page=antrian'>";
	} else {
		echo "<script type='text/javascript'>alert('Tambah antrian gagal');</script>";
		echo "<meta http-equiv='refresh' content='0; url=?page=antrian'>";
	}
?>