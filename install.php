<?php
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    ini_set('max_execution_time', 0);
    date_default_timezone_set('Asia/Jakarta');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>MaPS (Maintenance and Prevention System)</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="login/images/icons/M2.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
			
					
			<center><img src="login/images/icons/M2.png" width="50%">
			<br>
						<h5>Maintenance and Prevention System<h5>
						<br>
						
						</center>
					Installation for Administrator<br>
					<?php
if(isset($_POST['submit'])){
	
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt create database query execution
$sql = "CREATE DATABASE maps";
if(mysqli_query($link, $sql)){
	echo '<div class="alert alert-success" role="success">';
    echo "Database created successfully	</div>";


// Name of the data file
$filename = 'maps.sql';
// MySQL host
$mysqlHost = 'localhost';
// MySQL username
$mysqlUser = 'root';
// MySQL password
$mysqlPassword = '';
// Database name
$mysqlDatabase = 'maps';

// Connect to MySQL server
$link = mysqli_connect($mysqlHost, $mysqlUser, $mysqlPassword, $mysqlDatabase) or die('Error connecting to MySQL Database: ' . mysqli_error());


$tempLine = '';
// Read in the full file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line) {

    // Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;

    // Add this line to the current segment
    $tempLine .= $line;
    // If its semicolon at the end, so that is the end of one query
    if (substr(trim($line), -1, 1) == ';')  {
        // Perform the query
        mysqli_query($link, $tempLine) or print("Error in " . $tempLine .":". mysqli_error());
        // Reset temp variable to empty
        $tempLine = '';
    }
}
echo '<div class="alert alert-success" role="success">';
 echo "Tables imported successfully	</div>";

} 
else{
	echo '<div class="alert alert-danger" role="danger">';
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	echo '</div>';
}

include "koneksi.php";
	$myusername = $_POST['username'];
    $password = $_POST['password'];
	$mypassword = md5($_POST['password']);
	
    $sql = "SELECT * FROM login WHERE username = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
	if($row)
	{
		echo '<div class="alert alert-danger" role="danger">';
		echo "User sudah ada";
		echo '</div>';
	}
	else
	{
//tambah
$sql = "INSERT into login values (NULL,'', '$myusername','$mypassword', '1','1')";
if(mysqli_query($conn, $sql))
{
	///
	$nilaiuser = "Set Administrator";
	$sql = "INSERT INTO log_user VALUES (NULL,'',now(), 'tambah-user','$nilaiuser')";
	mysqli_query($conn, $sql);
	echo '<div class="alert alert-success" role="success">';
  echo "Database created successfully <br>Username : $myusername <br> Pass : $password <br> Login <a href='login/login.php'>Here</a>";
  echo '</div>';
	///
} 
else
{
	echo '<div class="alert alert-danger" role="danger">';
	echo "Administrator Already Exists <br>
	Please Login <a href='login/login.php'>Here</a>";
	echo '</div>';
	
}
	}


  
// Close connection
mysqli_close($link);
  
   }
   else
   {

   }


   
?>
<br>
<form action="" method="post">
					<span class="txt1 p-b-11">
						Create Username
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
						<input class="input100" type="text" name="username" autocomplete="off" required>
						<span class="focus-input100"></span>
					</div>
					
					<span class="txt1 p-b-11">
						Create Password
					</span>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100" type="password" name="password" required>
						<span class="focus-input100"></span>
					</div>
					
					

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="submit"> 
							Install
						</button>
					</div>

					
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/bootstrap/js/popper.js"></script>
	<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/daterangepicker/moment.min.js"></script>
	<script src="login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="login/js/main.js"></script>

</body>
</html>