<?php include 'header.php'; ?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Barang</h3>
<button style="margin-bottom:10px" style="align:right" data-toggle="modal" data-target="#modal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-print"></span>Cetak</button>

<div id="modal" class="modal fade">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Cetak</h4>
		</div>
		<div class="modal-body">
			<form action="lap_barang.php" method="post">
				<div class="form-group">
					<label>Dari Tanggal </label>
					<input name="start_date" type="date" class="form-control">
				</div>
				<div class="form-group">
					<label>Sampai Tanggal </label>
					<input name="end_date" type="date" class="form-control">
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				<input type="submit" class="btn btn-primary" value="cetak">
			</div>
		</form>
	</div>
</div>
</div>
<br/>
<br/>

<?php 
$periksa=mysql_query("select * from barang where qty <=3");
while($q=mysql_fetch_array($periksa)){	
	if($q['qty']<=3){	
		?>	
		<script>
			$(document).ready(function(){
				$('#pesan_sedia').css("color","red");
				$('#pesan_sedia').append("<span class='glyphicon glyphicon-asterisk'></span>");
			});
		</script>
		<?php
		echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok  <a style='color:red'>". $q['nama']."</a> yang tersisa sudah kurang dari 3 . silahkan pesan lagi !!</div>";	
	}
}
?>
<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from barang");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<div class="col-md-12">
	<table class="col-md-2">
		<tr>
			<td>Jumlah Record</td>		
			<td><?php echo $jum; ?></td>
		</tr>
		<tr>
			<td>Jumlah Halaman</td>	
			<td><?php echo $halaman; ?></td>
		</tr>
	</table>
	<!-- <a style="margin-bottom:10px" href="lap_barang.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a> -->




</div>
<form action="" method="post" align="right">
<td width="125"><b>Dari Tanggal</b></td>
<td colspan="2" width="190">: <input type="date" name="tanggal_awal" size="16" />
</td>
<td width="125"><b>Sampai Tanggal</b></td>
<td colspan="2" width="190">: <input type="date" name="tanggal_akhir" size="16" />
</td>
<td colspan="2" width="190"><input type="submit" value="cari" name="pencarian"/></td>
</form>

<!-- <form action="cari_act.php" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari barang di sini .." aria-describedby="basic-addon1" name="cari">	
	</div>
</form> -->
<br/>
<table class="table table-hover">
	<tr>
		<th class="col-md-1">No</th>
		<th class="col-md-1">Tanggal</th>
		<th class="col-md-3">Nama Barang</th>
		<th class="col-md-2">Harga Beli</th>
		<th class="col-md-1">QTY</th>
		<th class="col-md-2">Total</th>
		<!-- <th class="col-md-1">Total</th> -->
		<!-- <th class="col-md-1">Sisa</th>		 -->
		<th class="col-md-3">Opsi</th>
	</tr>
	<?php 
	if(isset($_POST['pencarian'])){
		$tanggal_awal = $_POST['tanggal_awal'];
		$tanggal_akhir = $_POST['tanggal_akhir'];
		$brg=mysql_query("SELECT * from barang where tanggal between '$tanggal_awal'and'$tanggal_akhir'");
	}else{
		$brg=mysql_query("select * from barang limit $start, $per_hal");
	}
	$no=1;
	while($b=mysql_fetch_array($brg)){

		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['tanggal'] ?></td>
			<td><?php echo $b['nama'] ?></td>
			<td>Rp.<?php echo number_format($b['harga']) ?>,-</td>
			<td><?php echo $b['qty'] ?></td>
			<td>Rp.<?php echo $b['subtotal']?></td>
			<!-- <td>Rp.<?php echo $tot = array_sum($sub);?></td> -->
			<td>
				<a href="det_barang.php?id=<?php echo $b['id']; ?>" class="btn btn-info">Detail</a>
			</td>
		</tr>		
		<?php 
	}
	?>
	

</table>


<!--test Modal-->
<!-- <div class="container-fluid">
	<div class="row">
	
		<div class="col-md-12">
			 <a id="modal-599578" href="#modal-container-599578" role="button" class="btn" data-toggle="modal"><span class='glyphicon glyphicon-print'></span>Cetak</a>
			 		
			<div class="modal fade" id="modal-container-599578" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="myModalLabel">
								Cetak rincian
							</h5> 
							<button type="button" class="close" data-dismiss="modal">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						
						<div class="modal-body">
						<form action="lap_barang.php" method="post" target="_blank">
						<div class="form-group">
						<label>Dari Tanggal</label>
						<input name="start_date" type="date" vaule="<?php echo date('Y-m-d'); ?>" class="form-control" placeholder="Input Tanggal">
						</div>
						<div class="form-group">
						<label>Sampai Tanggal</label>
						<input name="end_date" type="date" vaule="<?php echo date('Y-m-d'); ?>" class="form-control" placeholder="Input Tanggal">
						</div>

						</div>
						<div class="modal-footer">
							 
							<button type="button" class="btn btn-primary"  name="cetak" value="cetak">
								Cetak
							</button> 
							<button type="button" class="btn btn-secondary" data-dismiss="modal">
								Close
							</button>
						</div>
						</form>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
</div> -->

<!-- -->
<ul class="pagination">			
			<?php 
			for($x=1;$x<=$halaman;$x++){
				?>
				<li><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
				<?php
			}
			?>						
		</ul>
<!-- modal input -->

<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Barang Baru</h4>
			</div>
			<div class="modal-body">
				<form action="tmb_brg_act.php" method="post">
					<div class="form-group">
						<label>Tanggal</label>
						<input name="tanggal" type="date" class="form-control" placeholder="Input Tanggal">
					</div>
					<div class="form-group">
						<label>Nama Barang</label>
						<input name="nama" type="text" class="form-control" placeholder="Nama Barang ..">
					</div>
					<div class="form-group">
						<label>Suplier</label>
						<input name="suplier" type="text" class="form-control" placeholder="Suplier ..">
					</div>	
					<div class="form-group">
						<label>Harga Beli</label>
						<input name="harga" type="text" class="form-control" placeholder="Harga Beli">
					</div>	
					<div class="form-group">
						<label>QTY</label>
						<input name="qty" type="text" class="form-control" placeholder="QTY">
					</div>
					<div class="form-group">
						<label>Satuan</label>
						<input name="satuan" type="text" class="form-control" placeholder="Satuan ..">
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
			</form>
		</div>
	</div>
</div>



<?php 
include 'footer.php';

?>