<?php 
include 'config.php';
$id=$_POST['id'];
$tanggal=$_POST['tanggal'];
$nama=$_POST['nama'];
$suplier=$_POST['suplier'];
$harga=$_POST['harga'];
$qty=$_POST['qty'];
$satuan=$_POST['satuan'];

mysql_query("update barang set tanggal='$tanggal', nama='$nama', suplier='$suplier', harga='$harga', qty='$qty', satuan='$satuan' where id='$id'");
header("location:barang.php");

?>