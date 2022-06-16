<?php 
include 'koneksi.php';
$id = $_POST['id']; 
$file = $_POST['file'];
 
$rand = rand();
$ekstensi =  array('pptx','docx','pdf');
$filename = $_FILES['file']['name'];
$ukuran = $_FILES['file']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
 
if(!in_array($ext,$ekstensi) ) {
	header("location:coba.php?alert=gagal_ekstensi");
}else{
	if($ukuran < 1044070){		
		$xx = $rand.'_'.$filename;
		move_uploaded_file($_FILES['file'].$rand.'_'.$filename);
		mysqli_query($conn, "INSERT INTO upload_file VALUES ('','$file', now())");
		header("location:coba.php?alert=berhasil");
	}else{
		header("location:coba.php?alert=ukuran file terlalu besar");
	}
}
?>