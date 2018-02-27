<?php
@session_start();
if(@$_SESSION['level'] != "pasien"){
?>
	<a href="?page=user&action=tambah"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah User </button></a><p>

	<div class="panel panel-default">
		<div class="panel-heading">
			Daftar User
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table id="table_id" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Username</th>
							<th>Nama User</th>
							<th width="90">Aksi</th>
						</tr>
					</thead>
					<tbody>
				<?php
					$obtSql = "SELECT * FROM tb_user ORDER BY username ASC";
					$obtQry = mysql_query($obtSql)  or die ("Query user salah : ".mysql_error());
					while ($user = mysql_fetch_array($obtQry)) {
				?>
						<tr>
							<td><?php echo $user['username'];?></td>
							<td><?php echo $user['nama'];?></td>
							<td>
							  <div class='btn-group'>
							  <a href="?page=user&action=hapus&nmr=<?php echo $user['username']; ?>" title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></a> 
							  <a href="?page=user&action=edit&nmr=<?php echo $user['username']; ?>" title='Edit Data ini'><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></button></a>
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