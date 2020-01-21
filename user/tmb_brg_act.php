<?php 
include 'config.php';
$tanggal=$_POST['tanggal'];
$nama=$_POST['nama'];
$suplier=$_POST['suplier'];
$harga=$_POST['harga'];
$qty=$_POST['qty'];
$satuan=$_POST['satuan'];
$subtotal = $_POST['harga'] * $_POST['qty'];

mysql_query("insert into barang values('','$tanggal','$nama','$suplier','$harga','$qty','$satuan','$subtotal')");
header("location:barang.php");

 ?>