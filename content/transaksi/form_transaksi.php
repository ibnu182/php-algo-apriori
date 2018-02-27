<?php
date_default_timezone_set('Asia/Jakarta');
$isedit 	= @$_GET['isedit'];
$kd  		= @$_GET['kd'];

	$query 	= "select * from tb_transaksi where no_transaksi like '%".date('dmy')."%'";
	$sql 	= mysql_query($query) or die(mysql_error());
	$cek 	= mysql_num_rows($sql);
	$no 	= "";
	$pad 	= 3;

	if($cek>0){
		$query 	= "select max(no_transaksi) as max from tb_transaksi where no_transaksi like '%".date('dmy')."%'";
		$sql  	= mysql_query($query) or die (mysql_error());
		$data 	= mysql_fetch_array($sql);

		$no 	= ((int) substr($data['max'], 7)) + 1;

		if ($no > 9){
			$pad 	= 2;
		} else if ($no > 99){
			$pad 	= 1;
		}
	} else {
		$no 	= "1";
		// $no 	= date('dmy').str_pad("1",$pad,"0",STR_PAD_LEFT);
	}

	$simpan = @$_POST['simpan'];
	$obt 	= @$_POST['obt'];
	$jml 	= @$_POST['jml'];
	$no 	= "T".date('dmy').str_pad($no,$pad,"0",STR_PAD_LEFT);

	if($simpan) {
		if(count($obt)>0){
			for($i=0; $i<count($jml); $i++){
				if($jml[$i] != ''){
					$jumlah[] = $jml[$i];
				}
			}

			$sql 	= mysql_query("insert into tb_transaksi set no_transaksi = '".$no."', kode_kasir = '".@$_SESSION['user']."', tanggal_transaksi = '".date('Y-m-d')."', waktu_transaksi = '".date('H:m:s')."'") or die (mysql_error());

			for($i=0; $i<count($obt); $i++){
				$q 			= mysql_query("select stok from tb_obat where kode_obat='".$obt[$i]."'") or die (mysql_error());
				$query 		= mysql_fetch_array($q);
				$s 			= (int)$query['stok'];
				$jmlStok 	= $s - ((int)$jumlah[$i]);

				mysql_query("update tb_obat set stok = '".$jmlStok."' where kode_obat = '".$obt[$i]."'");

				$sql 	= mysql_query("insert into tb_detail_transaksi set no_transaksi = '".$no."', kode_obat = '".$obt[$i]."', jumlah = '".$jumlah[$i]."'") or die (mysql_error());
				if($sql == true){
					$r[] = "true";
				}
			}

			if(count($obt) == count($r)){
				
				if($sql){	
					echo "<script type='text/javascript'>alert('Berhasil menambah data.');window.location.href='?page=transaksi';</script>";
				} else {
					echo "<script type='text/javascript'>alert('Gagal menambah data transaksi.');window.location.href='?page=transaksi';</script>";
				}
			} else {
				echo "<script type='text/javascript'>alert('Gagal menambah detail data transaksi.');window.location.href='?page=transaksi';</script>";
			}
		}
	}

?>

<div class="box">
	<div class="row">
	    <div class="col-md-12">
	        <h2 class="page-header">
	            <small>Form Transaksi</small>
	        </h2>
	    </div>
	</div>
	<div class="body">
		<table class="table table-hover">
			<tr>
				<td width="200px"> No. Transaksi </td>
				<td width="25px"> : </td>
				<td width="600px"> 
					<?php echo $no;?> 
				</td>
				<td width=""> <?php echo  date('d-m-Y H:m:s');?> </td>
			</tr>
			<tr> 
				<td> User </td>
				<td width="25px"> : </td>
				<td colspan="6"> <?php echo @$_SESSION['nama'];?> </td>
			</tr>
		</table>
	</div>

	<div class="panel panel-default">
		<!-- <div class="panel-heading">
			Daftar Obat
		</div> -->
		<div class="panel-body">
			<form action="" method="post">
				<div class="table-responsive">
					<table id="table_id" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th width=""><?php echo ($isedit == 0) ? "" : "No." ?></th>
								<th>Nama Obat</th>
								<th>Jenis</th>
								<th>Ukuran</th>
								<?php echo ($isedit == 0) ? "<th>Stok</th>" : "" ?>
								<th>Harga (Rp.)</th>
								<th width="90">Jumlah</th>
							</tr>
						</thead>
						<tbody>
					<?php
						$obtSql = ($isedit == 0) ? "select * FROM tb_obat ORDER BY kode_obat ASC" : "select * FROM tb_detail_transaksi a, tb_obat b where a.kode_obat=b.kode_obat and a.no_transaksi = '".$kd."'";
						$obtQry = mysql_query($obtSql)  or die ("Query Obat salah : ".mysql_error());
						$n 		= 1;
						$total 	= 0;
						while ($obat = mysql_fetch_array($obtQry)) {
					?>
							<tr>
								<td>
									<?php echo ($isedit == 0) ? "<input type='checkbox' name='obt[]' value='".$obat['kode_obat']."'>": $n; ?>
								</td>
								<td><?php echo $obat['nama_obat'];?></td>
								<td><?php echo $obat['jenis'];?></td>
								<td><?php echo $obat['ukuran'];?></td>
								<?php echo ($isedit == 0) ? "<td>".$obat['stok']."</td>" : "";?>
								<td align="right"><?php echo $obat['harga'];?></td>
								<td>
								  	<?php echo ($isedit == 0) ? "<input type='number' name='jml[]' class='form-control'>" : $obat['jumlah'];?>
								</td>
							</tr>
					<?php
						if($isedit==1){$total = $total + ($obat['harga'] * $obat['jumlah']);}
						$n++;
						}
					?>
						</tbody>
					</table>
					<?php
						if($isedit == 1){
					?>
						<table class="table table-hover">
							<tr> 
								<td> <strong>Jumlah</strong> </td>
								<td width="25px"> <strong>:</strong> </td>
								<td colspan="6" align='right'> <strong><?php echo $total;?></strong> </td>
							</tr>
						</table>
					<?php
						}
					?>
				</div>

				<?php echo ($isedit == 0) ? "<p align='right';float='right'>
									<input type='submit' class='btn btn-primary' name='simpan' value='Simpan'>
									<button type='reset' class='btn btn-info'>Reset</button>
									<button type='reset' class='btn btn-danger' onclick='history.go(-1);'>Kembali</button></p>" : "" 
				?>
				
			</form>
		</div>
	</div>
</div>