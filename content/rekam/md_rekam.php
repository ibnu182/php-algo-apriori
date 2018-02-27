<?php
@session_start();
if(@$_SESSION['level'] != "pasien"){

?>
	<div class="panel panel-default">
		<div class="panel-heading">
			Rekam Medis
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table id="table_id" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Nomor Pasien</th>
							<th>Nama Pasien</th>
							<th>Jenis Kelamin</th>
							<th>Alamat</th>
							<th>Nomor Telepone</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
				<?php
					if(@$_SESSION['level'] == 'admin'){
						$pasienSql = "SELECT * FROM tb_pasien ORDER BY no_pasien ASC";
					} else {

						$query = mysql_query("select * from tb_dokter where nm_dokter = '".@$_SESSION['nama']."'") or die (mysql_error());
						$data = mysql_fetch_array($query) or die (mysql_error());
						$tanggal = date('Y-m-d');
						$pasienSql = "SELECT a.nm_pasien, b.no_pasien, a.j_kel, a.alamat, a.no_tlp from tb_pasien a, tb_antrian b where a.no_pasien=b.no_pasien and b.s_antri = '1' and b.tanggal = '".$tanggal."' and b.poli = '".$data['poli']."' ORDER BY no_pasien ASC";
						//echo $pasienSql;
					}
					$pasienQry = mysql_query($pasienSql)  or die ("Query pasien salah : ".mysql_error());
					while ($pasien = mysql_fetch_array($pasienQry)) {
				?>
						<tr>
							<td><?php echo $pasien['no_pasien'];?></td>
							<td><?php echo $pasien['nm_pasien'];?></td>
							<td><?php echo $pasien['j_kel'];?></td>
							<td><?php echo $pasien['alamat'];?></td>
							<td><?php echo $pasien['no_tlp'];?></td>
							<td>
								<div class='btn-group'>
									<a href="?page=rekam&action=add&nmr=<?php echo $pasien['no_pasien']; ?>" title='Rekam Medis'><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-zoom-in"></span></button></a>
								</div>
							</td>
						</tr>
				<?php
					} 
				?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php
} else {
	include "md_rekam_pasien.php";
}
?>