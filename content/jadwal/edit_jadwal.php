<?php
@session_start();
if(@$_SESSION['level'] != "pasien"){
	$tanggal = @$_GET['nmr'];
	$dokterSql = "SELECT * FROM tb_dokter ORDER BY nm_dokter ASC";
	$dokterQry = mysql_query($dokterSql)  or die ("Query dokter salah : ".mysql_error());
	
	while ($dokter = mysql_fetch_array($dokterQry)) {
		$dok[] = "<option value='$dokter[nm_dokter]'>$dokter[nm_dokter]</option>";
	}

	$jadwalSql = "SELECT * FROM tb_jadwal where tanggal = '".$tanggal."'";
	$jadwalQry = mysql_query($jadwalSql)  or die ("Query dokter salah : ".mysql_error());
	while ($jadwal = mysql_fetch_array($jadwalQry)) {
	
?>
<div class="box">
	<header>
		<h5>Tambah Data Jadwal</h5>
	</header>
	<div class="body">
		<form action="" method="post" class="form-horizontal">
			
			<div class="form-group">
				<label class="control-label col-lg-4">Tanggal</label>
				<div class="col-lg-4">
					<input type="date" name="tgl" id="input" class="form-control" value="<?php echo $jadwal['tanggal'];?>" required="required" title="">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Dokter 1 Poli Umum</label>
				<div class="col-lg-4">
					<select name="dpu1" id="input" class="form-control" required="required">
						<option value="<?php echo $dokter['dokter_pu1'];?>"><?php echo $jadwal['dokter_pu1'];?></option>
						<?php
							for($i=0;$i<count($dok);$i++){
								echo $dok[$i];
							}
						?>
					</select>				
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Dokter 2 Poli Umum</label>
				<div class="col-lg-4">
					<select name="dpu2" id="input" class="form-control" required="required">
						<option value="<?php echo $dokter['dokter_pu2'];?>"><?php echo $jadwal['dokter_pu2'];?></option>
						<?php
							for($i=0;$i<count($dok);$i++){
								echo $dok[$i];
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Dokter 1 Poli Kandungan</label>
				<div class="col-lg-4">
					<select name="dpk1" id="input" class="form-control" required="required">
						<option value="<?php echo $dokter['dokter_pk1'];?>"><?php echo $jadwal['dokter_pk1'];?></option>
						<?php
							for($i=0;$i<count($dok);$i++){
								echo $dok[$i];
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Dokter 2 Poli Kandungan</label>
				<div class="col-lg-4">
					<select name="dpk2" id="input" class="form-control" required="required">
						<option value="<?php echo $dokter['dokter_pk2'];?>"><?php echo $jadwal['dokter_pk2'];?></option>
						<?php
							for($i=0;$i<count($dok);$i++){
								echo $dok[$i];
							}
						?>
					</select>
				</div>
			</div>
			
			<div class="form-actions no-margin-bottom" style="text-align:center;">
				<input type="submit" name="simpan" value="Simpan" class="btn btn-primary" />
				<input type="reset" value="Ulang" class="btn btn-danger" />
			</div>
		</form>
	</div>
</div>

<?php
	}
	$dpu1 	= @$_POST['dpu1'];
	$dpu2 	= @$_POST['dpu2'];
	$dpk1 	= @$_POST['dpk1'];
	$dpk2 	= @$_POST['dpk2'];
	$tgl	= @$_POST['tgl'];
	$simpan = @$_POST['simpan'];

	if($simpan){
		$sql = mysql_query("update tb_jadwal set dokter_pu1='".$dpu1."', dokter_pu2='".$dpu2."', dokter_pk1='".$dpk1."',dokter_pk2='".$dpk2."', tanggal='".$tgl."' where tanggal='".$tgl."'");

		if($sql){
			echo "<meta http-equiv='refresh' content='0; url=?page=jadwal'>";
			echo "<center><div class='alert alert-success alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<b>Berhasil update ke database!!</b>
			</div><center>";
		}
	}else if(isset($simpan)){
		echo "
			<center><div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<b>Gagal update ke database!!</b>
			</div><center>";
	}
} else {
	echo " Anda tidak memiliki akses ";
}
?>
