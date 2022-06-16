<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($conn,"SELECT * FROM login WHERE username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){

	$data = mysqli_fetch_assoc($login);

	// cek jika user login sebagai admin
	if($data['level']=="teknisi"){

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "teknisi";
		// alihkan ke halaman dashboard admin
		header("location:");

	// cek jika user login sebagai pegawai
	}else if($data['level']=="spv"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "spv";
		// alihkan ke halaman dashboard pegawai
		header("location:");

	// cek jika user login sebagai pengurus
	}else if($data['level']=="lead"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "lead";
		// alihkan ke halaman dashboard pengurus
		header("location: ");

	}else if($data['level']=="superadmin"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "superadmin";
		// alihkan ke halaman dashboard pengurus
		header("location:report.php");

	}
    
    else{

		// alihkan ke halaman login kembali
		header("location:login.php?pesan=gagal");
	}	
}else{
	header("location:login.php?pesan=gagal");
}

?>