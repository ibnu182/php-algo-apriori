<?php
@session_start();
if(@$_SESSION['level'] != "pasien"){
	$kd  = @$_GET['nmr'];
	$sql = mysql_query("select * from tb_user where username = '".$kd."'");
	$data = mysql_fetch_array($sql);

?>

<div class="box">
	<header>
		<h5>Edit Data User</h5>
	</header>
	<div class="body">
		<form action="" method="post" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-lg-4">Username</label>
				<div class="col-lg-4">
				<input type="text" required class="form-control" name="user" value="<?php echo $data['username'];?>" disabled="disabled"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Password</label>
				<div class="col-lg-4">
				<input type="password" class="form-control" name="password" placeholder="Kosongkan, jika password tidak ingin dirubah"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Nama</label>
				<div class="col-lg-4">
				<input type="text" required class="form-control" name="nama" value="<?php echo $data['nama'];?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Status</label>
				<div class="col-lg-4">
					<select name="s_aktif" id="input" class="form-control" required="required">
						<option value="<?php echo $data['s_aktif'];?>"><?php echo ($data['s_aktif'] == 1 ? "Aktif" : "Tidak Aktif");?></option>
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
	$s_aktif = @$_POST['s_aktif'];
	$simpan = @$_POST['simpan'];

	if($simpan){
		if($pass != ""){
			$sql = mysql_query("update tb_user set nama='".$nama."', s_aktif='".$s_aktif."', password='".md5($pass)."' where username = '".$kd."'");
		} else {
			$sql = mysql_query("update tb_user set nama='".$nama."', s_aktif='".$s_aktif."' where username = '".$kd."'");
		}
		
		if($sql){
			echo "<meta http-equiv='refresh' content='0; url=?page=user'>";
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