<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
ini_set('max_execution_time', 0);
date_default_timezone_set('Asia/Jakarta');
   include "../koneksi.php";
   session_start();

   if(isset($_POST['submit'])){
      // username dan password didapat dari form

    $myusername = $_POST['username'];
    $mypassword = md5($_POST['password']);
    $sql = "SELECT id_login, id_kar, username, password, level, status FROM login WHERE username = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
	$id_login = $row['id_login'];
	$id_kar = $row['id_kar'];
	$username = $row['username'];
	$password = $row['password'];
    $level = $row['level'];
    $status = $row['status'];
    $count = mysqli_num_rows($result);
      // Jika hasil sesuai $myusername dan $mypassword, table row harus 1
      if($row)
			{
        if($status == 1 )
  			{
        $_SESSION['id_login'] = $id_login;
        $_SESSION['id_kar'] = $id_kar;
        $_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$_SESSION['level'] = $level;
		$_SESSION['status'] = $status;
        header("location: ../dashboard.php");
          $errord = 0;
        }
        else {
          $error = "Akun sudah tidak aktif";
          $errord = 1;
        }
      }
			else
			{

					$error = "Your login invalid";
         			$errord = 2;
				
         
      }
   }
	 else
	 {
	 	$error = "";
    $errord = 3;
	 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>MaPS (Maintenance and Prevention System)</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/M2.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
			<form action="" method="post">
					
			<center><img src="images/icons/M2.png" width="50%">
			<br>
						<h5>Maintenance and Prevention System<h5>
						<br>
						
						</center>
					
					<?php
					//JIKA LOGIN SUKSES - SET LOG
					if($errord == "0")
					{
						$aktivitas = $myusername.";;".$mypassword.";;Login Sukses";
						echo '<div class="alert alert-danger" role="alert">';
						echo "Akun Anda sudah tidak aktif, hubungi ICT atau IT support";
						echo '</div>';
						$sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'Login','$aktivitas')";
						mysqli_query($conn, $sql);
					}
					//JIKA LOGIN GAGAL - SET LOG
					if($errord == "1")
					{
						$aktivitas = $myusername.";;".$mypassword.";;Login Gagal;;Akun tidak aktif";
						echo '<div class="alert alert-danger" role="alert">';
						echo "Akun Anda sudah tidak aktif, hubungi ICT atau IT support";
						echo '</div>';
						$sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'Login','$aktivitas')";
						mysqli_query($conn, $sql);
					}
					//JIKA LOGIN GAGAL - SET LOG
					if($errord == "2")
					{
						$aktivitas = $myusername.";;".$mypassword.";;Login Gagal;;Invalid user";
							echo '<div class="alert alert-danger" role="alert">';
						echo "Your login invalid";
							echo '</div>';
						$sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'Login','$aktivitas')";
						mysqli_query($conn, $sql);
					}
					?>
					<span class="txt1 p-b-11">
						Username
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
						<input class="input100" type="text" name="username" autocomplete="off" >
						<span class="focus-input100"></span>
					</div>
					
					<span class="txt1 p-b-11">
						Password
					</span>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100" type="password" name="password" >
						<span class="focus-input100"></span>
					</div>
					
					<div class="flex-sb-m w-full p-b-48">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="../install.php" class="txt3">
								Forgot Password?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="submit"> 
							Login
						</button>
					</div>

					
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>