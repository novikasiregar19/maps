<?php
include "koneksi.php";
    session_start();
    $id_login = $_SESSION['id_login'];
    $id_kar = $_SESSION['id_kar'];
    $username = $_SESSION['username'];
	$password = $_SESSION['password'];
	$level = $_SESSION['level'];
	$status = $_SESSION['status'];
    $sql = "SELECT * FROM login WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $id_login = $row['id_login'];
	$id_kar = $row['id_kar'];
	$username = $row['username'];
	$password = $row['password'];
    $level = $row['level'];
    $status = $row['status'];
    $count = mysqli_num_rows($result);
   if(!isset($_SESSION['id_login'])){
      header("location:login/login.php");
   }
   else {
       
     }
?>