<?php include 'header.php'; ?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Barang</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Barang</button>
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
	<a style="margin-bottom:10px" href="lap_barang.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a>
</div>
<form action="" method="get" align="right">
Tanggal Dari :<input type="date" name="start_date"><a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_awal);return false;" ></a>
Sampai Tanggal :<input type="date" name="end_date"><a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_awal);return false;" ></a>
<input type="submit" name="search"  value="search" class="btn btn-info">
</form>

<?php
if(isset($_POST['search'])){
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	if(empty($start_date)||empty($end_date)){
		echo "<script>alert('Gagal!') 
		document.location='barang.php'
		</script>";
	}else{
		echo "Informasi : Hasil Pencarian data berdasarkan periode Tanggal";
		echo $_POST['start_date'];
		echo $_POST['end_date'];
		$query = mysql_query("SELECT * FROM barang WHERE tanggal BETWEEN '$start_date' AND '$end_date'");
	}
}
?>




<form action="cari_act.php" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari barang di sini .." aria-describedby="basic-addon1" name="cari">	
	</div>
</form>
<br/>
<table class="table table-hover">
	<tr>
		<th class="col-md-1">No</th>
		<th class="col-md-1">Tanggal</th>
		<th class="col-md-3">Nama Barang</th>
		<th class="col-md-2">Harga Beli</th>
		<th class="col-md-1">QTY</th>
		<th class="col-md-1">Total</th>
		<!-- <th class="col-md-1">Total</th> -->
		<!-- <th class="col-md-1">Sisa</th>		 -->
		<th class="col-md-3">Opsi</th>
	</tr>
	<?php 
	if(isset($_GET['cari'])){
		$cari=mysql_real_escape_string($_GET['cari']);
		$brg=mysql_query("select * from barang where nama like '$cari' or jenis like '$cari'");
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
			<td>Rp.<?php echo $sub[] = $b['qty'] * $b['harga']?></td>
			<!-- <td>Rp.<?php echo $tot = array_sum($sub);?></td> -->
			<td>
				<a href="det_barang.php?id=<?php echo $b['id']; ?>" class="btn btn-info">Detail</a>
				<a href="edit.php?id=<?php echo $b['id']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus.php?id=<?php echo $b['id']; ?>' }" class="btn btn-danger">Hapus</a>
			</td>
		</tr>		
		<?php 
	}
	?>
	

</table>


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