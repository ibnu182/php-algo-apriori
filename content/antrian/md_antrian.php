
<?php
@session_start();
if(@$_SESSION['level'] != "pasien"){
?>
	<a href="?page=pasien"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah Antrian </button></a><p>
	<div class="panel panel-default">
		<div class="panel-heading">
			Daftar Antrian
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table id="table_id" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>Nama Pasien</th>
							<th>Poli</th>
							<th>Keterangan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
				<?php
					$tanggal 	= date('Y-m-d');
					$antrianSql = "SELECT a.no_antrian, a.tanggal, b.nm_pasien, a.poli, a. s_antri, CASE a.s_antri WHEN '0' THEN 'Belum dipanggil' ELSE 'Sudah dipanggil' END AS keterangan FROM tb_antrian a, tb_pasien b WHERE a.no_pasien=b.no_pasien and a.tanggal = '$tanggal' order by b.nm_pasien asc";
					$antrianQry = mysql_query($antrianSql)  or die ("Query jadwal salah : ".mysql_error());
					while ($antrian = mysql_fetch_array($antrianQry)) {
					$btn 		= "	<div class='btn-group'>
										<a href='?page=antrian&action=edit&nmr=$antrian[no_antrian]' title='Panggil'><button type='button' class='btn btn-success'><span class='glyphicon glyphicon-check'></span></button></a>
									</div>";
				?>
						<tr>
							<td><?php echo $antrian['tanggal'];?></td>
							<td><?php echo $antrian['nm_pasien'];?></td>
							<td><?php echo $antrian['poli'];?></td>
							<td><?php echo $antrian['keterangan'];?></td>
							<td>
								<?php 
									$btn = ($antrian['s_antri'] == 1) ? "" : $btn;
									echo $btn;
								?>
								<!-- <div class='btn-group'>
									<a href="?page=antrian&action=edit&nmr=<?php echo $antrian['no_antrian']; ?>" title='Panggil'><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-check"></span></button></a>
								 --></div>
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
} else if (@$_SESSION['level'] == "pasien"){
	$user = @$_SESSION['user'];
	function poli($v_poli,$user){
		$no = '';
		$cek = mysql_query("select * from tb_antrian a, tb_user b, tb_pasien c where a.no_pasien=c.no_pasien and b.nama=c.nm_pasien and b.username='".$user."' and a.tanggal = '".date('Y-m-d')."' and a.poli='".$v_poli."'");
		
		$get_nomor = mysql_query("select b.no_pasien from tb_user a, tb_pasien b where a.nama=b.nm_pasien and a.username='".$user."'");
		
		while($pasien = mysql_fetch_array($get_nomor)){
			$no = $pasien['no_pasien'];
		}
		
		$btn = "<td width='100px'><a href='?page=antrian&action=tambah&nmr=".$no."&poli=".$v_poli."' title='Masukkan antrian'> <button type='button' class='btn btn-large btn-block btn-default'> Tambah </button> </a></td>";

		if(mysql_num_rows($cek)>0){
			$btn = "";
		} else {
			$btn = $btn;
		}
		echo $btn;
	}

	// $btn = (mysql_num_rows($cek)>0) ? "" : $btn ;
	// echo "isi var btn : $btn";
	// echo "isi user : $user";
	// echo "isi tanggal : ".date('Y-m-d')."";
?>
	<div class="panel panel-default">
		<div class="panel-heading">
			Daftar Antrian
		</div>
		<div class="panel-body">
			<div class="container">
				
				<div class="row">
					<h2><strong><u>Jumlah Antrian</u></strong></h2><br>
					<div class="table-responsive">
						<table>
							<thead>
							</thead>
							<tbody>
							<?php
								$poli = array('Umum', 'Kandungan');
								for($i=0; $i<count($poli);$i++){
									$v_poli =  $poli[$i];
									$sql = mysql_query("select count(*) as jml from tb_antrian a where a.tanggal = '".date('Y-m-d')."' and a.poli = '".$v_poli."'");
									if(mysql_num_rows($sql)>0){
										while($jml = mysql_fetch_array($sql)){		
							?>
								<tr>
									<td width="300px" height="30px">Poli <?php echo $v_poli;?></td>
									<td> : </td>
									<td width="100px"> <?php echo $jml['jml'];?> antrian </td>
									<?php poli($v_poli,$user); ?>
								</tr>
							<?php
										}
									} 
								}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
} else {
	echo " Anda tidak memiliki akses ";
}
?>