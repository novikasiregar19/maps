<?php
    session_start();

    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    ini_set('max_execution_time', 0);
    date_default_timezone_set('Asia/Jakarta');
    include "koneksi.php";

    ///
    $usernamex = $_GET['username'];
    $id_loginx = $_GET['id_login'];
    $nilaiuser = "user $usernamex logout";
    $sql = "INSERT INTO log_user VALUES (NULL,'$id_loginx',now(), 'Logout','$nilaiuser')";
    mysqli_query($conn, $sql);
    ///
    
    if(session_destroy()){
        header("Location: login/login.php");
    }

?>