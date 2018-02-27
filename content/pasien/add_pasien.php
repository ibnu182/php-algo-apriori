<?php
@session_start();
if(@$_SESSION['level'] != "pasien"){
?>
<div class="box">
	<header>
		<h5>Tambah Data Pasien</h5>
	</header>
	<div class="body">
		<form action="" method="post" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-lg-4">Nama Pasien</label>
				<div class="col-lg-4">
					<input type="text" name="nama" autofocus required class="form-control" required="required"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Nomor Telepon</label>
				<div class="col-lg-4">
					<input type="number" name="nomor" class="form-control" required="required"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Alamat</label>
				<div class="col-lg-4">
					<input type="text" required name="alamat" class="form-control" required="required"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Tanggal Lahir</label>
				<div class="col-lg-2">
					<input type="date" class="form-control" placeholder="" name="tgl" required="required"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Jenis Kelamin</label>
				<div class="col-lg-2">
					<select name="jk" class="form-control" required="required">
						<option value="">--Pilih Salah Satu--</option>
						<option value="Pria">Pria</option>
						<option value="Wanita">Wanita</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Status</label>
				<div class="col-lg-2">
					<select name="status" class="form-control" required="required">
						<option value="">--Pilih Salah Satu--</option>
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
						<option value="">--Pilih Salah Satu--</option>
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
					<input type="text" required name="pkj" class="form-control" required="required"/>
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

	$pass_tgl = str_replace('-','',$tgl);

	$tanggal = substr($pass_tgl, 6, 2);
	$bulan = substr($pass_tgl, 4, 2);
	$tahun = substr($pass_tgl, 0, 4);

	$username = substr(strtoupper(str_replace(" ", "", $nama)), 0, 3);
	$username = $username.$tanggal.$bulan;

	$pass_tgl = $tanggal.$bulan.$tahun;


	if($simpan){
		$data 	= mysql_fetch_array(mysql_query("select max(no_pasien) as max from tb_pasien"));
		$kd 	= (int) (($data['max']=="") ? 1 : $data['max'] + 1);

		$sql = mysql_query("insert into tb_pasien set no_pasien='".$kd."' and nm_pasien='".$nama."', j_kel='".$jk."', agama='".$agama."', alamat='".$alamat."', tgl_lhr='".$tgl."', usia='".$usia."', no_tlp='".$telp."', pekerjaan='".$pkj."', status='".$status."'");
		echo "<meta http-equiv='refresh' content='0; url=?page=pasien'>";
		
		if($sql){
			$sql = mysql_query("insert into tb_user set username = '".$username."', password = md5('".$pass_tgl."'), nama = '".$nama."', s_aktif = '1', level='pasien' ") or die (mysql_error());

			if($sql){
				echo "<center><div class='alert alert-success alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<b>Berhasil menambah ke database!!</b>
			</div><center>";
			}  else if(isset($sql)){
			echo "<center><div class='alert alert-warning alert-dismissable'>
	                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<b>Gagal menambah data user ke database!!</b>
				</div><center>";
			}	
		} else if(isset($sql)){
			echo "<center><div class='alert alert-warning alert-dismissable'>
	                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<b>Gagal menambah data pasien ke database!!</b>
				</div><center>";
		}
	}
} else {
	echo " Anda tidak memiliki akses ";
}
?>