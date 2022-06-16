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
       ?>
       <?php
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    ini_set('max_execution_time', 0);
    date_default_timezone_set('Asia/Jakarta');
    include "koneksi.php"
?>

<!doctype html>
<!--
     <a href="#hapus<?php //echo $row['id_al']?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
    [if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <?php include 'header.php' ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
</script>
    
    
</head>

<body class="sb-nav-fixed">
    <?php include 'menu.php' ?>
        <!-- Header-->
        <div class="content">
        <center><img width="400px" height="400px" src="images/logoangpur.png"></center>
</div><!-- .content -->  

<?php
// Close connection
mysqli_close($conn);
?>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="jquery.tabledit.min.js"></script>

</body>

</html>

<?php
     }
?>