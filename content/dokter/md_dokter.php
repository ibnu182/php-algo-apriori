<?php
@session_start();
if(@$_SESSION['level'] != "pasien"){
?>

	<a href="?page=dokter&action=tambah"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah Dokter </button></a><p>
	<div class="panel panel-default">
		<div class="panel-heading">
			Daftar Dokter
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table id="table_id" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Nama Dokter</th>
							<th>Alamat</th>
							<th>Nomor Telepone</th>
							<th>Poli</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
				<?php
					$dokterSql = "SELECT * FROM tb_dokter ORDER BY nm_dokter ASC";
					$dokterQry = mysql_query($dokterSql)  or die ("Query dokter salah : ".mysql_error());
					while ($dokter = mysql_fetch_array($dokterQry)) {
				?>
						<tr>
							<td><?php echo $dokter['nm_dokter'];?></td>
							<td><?php echo $dokter['alamat'];?></td>
							<td><?php echo $dokter['no_tlp'];?></td>
							<td><?php echo $dokter['poli'];?></td>
							<td>
							  <div class='btn-group'>
							  <a href="?page=dokter&action=hapus&nmr=<?php echo $dokter['kd_dokter']; ?>" title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></a> 
							  <a href="?page=dokter&action=edit&nmr=<?php echo $dokter['kd_dokter']; ?>" title='Edit Data ini'><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></button></a>
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
	echo " Anda tidak memiliki akses ";
}
?>