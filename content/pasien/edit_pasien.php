<?php
@session_start();
if(@$_SESSION['level'] != "pasien"){
	$nmr = @$_GET['nmr'];
	$sql = mysql_query("select * from tb_pasien where no_pasien = '".$nmr."'");
	$data = mysql_fetch_array($sql);
?>

<div class="box">
	<header>
		<h5>Edit Data Pasien</h5>
	</header>
	<div class="body">
		<form action="" method="post" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-lg-4">Nama Pasien</label>
				<div class="col-lg-4">
					<input type="text" name="nama" autofocus required class="form-control" required="required" value="<?php echo $data['nm_pasien'];?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Nomor Telepon</label>
				<div class="col-lg-4">
					<input type="number" name="nomor" class="form-control" required="required" value="<?php echo $data['no_tlp'];?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Alamat</label>
				<div class="col-lg-4">
					<input type="text" required name="alamat" class="form-control" required="required" value="<?php echo $data['alamat'];?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Tanggal Lahir</label>
				<div class="col-lg-2">
					<input type="date" class="form-control" placeholder="" name="tgl" required="required" value="<?php echo $data['tgl_lhr'];?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Jenis Kelamin</label>
				<div class="col-lg-2">
					<select name="jk" class="form-control" required="required">
						<option value="<?php echo $data['j_kel'];?>"><?php echo $data['j_kel'];?></option>
						<option value="Pria">Pria</option>
						<option value="Wanita">Wanita</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Status</label>
				<div class="col-lg-2">
					<select name="status" class="form-control" required="required">
						<option value="<?php echo $data['status'];?>"><?php echo $data['status'];?></option>
						<option value="Lajang">Lajang</option>
						<option value="Menikah">Menikah</option>
						<option value="Duda">Duda</option>
						<option value="Janda">Janda</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Agama</label>
				<div class="col-lg-2">
					<select name="agama" class="form-control" required="required">
						<option value="<?php echo $data['agama'];?>"><?php echo $data['agama'];?></option>
						<option value="Islam">Islam</option>
						<option value="Kristen">Kristen</option>
						<option value="Hindu">Hindu</option>
						<option value="Budha">Budha</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Pekerjaan</label>
				<div class="col-lg-4">
					<input type="text" required name="pkj" class="form-control" required="required" value="<?php echo $data['pekerjaan'];?>"/>
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
	
	$nama = @$_POST['nama'];
	$telp = @$_POST['nomor'];
	$alamat = @$_POST['alamat'];
	$tgl = @$_POST['tgl'];
	$jk = @$_POST['jk'];
	$status = @$_POST['status'];
	$agama = @$_POST['agama'];
	$pkj = @$_POST['pkj'];
	$simpan = @$_POST['simpan'];

	$biday = new DateTime($tgl);
	$today = new DateTime();

	$diff = $today->diff($biday);

	$usia = $diff->y;

	if($simpan){
			// include_once("../library/koneksi.php");
			$sql = mysql_query("update tb_pasien set nm_pasien='".$nama."', j_kel='".$jk."', agama='".$agama."', usia = '".$usia."', alamat='".$alamat."', tgl_lhr='".$tgl."', no_tlp='".$telp."', pekerjaan='".$pkj."', status='".$status."' where no_pasien = $nmr");
			echo "<meta http-equiv='refresh' content='0; url=?page=pasien'>";
			
			if($sql){
				echo "<center><div class='alert alert-success alert-dismissable'>
	                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<b>Berhasil menambah ke database!!</b>
				</div><center>";
			}
	}else if(isset($simpan)){
		echo "<center><div class='alert alert-warning alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<b>Gagal menambah ke database!!</b>
			</div><center>";
	}
} else {
	echo " Anda tidak memiliki akses ";
}
?>