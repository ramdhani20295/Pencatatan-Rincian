<?php 
include 'config.php';
$tanggal=$_POST['tanggal'];
$nama=$_POST['nama'];
$suplier=$_POST['suplier'];
$harga=$_POST['harga'];
$jumlah=$_POST['jumlah'];
$satuan=$_POST['satuan'];

mysql_query("insert into barang values('','$tanggal','$nama','$suplier','$harga','$jumlah','$satuan')");
header("location:barang.php");

 ?>