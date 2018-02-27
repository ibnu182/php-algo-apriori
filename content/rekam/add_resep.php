<?php
@session_start();
if(@$_SESSION['level'] != 'pasien'){

	function is_obat_selected($id,$no,$tgl){
		$jml=mysql_num_rows(mysql_query("select * from tb_resep where no_pasien='".$no."' and tgl_pemeriksaan ='".$tgl."' and kd_obat = '".$id."'"));
		return $jml;
	}

	$no 	= @$_GET['no'];
	$tgl 	= @$_GET['tgl'];	
	$cek_rekam 	= @$_GET['rekam'];
	$sql 	= mysql_query("select * from tb_obat");

	$btn 	= "<input type='submit' id='simpan' class='btn btn-primary' name='simpan' value='Simpan'>";
	$btn 	= ($cek_rekam>0) ? "" : $btn;
	$rekam 	= "<p align='right'>
	<a href='?page=rekam&action=del_resep&no=".$no."&tgl=".$tgl."' align='right'>Hapus &raquo</a>
</p>";
	$rekam 	= ($cek_rekam>0) ? "" : $rekam;


?>
<div class="container">
<?php echo $rekam;?>
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
								<input type="checkbox" name="obat[]" value="<?php echo $data['kd_obat'];?>" checked="checked" disabled="disabled">
							</label>
						</div>
					</td>
					<td> <?php echo $resep['kd_obat']; ?> </td>
					<td> <?php echo $resep['nm_obat'];?> </td>
					<td> <?php echo $resep['kuantiti'];?> </td>
					<td> <?php echo $resep['ukuran'];?> </td>
				</tr>

<?php
			} else {
?>

				<tr>
					<td align="center">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="obat[]" value="<?php echo $data['kd_obat'];?>">
							</label>
						</div>
					</td>
					<td> <?php echo $data['kd_obat']; ?> </td>
					<td> <?php echo $data['nm_obat'];?> </td>
					<td><input type="number" name="qty[]" class="form-control"></td>
					<td> <?php echo $data['ukuran'];?> </td>
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
	$qty 	= @$_POST['qty'];
	$obat 	= @$_POST['obat'];
	$simpan = @$_POST['simpan'];


	if ($simpan)
	{
		// $sql	=	mysql_query(" select * from tb_resep where no_pasien = '".$no."' and tgl_pemeriksaan = '".$tgl."'");
		// $cek_resep 	= mysql_num_rows($sql);
			// and kd_obat = '".$obat[$a]."'
		// if($cek_resep>0){
		if(count($obat)>0){
/*
		echo "	<script type='text/javascript'>
						alert(' Tes ');
					</script>
				";
*/
			$cek 	= 0;
			$kd 	= 1;
			for ($a = 0; $a < count($obat); $a++)
			{
				$max = mysql_query(" select max(id_resep) as id_resep from tb_resep");
				if(mysql_num_rows($max)>0)
				{
					$data = mysql_fetch_array($max);
					$kd = (int) $data['id_resep'] + 1;
				}

				$baca_data = mysql_query(" select * from tb_resep where no_pasien = '".$no."' and kd_obat = '".$obat[$a]."' and tgl_pemeriksaan = '".$tgl."'");
				if(mysql_num_rows($baca_data)==0)
				{
					$sql = mysql_query(" insert into tb_resep set id_resep='".$kd."', no_pasien= '".$no."', kd_obat = '".$obat[$a]."', tgl_pemeriksaan = '".$tgl."', kuantiti = '".$qty[$a]."', tgl_resep='".date('Y-m_d h:m:s')."' ") or die (mysql_error());
					$cek++;
				}
				
				echo " insert into tb_resep set id_resep='".$kd."', no_pasien= '".$no."', kd_obat = '".$obat[$a]."', tgl_pemeriksaan = '".$tgl."', kuantiti = '".$qty[$a]."', tgl_resep='".date('Y-m_d h:m:s')."' </br>";	
			}
			
			echo "jumlah obat : ".count($obat)." jumlah qty : ".count($qty);
		/*
			if ($cek>0){		
				echo "	<script type='text/javascript'>
						alert(' Saving success ');
						window.location.href = ' ?page=rekam&action=add&nmr=$no ';
					</script>
				";
			} else {
				echo "	<script type='text/javascript'>
						alert(' Saving failed ');
						window.location.href = window.location.href;
					</script>
				";
			}
			*/	
		} else {
			echo "	<script type='text/javascript'>
						alert(' Belum mengisi obat ');
						return confirm('Apakah anda ingin menyimpan rekam medis ?');
					</script>
				";
						// window.location.href = ' ?page=rekam&action=add&nmr=$no ';
		}
	}
} else {
	include "resep.php";
}

?>