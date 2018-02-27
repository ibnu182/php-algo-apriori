<?php
@session_start();
if(@$_SESSION['level'] != "pasien"){
	$nmr = @$_GET['nmr'];
	$sql = mysql_query("select * from tb_dokter where kd_dokter = '".$nmr."'");
	$data = mysql_fetch_array($sql);
?>

<div class="box">
	<header>
		<h5>Edit Data Dokter</h5>
	</header>
	<div class="body">
		<form action="" method="post" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-lg-4">No. Surat Izin Praktek</label>
				<div class="col-lg-4">
					<input type="text" name="no_sip" autofocus class="form-control" value="<?php echo $data['no_sip'] ;?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Nama Dokter</label>
				<div class="col-lg-4">
					<input type="text" name="nama" autofocus class="form-control" required="required" value="<?php echo $data['nm_dokter'] ;?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">No. Telepon</label>
				<div class="col-lg-4">
					<input type="number" name="nomor" class="form-control" required="required" value="<?php echo $data['no_tlp'] ;?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Tempat Lahir</label>
				<div class="col-lg-4">
					<input type="text" name="tmpt_lhr" autofocus class="form-control" value="<?php echo $data['tmpt_lahir'] ;?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Tanggal Lahir</label>
				<div class="col-lg-2">
					<input type="date" class="form-control" placeholder="" name="tgl" required="required" value="<?php echo $data['tgl_lahir'] ;?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Alamat</label>
				<div class="col-lg-4">
					<input type="text" name="alamat" class="form-control" value="<?php echo $data['alamat'] ;?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">No. STR</label>
				<div class="col-lg-4">
					<input type="text" name="no_str" autofocus class="form-control" value="<?php echo $data['no_str'] ;?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">No. Rekomendasi OP</label>
				<div class="col-lg-4">
					<input type="text" name="no_rek_op" autofocus class="form-control" value="<?php echo $data['no_rek_op'] ;?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Poli</label>
				<div class="col-lg-4">
					<select name="poli" id="input" class="form-control" required="required">
						<option value="<?php echo $data['poli'];?>"><?php echo $data['poli'];?></option>
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
	
	$no_sip = @$_POST['no_sip'];
	$nama = @$_POST['nama'];
	$telp = @$_POST['nomor'];
	$tgl = @$_POST['tgl'];
	$tmpt = @$_POST['tmpt_lhr'];
	$alamat = @$_POST['alamat'];
	$no_str = @$_POST['no_str'];
	$no_rek_op = @$_POST['no_rek_op'];
	$poli = @$_POST['poli'];
	$simpan = @$_POST['simpan'];

	if($simpan){
			// include_once("../library/koneksi.php");
			$sql = mysql_query("update tb_dokter set nm_dokter='".$nama."', no_sip='".$no_sip."', no_tlp='".$telp."', tgl_lahir='".$tgl."', tmpt_lahir='".$tmpt."', alamat='".$alamat."', no_str='".$no_str."', no_rek_op='".$no_rek_op."', poli = '".$poli."' where kd_dokter = $nmr");
			echo "<meta http-equiv='refresh' content='0; url=?page=dokter'>";
			
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