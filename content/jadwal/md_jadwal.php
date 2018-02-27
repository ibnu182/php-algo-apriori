
<?php
@session_start();
if(@$_SESSION['level'] != "pasien"){
	?>

	<a href="?page=jadwal&action=tambah"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah Jadwal </button></a><p>
	<div class="panel panel-default">
		<div class="panel-heading">
			Daftar jadwal
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table id="table_id" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>Poli Umum</th>
							<th>Poli Kandungan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
				<?php
					$and = "";
					$jadwalSql = "SELECT * FROM tb_jadwal ORDER BY tanggal ASC";
					$jadwalQry = mysql_query($jadwalSql)  or die ("Query jadwal salah : ".mysql_error());
					while ($jadwal = mysql_fetch_array($jadwalQry)) {
				?>
						<tr>
							<td><?php echo $jadwal['tanggal'];?></td>
							<td>
								<?php 
									if(empty($jadwal['dokter_pu1']) || empty($jadwal['dokter_pu2'])){
										$and = "";
									} else {
										$and = " & ";
									}
									echo "".$jadwal['dokter_pu1'].$and.$jadwal['dokter_pu2']."";
								?>
							</td>
							<td>
								<?php 
									if (empty($jadwal['dokter_pk1']) || empty($jadwal['dokter_pk2'])) {
										$and = "";
									} else {
										$and = " & ";
									}
									echo "".$jadwal['dokter_pk1'].$and.$jadwal['dokter_pk2']."";
								?>
							</td>
							<td>
								<div class='btn-group'>
									<a href="?page=jadwal&action=hapus&nmr=<?php echo $jadwal['tanggal']; ?>" title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></a> 
									<a href="?page=jadwal&action=edit&nmr=<?php echo $jadwal['tanggal']; ?>" title='Edit Data ini'><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></button></a>
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
} else if(@$_SESSION['level'] == "pasien"){
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
			Daftar jadwal
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table id="" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>Poli Umum</th>
							<th>Poli Kandungan</th>
						</tr>
					</thead>
					<tbody>
				<?php
					$jadwalSql = "SELECT * FROM tb_jadwal ORDER BY tanggal ASC";
					$jadwalQry = mysql_query($jadwalSql)  or die ("Query jadwal salah : ".mysql_error());
					while ($jadwal = mysql_fetch_array($jadwalQry)) {
				?>
						<tr>
							<td><?php echo $jadwal['tanggal'];?></td>
							<td><?php echo "".$jadwal['dokter_pu1']." & ".$jadwal['dokter_pu2']."";?></td>
							<td><?php echo "".$jadwal['dokter_pk1']." & ".$jadwal['dokter_pk2']."";?></td>
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
} else{
		echo " Anda tidak memiliki akses ";
}

?>