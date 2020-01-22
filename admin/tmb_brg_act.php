<?php 
include 'config.php';
$tanggal=$_POST['tanggal'];
$nama=$_POST['nama'];
$harga=$_POST['harga'];
$qty=$_POST['qty'];
$satuan=$_POST['satuan'];
$subtotal = $_POST['harga'] * $_POST['qty'];
$idnota = $_POST['nota_idnota'];

mysql_query("insert into barang, nota  values('','$tanggal','$nama','$harga','$qty','$satuan','$subtotal','$idnota')");
header("location:barang.php");

 ?>