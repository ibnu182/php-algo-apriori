<?php
@session_start();
if(@$_SESSION['level'] != "pasien"){
?>
<div class="box">
	<header>
		<h5>Tambah Data Dokter</h5>
	</header>
	<div class="body">
		<form action="" method="post" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-lg-4">No. Surat Izin Praktek</label>
				<div class="col-lg-4">
					<input type="text" name="no_sip" autofocus  class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Nama Dokter</label>
				<div class="col-lg-4">
					<input type="text" name="nama" autofocus required class="form-control" required="required"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">No. Telepon</label>
				<div class="col-lg-4">
					<input type="number" name="nomor" class="form-control" required="required"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Tempat Lahir</label>
				<div class="col-lg-4">
					<input type="text" name="tmpt_lhr" autofocus  class="form-control"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Tanggal Lahir</label>
				<div class="col-lg-2">
					<input type="date" class="form-control" placeholder="" name="tgl"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Alamat</label>
				<div class="col-lg-4">
					<input type="text"  name="alamat" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">No. STR</label>
				<div class="col-lg-4">
					<input type="text" name="no_str" autofocus  class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">No. Rekomendasi OP</label>
				<div class="col-lg-4">
					<input type="text" name="no_rek_op" autofocus  class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Poli</label>
				<div class="col-lg-4">
					<select name="poli" id="input" class="form-control" required="required">
						<option value=""></option>
						<option value="Umum">Umum</option>
						<option value="Kandungan">Kandungan</option>
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
	
	$no_sip 	= @$_POST['no_sip'];
	$nama 		= @$_POST['nama'];
	$telp 		= @$_POST['nomor'];
	$tgl 		= @$_POST['tgl'];
	$tmpt 		= @$_POST['tmpt_lhr'];
	$alamat 	= @$_POST['alamat'];
	$no_str		= @$_POST['no_str'];
	$no_rek_op 	= @$_POST['no_rek_op'];
	$poli 		= @$_POST['poli'];
	$simpan 	= @$_POST['simpan'];

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
			// include_once("../library/koneksi.php");
			$sql = mysql_query("insert into tb_dokter set nm_dokter='".$nama."', no_sip='".$no_sip."', no_tlp='".$telp."', tgl_lahir='".$tgl."', tmpt_lahir='".$tmpt."', alamat='".$alamat."', no_str='".$no_str."', no_rek_op='".$no_rek_op."', poli = '".$poli."'");
			echo "<meta http-equiv='refresh' content='0; url=?page=dokter'>";
			
			if($sql){
				$sql = mysql_query("insert into tb_user set username = '".$username."', password = md5('".$pass_tgl."'), nama = '".$nama."', s_aktif = '1', level='dokter' ") or die (mysql_error());

				if($sql){
					echo "<center><div class='alert alert-success alert-dismissable'>
		                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<b>Berhasil menambah ke database!!</b>
					</div><center>";
				}
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