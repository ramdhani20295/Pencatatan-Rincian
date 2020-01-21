<?php 
session_start();
include 'admin/config.php';
$uname=$_POST['uname'];
$pass=$_POST['pass'];
$pas=md5($pass);
$query=mysql_query("select * from user where uname='$uname' and pass='$pas'")or die(mysql_error());
if(mysql_num_rows($query)==1){
	$data = mysql_fetch_assoc($query);
	$_SESSION['uname']=$uname;
	if($data['level']=="admin"){
	header("location:admin/index.php");
	}else{
	header("location:user/index.php");
	}
}else{
	header("location:index.php?pesan=gagal")or die(mysql_error());
	// mysql_error();
}
// echo $pas;
	
 ?>