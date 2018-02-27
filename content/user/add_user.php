<?php
@session_start();
if(@$_SESSION['level'] != "pasien"){
?>
<div class="box">
	<header>
		<h5>Tambah Data User</h5>
	</header>
	<div class="body">
		<form action="" method="post" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-lg-4">Username</label>
				<div class="col-lg-4">
				<input type="text" required class="form-control" name="user"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Password</label>
				<div class="col-lg-4">
				<input type="password" required class="form-control" name="password"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Nama</label>
				<div class="col-lg-4">
				<input type="text" required class="form-control" name="nama"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Status</label>
				<div class="col-lg-4">
					<select name="s_aktif" id="input" class="form-control" required="required">
						<option value=""></option>
						<option value="1">Aktif</option>
						<option value="0">Tidak Aktif</option>
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
	$user = @$_POST['user'];
	$nama = @$_POST['nama'];
	$pass = @$_POST['password'];
	$simpan = @$_POST['simpan'];

	if($simpan){
		$sql = mysql_query("insert into tb_user set username='".$user."', password='".($pass)."', nama='".$nama."', level='admin', s_aktif='1'");
		echo "<meta http-equiv='refresh' content='0; url=?page=user'>";
		
		if($sql){
			echo "<center><div class='alert alert-success alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<b>Berhasil menambah ke database!!</b>
			</div><center>";
		}
	}else if(isset($simpan)){
		echo "
			<center><div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<b>Gagal menambah ke database!!</b>
			</div><center>";
	}
} else {
	echo " Anda tidak memiliki akses ";
}
?>