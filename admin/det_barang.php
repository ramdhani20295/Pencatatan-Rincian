<?php 
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Detail Barang</h3>
<a class="btn" href="barang.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$id_brg=mysql_real_escape_string($_GET['id']);


$det=mysql_query("SELECT
barang.*, nota.nama_gambar FROM barang INNER JOIN nota ON barang.idnota = nota.idnota WHERE id='$id_brg'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>					
	<table class="table">
		<tr>
			<td>Tanggal</td>
			<td><?php echo $d['tanggal'] ?></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td><?php echo $d['nama'] ?></td>
		</tr>
		<tr>
			<td>Harga</td>
			<td>Rp.<?php echo number_format($d['harga']) ?>,-</td>
		</tr>
		<tr>
			<td>qty</td>
			<td><?php echo $d['qty'] ?></td>
		</tr>
		<tr>
			<td>Satuan</td>
			<td><?php echo $d['satuan'] ?></td>
		</tr>
		<tr>
			<td>Subtotal</td>
			<td>Rp.<?php echo number_format($d['subtotal']) ?></td>
		</tr>
		<tr>
		<td>Gambar</td>
			<td><?echo $d['nama_gambar']?></td>
		</tr>
	</table>
	<?php 
}
?>
<?php include 'footer.php'; ?>