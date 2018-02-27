<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">
            <small>Laporan</small>
        </h2>
    </div>
</div>

<div class="panel panel-default">
	<div class="panel-body">
		<form action="" method="post">
			<table class="table">
				<tr>
					<td>Tanggal</td>
					<td align="center">:</td>
					<td><input type="date" name="awal" class="form-control" required="required" title="Tanggal Awal"></td>
					<td align="center">-</td>
					<td><input type="date" name="akhir" class="form-control" required="required" title="Tanggal Akhir"></td>
				</tr>
			</table>


				
			<div class="table-responsive">
				<table id="" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Jumlah Kombinasi</th>
							<th>Threshold Support</th>
							<th>Threshold Support x Confidence</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<select name="kombinasi" id="input" class="form-control" required="required">
				<?php
					for($i=0;$i<7;){
						$i++;
				?>
									<option value="<?php echo $i;?>"><?php echo $i." Produk";?></option>
				<?php
					}
				?>
								</select>
							</td>
							<td>
							  	<?php echo "<input type='text' name='support' class='form-control'>";?>
							</td>
							<td>
							  	<?php echo "<input type='text' name='sxc' class='form-control'>";?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<?php 
				echo "<p align='center';float='center'>
							<input type='submit' class='btn btn-primary' name='proses' value='Proses'>
							<button type='reset' class='btn btn-danger' onclick='history.go(-1);'>Kembali</button></p>";
			?>
		</form>
	</div>
</div>
<?php
	$proses 	= @$_POST['proses'];
	if($proses) {

		echo"
		<script type='text/javascript'>
			window.location.href = '?page=laporan&action=hasil&awal=".@$_POST['awal']."&akhir=".@$_POST['akhir']."&kombinasi=".@$_POST['kombinasi']."&support=".@$_POST['support']."&sxc=".@$_POST['sxc']."';
		</script>";
	}
?>
