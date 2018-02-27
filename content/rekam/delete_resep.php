<?php
@session_start();
if(@$_SESSION['level'] != 'pasien'){

	function is_obat_selected($id,$no,$tgl){
		$jml=mysql_num_rows(mysql_query("select * from tb_resep where no_pasien='".$no."' and tgl_pemeriksaan ='".$tgl."' and kd_obat = '".$id."'"));
		return $jml;
	}

	$no 		= @$_GET['no'];
	$tgl 		= @$_GET['tgl'];	
	$cek_rekam 	= @$_GET['rekam'];
	$sql 		= mysql_query("select * from tb_obat");

	$btn 		= "<input type='submit' class='btn btn-primary' name='hapus' value='Hapus'>";
	$btn 		= ($cek_rekam>0) ? "" : $btn;

?>

<div class="container">
	<form method="POST">
		<table id="table_id" class="table table-striped table-bordered table-hover" width="1150px">
			<thead>
				<tr>
					<th width="10px"></th>
					<th width="100px">Kode Obat</th>
					<th width="790px">Nama Obat</th>
					<th>Kuantiti</th>
					<th>Ukuran</th>
				</tr>
			</thead>
			<tbody>

<?php
	while ($data=mysql_fetch_array($sql)) {
		if(!empty($no)){
			if(is_obat_selected($data['kd_obat'],$no,$tgl)==1){
				$resep = mysql_fetch_array(mysql_query("select b.kd_obat, a.nm_obat, b.kuantiti, a.ukuran from tb_obat a, tb_resep b where a.kd_obat=b.kd_obat and b.kd_obat='".$data['kd_obat']."' and b.no_pasien='".$no."' and tgl_pemeriksaan='".$tgl."'"));
?>
				<tr>
					<td align="center">
						<div class="checkbox">
							<label>

								<input type="checkbox" name="obat[]" value="<?php echo $data['kd_obat'];?>">
							</label>
						</div>
					</td>
					<td> <?php echo $resep['kd_obat']; ?> </td>
					<td> <?php echo $resep['nm_obat'];?> </td>
					<td> <?php echo $resep['kuantiti'];?> </td>
					<td> <?php echo $resep['ukuran'];?> </td>
				</tr>

<?php
			}
		}
	}
?>
			</tbody>
		</table>
		<p align='center';float='center'>
			<?php echo $btn;?>
			<button type="reset" class="btn btn-danger" onclick="history.go(-1);">Kembali</button>
		</p>

	</form>
</div
<br><br><br><br><br><br><br><br><br><br>

<?php
	$obat 	= @$_POST['obat'];
	$hapus = @$_POST['hapus'];


	if ($hapus)
	{
		$cek 	= 0;
		for ($a = 0; $a < count($obat); $a++)
		{
			$sql = mysql_query(" delete from tb_resep where no_pasien= '".$no."' and kd_obat = '".$obat[$a]."' and tgl_pemeriksaan = '".$tgl."'") or die (mysql_error());
			$cek++;
		}
	
		if ($cek>0){		
			echo "	<script type='text/javascript'>
					alert(' Saving success ');
					window.location.href = ' ?page=rekam&action=add&nmr=".$no." ';
				</script>
			";
		} else {
			echo "	<script type='text/javascript'>
					alert(' Saving failed ');
					window.location.href = window.location.href;
				</script>
			";
		}
	}
} else {
	include "resep.php";
}

?>