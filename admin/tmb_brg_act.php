<?php 
include 'config.php';
$tanggal=$_POST['tanggal'];
$nama=$_POST['nama'];
$suplier=$_POST['suplier'];
$harga=$_POST['harga'];
$qty=$_POST['qty'];
$satuan=$_POST['satuan'];

mysql_query("insert into barang values('','$tanggal','$nama','$suplier','$harga','$qty','$satuan')");
header("location:barang.php");

 ?>