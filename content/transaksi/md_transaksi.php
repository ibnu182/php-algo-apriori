<?php
@session_start();
if(@$_SESSION['level'] != "kasir" || @$_SESSION['level'] != "staff"){
?>

	<div class="row">
	    <div class="col-md-12">
	        <h2 class="page-header">
	            <small>Daftar Transaksi</small>
	        </h2>
	    </div>
	</div> 

	<?php
		echo (@$_SESSION['level'] == 'staff') ? "" : "<a href='?page=transaksi&action=input&isedit=0'><button type='button' class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Tambah Transaksi </button></a><p>";

	?>

	<div class="panel panel-default">
		<!-- <div class="panel-heading">
			Daftar Obat
		</div> -->
		<div class="panel-body">
			<div class="table-responsive">
				<table id="table_id" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Tanggal Transaksi</th>
							<th>No. Transaksi</th>
							<th>Jumlah (Rp.)</th>
							<th width="90">Aksi</th>
						</tr>
					</thead>
					<tbody>
				<?php
					$trxSql = "SELECT * FROM tb_transaksi ORDER BY no_transaksi ASC";
					$trxQry = mysql_query($trxSql)  or die ("Query Obat salah : ".mysql_error());
					while ($trx = mysql_fetch_array($trxQry)) {
						$sql = mysql_query("select sum(a.harga*b.jumlah) as jumlah from tb_detail_transaksi b, tb_obat a where a.kode_obat = b.kode_obat and b.no_transaksi = '".$trx['no_transaksi']."'") or die (mysql_error());
						$data = mysql_fetch_array($sql) or die (mysql_error());
				?>
						<tr>
							<td><?php echo $trx['tanggal_transaksi']." ". $trx['waktu_transaksi'];?></td>
							<td><?php echo $trx['no_transaksi'];?></td>
							<td align="right"><?php echo $data['jumlah'];?></td>
							<td>
							  <div class='btn-group'>
							  <!-- <a href="?page=transaksi&action=hapus&kd=<?php echo $trx['no_transaksi']; ?>" title="Hapus data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></a>  -->
							  <a href="?page=transaksi&action=input&isedit=1&kd=<?php echo $trx['no_transaksi']; ?>" title='Detail data ini'><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-zoom-in"></span></button></a>
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