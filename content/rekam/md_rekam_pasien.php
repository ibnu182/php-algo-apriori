<div class="box">
	<header>
		<h5>Rekam Medis <?php echo @$_SESSION['nama'];?></h5>
	</header>
	<div class="body">
		<table class="table table-hover">
<?php
	$query_pasien 	= "select * from tb_pasien a, tb_user b where a.nm_pasien=b.nama and username ='".@$_SESSION['username']."'";
	$query_rekam 	= "select a.*, b.nm_dokter from tb_rekam a, tb_dokter b, tb_pasien c where a.no_pasien=c.no_pasien and a.kd_dokter = b.kd_dokter and c.nm_pasien='".@$_SESSION['nama']."' order by a.tgl_pemeriksaan asc";
	// $query_rekam 	= "select a.*, b.nm_dokter from tb_rekam a, tb_dokter b where a.kd_dokter = b.kd_dokter order by a.tgl_pemeriksaan asc";
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
					<td align='center'><a href="?page=rekam&action=resep&no=<?php echo $data['no_pasien'];?>&tgl=<?php echo date('Y-m-d');?>"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-zoom-in"></span></button></a></td>
				</tr>	
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
</form>
