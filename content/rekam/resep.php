<?php

	$no 	= @$_GET['no'];
	$tgl 	= @$_GET['tgl'];	
	$sql 	= mysql_query("select b.kd_obat, a.nm_obat, b.kuantiti, a.ukuran from tb_obat a, tb_resep b where a.kd_obat=b.kd_obat and b.no_pasien='".$no."' and tgl_pemeriksaan='".$tgl."'");
?>

<div class="container">
	<form method="POST">
		<table id="table_id" class="table table-striped table-bordered table-hover" width="1150px">
			<thead>
				<tr>
					<th width="100px">Kode Obat</th>
					<th width="790px">Nama Obat</th>
					<th>Kuantiti</th>
					<th>Ukuran</th>
				</tr>
			</thead>
			<tbody>
<?php
			while ($resep=mysql_fetch_array($sql)) {
?>
				<tr>
					<td> <?php echo $resep['kd_obat']; ?> </td>
					<td> <?php echo $resep['nm_obat'];?> </td>
					<td> <?php echo $resep['kuantiti'];?> </td>
					<td> <?php echo $resep['ukuran'];?> </td>
				</tr>
<?php
			}
?>
			</tbody>
		</table>
		<p align='center';float='center'>
			<button type="reset" class="btn btn-danger" onclick="history.go(-1);">Kembali</button>
		</p>

	</form>
</div
<br><br><br><br><br><br><br><br><br><br>