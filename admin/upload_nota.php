<?php 
include 'config.php';
if($_POST['upload']){
    if(!isset($_FILES['file']['tmp_name'])){
        echo '<span style="color:red"><b><u><i>Pilih file gambar</i></u></b></span>';
    }
    else
    {
        $file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];
        if ($file_size < 2048000 and ($file_type =='image/jpeg' or $file_type == 'image/png'))
        {
            $image   = addslashes(file_get_contents($_FILES['file']['tmp_name']));
            $query = mysql_query("INSERT INTO nota ( gambar,nama_gambar,type_gambar,ukuran_gambar) VALUES ('$image','$file_name','$file_type','$file_size')");
            if($query){
                header("location:barang.php?pesan=oke");
					}else{
						echo 'GAGAL MENGUPLOAD GAMBAR';
            }
        }
        else
        {
            echo '<span style="color:red"><b><u><i>Ukuruan File / Tipe File Tidak Sesuai</i></u></b></span>';
        }
    }
}
// $user=$_POST['user'];
// $foto=$_FILES['foto']['name'];

// // move_uploaded_file($_FILES['foto']['tmp_name'], "foto/".$_FILES['foto']['name'])or die();
// // 	mysql_query("update admin set foto='$foto' where uname='$user'");


// $u=mysql_query("select * from nota where nota='$user'");
// $us=mysql_fetch_array($u);
// if(file_exists("foto/".$us['foto'])){
// 	unlink("foto/".$us['foto']);
// 	move_uploaded_file($_FILES['foto']['tmp_name'], "foto/".$_FILES['foto']['name']);
// 	mysql_query("update nota set foto='$foto' where nota='$user'");
// 	header("location:barang.php?pesan=oke");
// }else{
// 	move_uploaded_file($_FILES['foto']['tmp_name'], "foto/".$_FILES['foto']['name']);
// 	mysql_query("update nota set foto='$foto' where nota='$user'");
// 	header("location:barang.php?pesan=oke");
// }
?>