<?php
@session_start();
if(@$_SESSION['level'] != "pasien"){

?>
	<a href="?page=pasien&action=tambah"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah Pasien </button></a><p>
	<div class="panel panel-default">
		<div class="panel-heading">
			Daftar Pasien
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
							<th>Antrian</th>
						</tr>
					</thead>
					<tbody>
				<?php
					$pasienSql = "SELECT * FROM tb_pasien ORDER BY no_pasien ASC";
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
									<a href="?page=pasien&action=hapus&nmr=<?php echo $pasien['no_pasien']; ?>" title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></a> 
									<a href="?page=pasien&action=edit&nmr=<?php echo $pasien['no_pasien']; ?>" title='Edit Data ini'><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></button></a>
								</div>
							</td>
							<td>
								<div class='btn-group'>
									<a href="?page=antrian&action=tambah&nmr=<?php echo $pasien['no_pasien'];?>&poli=Umum" title="Masukkan antrian"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>PU</button></a>
								</div>
								<div class='btn-group'>
									<a href="?page=antrian&action=tambah&nmr=<?php echo $pasien['no_pasien'];?>&poli=Kandungan" title="Masukkan antrian"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>PK</button></a>
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