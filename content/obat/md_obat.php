<?php
@session_start();
if(@$_SESSION['level'] != "kasir"){
?>

	<div class="row">
	    <div class="col-md-12">
	        <h2 class="page-header">
	            <small>Daftar Obat</small>
	        </h2>
	    </div>
	</div> 

	<a href="?page=obat&action=input&isedit=0"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah Obat </button></a><p>

	<div class="panel panel-default">
		<!-- <div class="panel-heading">
			Daftar Obat
		</div> -->
		<div class="panel-body">
			<div class="table-responsive">
				<table id="table_id" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th width="100">Kode Obat</th>
							<th>Nama Obat</th>
							<th>Jenis</th>
							<th>Ukuran</th>
							<th>Stok</th>
							<th>Harga (Rp.)</th>
							<th width="90">Aksi</th>
						</tr>
					</thead>
					<tbody>
				<?php
					$obtSql = "SELECT * FROM tb_obat ORDER BY kode_obat ASC";
					$obtQry = mysql_query($obtSql)  or die ("Query Obat salah : ".mysql_error());
					while ($obat = mysql_fetch_array($obtQry)) {
				?>
						<tr>
							<td><?php echo $obat['kode_obat'];?></td>
							<td><?php echo $obat['nama_obat'];?></td>
							<td><?php echo $obat['jenis'];?></td>
							<td><?php echo $obat['ukuran'];?></td>
							<td><?php echo $obat['stok'];?></td>
							<td align="right"><?php echo $obat['harga'];?></td>
							<td>
							  <div class='btn-group'>
							  <a href="?page=obat&action=hapus&kd=<?php echo $obat['kode_obat']; ?>" title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></a> 
							  <a href="?page=obat&action=input&isedit=1&kd=<?php echo $obat['kode_obat']; ?>" title='Edit Data ini'><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></button></a>
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