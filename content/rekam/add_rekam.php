<div class="box">
	<header>
		<h5>Rekam Medis Pasien</h5>
	</header>
	<div class="body">
		<table class="table table-hover">
<?php
	$no 	= @$_GET['nmr'];
	$query_pasien 	= "select * from tb_pasien where no_pasien ='".$no."'";
	$query_dokter	= @$_SESSION['level'] != 'dokter' ? "select * from tb_dokter" : "select * from tb_dokter where nm_dokter = '".@$_SESSION['nama']."'";
	$query_rekam 	= "select a.*, b.nm_dokter from tb_rekam a, tb_dokter b where a.kd_dokter = b.kd_dokter and a.no_pasien='".$no."' order by a.tgl_pemeriksaan asc";
	$cek_rekam		= "select a.*, b.nm_dokter from tb_rekam a, tb_dokter b where a.kd_dokter = b.kd_dokter and a.tgl_pemeriksaan='".date('Y-m-d')."' and a.no_pasien = '".$no."'";
	$sql 	= mysql_query($query_pasien);
	while($data = mysql_fetch_assoc($sql)){
?>
			<tr>
				<td width="200px"> Nama Lengkap </td>
				<td width="25px"> : </td>
				<td width="600px"> <?php echo $data['nm_pasien'];?> </td>
				<td width="200px"> Telp/Hp </td>
				<td width="25px"> : </td>
				<td> <?php echo $data['no_tlp'];?> </td>
			</tr>
			<tr> 
				<td> Usia </td>
				<td width="25px"> : </td>
				<td> <?php echo $data['usia'];?> </td>
				<td width="200px"> Sex </td>
				<td width="25px"> : </td>
				<td> <?php echo $data['j_kel'];?> </td>
			</tr>
			<tr> 
				<td> Agama </td>
				<td width="25px"> : </td>
				<td> <?php echo $data['agama'];?> </td>
				<td width="200px"> Status </td>
				<td width="25px"> : </td>
				<td> <?php echo $data['status'];?> </td>
			</tr>
			<tr> 
				<td> Pekerjaan </td>
				<td width="25px"> : </td>
				<td colspan="6"> <?php echo $data['pekerjaan'];?> </td>
			</tr>
			<tr> 
				<td> Alamat </td>
				<td width="25px"> : </td>
				<td colspan="6"> <?php echo $data['alamat'];?> </td>
			</tr>
<?php
	}
?>
		</table>
	</div>
</div>
<form method="POST" role="form">
	<div class="table-responsive">
		<table class="table table-hover table-border table-striped">
			<thead>
				<tr>
					<td align="center" width="150px"><strong>TANGGAL</strong></td>
					<td align="center"><strong>ANAMESIS/PEMERIKSAAN</strong></td>
					<td align="center"><strong>DIAGNOSA</strong></td>
					<td align="center"><strong>TERAPI</strong></td>
					<td align="center"><strong>DOKTER</strong></td>
					<td align="center"><strong>OBAT</strong></td>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql 	= mysql_query($query_rekam);
				while($data = mysql_fetch_array($sql)){
				?>
				<tr>
					<td align='center'><?php echo date('d-m-Y', strtotime($data['tgl_pemeriksaan']));?></td>
					<td align='center'><?php echo $data['pemeriksaan'];?></td>
					<td align='center'><?php echo $data['diagnosa'];?></td>
					<td align='center'><?php echo $data['terapi'];?></td>
					<td align='center'><?php echo $data['nm_dokter'];?></td>
					<td align='center'><a href="?page=rekam&action=resep&no=<?php echo $no;?>&tgl=<?php echo $data['tgl_pemeriksaan'];?>&rekam=1"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-zoom-in"></span></button></a></td>
				</tr>	
				<?php
				}

				$sql 	= mysql_query($cek_rekam);
				$cek 	= mysql_num_rows($sql);
				$btn 	= "";
				if ($cek==0){
					$btn = "<input type='submit' name='submit' value'Simpan' class='btn btn-primary'>";
				?>
				<tr>
					<td align='center'><?php echo date('d-m-Y');?></td>
					<td align='center'><input type='text' name='amnesis' class='form-control' required='required' title='Pemeriksaan'></td>
					<td align='center'><input type='text' name='diagnosa' class='form-control' required='required' title='Diagnosa'></td>
					<td align='center'><input type='text' name='terapi' class='form-control' required='required' title='Terapi'></td>
					<td align='center'>
						<div class='form-group'>
							<div class='col-sm-12'>
								<select name='dokter' id='input' class='form-control'>
									<option value=''>-- Select One --</option>
									<?php
										$sql 	= mysql_query($query_dokter);
										while($data = mysql_fetch_array($sql)){
									?>
									<option value='<?php echo $data['kd_dokter'];?>'>
										<?php echo $data['nm_dokter'];?>
									</option>
									<?php
										}
									?>
								</select>
							</div>
						</div>
					</td>
					<td align='center'><a href="?page=rekam&action=resep&no=<?php echo $no;?>&tgl=<?php echo date('Y-m-d');?>&rekam=0"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-zoom-in"></span></button></a></td>
				</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
	<center><?php echo $btn;?></center>
</form>

<?php
	
	$amnesis 	= @$_POST['amnesis'];
	$diagnosa 	= @$_POST['diagnosa'];
	$terapi 	= @$_POST['terapi'];
	$dokter 	= @$_POST['dokter'];
	$submit 	= @$_POST['submit'];

	if($submit){
		$query 	= "insert into tb_rekam set no_pasien = '".$no."', pemeriksaan = '".$amnesis."', diagnosa = '".$diagnosa."', terapi = '".$terapi."', tgl_pemeriksaan = '".date('Y-m-d')."', username = '".@$_SESSION['user']."', kd_dokter = '".$dokter."'";
		// echo $query;
		$sql 	= mysql_query($query);

		if($sql){
			echo "<center><div class='alert alert-success alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<b>Berhasil menambah ke database!!</b>
			</div><center>";
			echo "<script type='text/javascript'> window.location.href = window.location.href;</script>";
		} else if(isset($sql)){
			echo "<center><div class='alert alert-warning alert-dismissable'>
	                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<b>Gagal menambah ke database!!</b>
				</div><center>";
		}
	}

?>