<?php
@session_start();
if(@$_SESSION['level'] != "kasir"){

	$isedit 	= @$_GET['isedit'];

	if($isedit == 1){
		$kd  	= @$_GET['kd'];	
		$sql 	= mysql_query("select * from tb_obat where kode_obat = '".$kd."'");
		$data 	= mysql_fetch_array($sql);
	} 
?>

<body>
	<form action="" method="post">
	 <div class="panel panel-default">
	 	<div class="panel-heading"><h3><?php echo ($isedit == 1) ? "Edit" : "Tambah" ;?> Data Obat</h3></div>
		
		<table id="myTable" class="table table-striped table-hover tablesorter" cellspacing="0">
			<tr>
				<td>Nama Obat</td>
				<td>:</td>
				<td><input type="text" required class="form-control" name="nama" value="<?php echo ($isedit == 1) ? $data['nama_obat'] : "" ;?>"/></td>
			</tr>
			<tr>
				<td>Jenis Obat</td>
				<td>:</td>
				<td>
					<select name="jns" id="input" class="form-control" required="required">
						<option value="">Pilih salah satu</option>
						<?php 
							$jenis = array("Kaplet","Cair","Salap");
							$select = "";
							for($i=0;$i<count($jenis);$i++){
								if($isedit==1){
									$select = ($jenis[$i] == $data['jenis']) ? "selected" : "" ;
								}
								echo "<option value='".$jenis[$i]."' ".$select.">".$jenis[$i]."</option>";
								$select = "";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Ukuran</td>
				<td>:</td>
				<td>
					<select name="ukr" class="form-control" required="required">
						<option value="">Pilih salah satu</option>
						<?php 
						$ukr = array("mg","ml");
						$select = "";
						for($i=0;$i<count($ukr);$i++){
							if($isedit==1){
								$select = ($ukr[$i] == $data['ukuran']) ? "selected" : "" ;
							}
							echo "<option value='".$ukr[$i]."' ".$select.">".$ukr[$i]."</option>";
							$select = "";
						}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Harga (Rp.)</td>
				<td>:</td>
				<td><input type="number" required class="form-control" name="hrg" value="<?php echo ($isedit == 1) ? $data['harga'] : "" ;?>"/></td>
			</tr>
			</table>
	</div>

	<p align='right';float='right'>
		<input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
		<button type="reset" class="btn btn-info">Reset</button>
		<button type="reset" class="btn btn-danger" onclick="history.go(-1);">Kembali</button>
	</p>
	</form>
	<br><br><br><br><br><br><br><br><br><br>
</body>

<?php
	
	$nama 	= @$_POST['nama'];
	$jns 	= @$_POST['jns'];
	$hrg 	= @$_POST['hrg'];
	$ukr 	= @$_POST['ukr'];
	$simpan = @$_POST['simpan'];

	if($simpan){
		if($isedit == 1){

			$sql = mysql_query("update tb_obat set ukuran='".$ukr."', nama_obat='".$nama."', jenis='".$jns."', harga='".$hrg."' where kode_obat = '".$kd."'") or die (mysql_error());
		} else {
			$sql 	= mysql_query("select max(cast(kode_obat as int) as max from tb_obat");
			$data 	= mysql_fetch_array($sql);
			$kd 	= ((int)$data['max']) + 1;
			$sql = mysql_query("insert into tb_obat set kode_obat = '".$kd."', ukuran='".$ukr."', nama_obat='".$nama."', jenis='".$jns."', harga='".$hrg."'") or die (mysql_error());
		}
		echo "<meta http-equiv='refresh' content='0; url=?page=obat'>";
		
		if($sql){
			echo "<center><div class='alert alert-success alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<b>Berhasil menambah ke database!!</b>
			</div><center>";
		} else if(isset($sql)){
			echo "
				<center><div class='alert alert-warning alert-dismissable'>
	                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<b>Gagal menambah ke database!!</b>
				</div><center>";
		}
	} 
} else {
	echo " Anda tidak memiliki akses ";
}
?>