<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Barang</h3>
<a class="btn" href="barang.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$id_brg=mysql_real_escape_string($_GET['id']);
$det=mysql_query("SELECT * FROM barang WHERE id='$id_brg'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
?>					
	<form action="update.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id" value="<?php echo $d['id'] ?>"></td>
			</tr>
			<tr>
				<td>Tanggal</td>
				<td><input type="date" class="form-control" name="nama" value="<?php echo $d['tanggal'] ?>"></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><input type="text" class="form-control" name="nama" value="<?php echo $d['nama'] ?>"></td>
			</tr>
			<tr>
				<td>Harga</td>
				<td><input type="text" class="form-control" name="harga" value="<?php echo $d['harga'] ?>"></td>
			</tr>
			<tr>
				<td>QTY</td>
				<td><input type="text" class="form-control" name="qty" value="<?php echo $d['qty'] ?>"></td>
			</tr>
			<tr>
				<td>Nama Nota</td>
				<td><select name="nama" id="nama" class="form-control">
				<option value="">- Pilih -</option>
				<? 
				$nota = mysql_query("SELECT * FROM nota");
				while($nama = mysql_fetch_array($nota)){
					echo '<option value="'.$nama['idnota'].'">'.$nama['idnota'].'</option>';
				}
				?>
				</select></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan"></td>
			</tr>
		</table>
	</form>
	<?php 
}
?>
<?php include 'footer.php'; ?>