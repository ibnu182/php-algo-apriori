<?php
	@session_start();
	if(@$_SESSION['level'] != 'pasien'){
		$no 	=	@$_GET['nmr'];
		$sql	=	mysql_query("update tb_antrian set s_antri = '1' where no_antrian='".$no."'");

		if ($sql){
			echo "<script type='text/javascript'>alert('Data berhasil diupdate');</script>";
			echo "<meta http-equiv='refresh' content='0; url=?page=antrian'>";
		} else {
			echo "<script type='text/javascript'>alert('Data gagal diupdate');</script>";
			echo "<meta http-equiv='refresh' content='0; url=?page=antrian'>";
		}
	} else {
		echo "Anda tidak memiliki akses";
	}
?>