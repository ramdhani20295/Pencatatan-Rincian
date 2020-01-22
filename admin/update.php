<?php 
include 'config.php';
$id=$_POST['id'];
$tanggal=$_POST['tanggal'];
$nama=$_POST['nama'];
$harga=$_POST['harga'];
$qty=$_POST['qty'];
$idnota = $_POST['nota_idnota'];
$satuan=$_POST['satuan'];

mysql_query("update barang set tanggal='$tanggal', nama='$nama', harga='$harga', qty='$qty', satuan='$satuan' ,nota_idnota'$idnota' where id='$id'");
header("location:barang.php");

?>