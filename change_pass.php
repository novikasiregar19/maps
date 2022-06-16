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
    <title>Data Alat</title>
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
            <div class="animated fadeIn">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                        <div class="row">
    <div class="col-md-6"><strong class="card-title">Change Password</strong></div>

  </div>
                            
  <?php
        $id_login = $_GET['id_login'];
        $ses_sql = mysqli_query($conn,"SELECT username FROM login WHERE id_login = '$id_login'");
        $row = mysqli_fetch_array($ses_sql);
        $username = $row['username'];

    //proses ganti password
    if (isset($_POST['Ganti'])) {
    $username        = $_POST['username'];
    $password_lama    = md5($_POST['password_lama']);
    $password_baru    = md5($_POST['password_baru']);
    $konf_password    = $_POST['konf_password'];
    //cek old password
    $query = mysqli_query($conn,"SELECT * FROM login WHERE id_login = '$id_login' AND username ='$username' AND password ='$password_lama'");
    $hasil = mysqli_fetch_array ($query);
    if (!$hasil) {
      echo "<font color=red>Ganti Password Gagal, Password Lama Tidak Sesuai</font>";
    }
    //validasi data data kosong
    else if (empty($_POST['password_baru']) || empty($_POST['konf_password'])) {
            echo "<font color=red>Ganti Password Gagal, Data Tidak Boleh Kosong</font>";
    }
    //validasi input konfirm password
    else if (($_POST['password_baru']) != ($_POST['konf_password'])) {
            echo "<font color=red>Ganti Password Gagal, Password dan Konfirm Password Harus Sama</font>";
    }
    else {
    //update data
    $sql = mysqli_query($conn,"UPDATE login SET password='$password_baru' WHERE username = '$username'");
    //setelah berhasil update
    if ($sql) {
        echo "<font color=#8BB2D9>Ganti Password Berhasil , Logout by system 5 Second</font>";
         ///
         $nilaiuser = "user $username mengubah password";
         $sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'Ubah Password','$nilaiuser')";
         mysqli_query($conn, $sql);
         ///
    if(session_destroy()){
        header("Location: login/login.php");
    }
    echo "<meta http-equiv='refresh' content='6;url=dashboard.php'>";

    } else {
        echo "<font color=red>Ganti Password Gagal</font>";
    }
    }
    }
?>
            
            <form action="" method="POST" name="form-ganti-password" enctype="multipart/form-data">
    <table>
        <tr height="36">
            <td >Username </td> <td></td>
            <td><b> <?php echo  $username; ?><input type="hidden" name="username" value="<?php echo $username; ?>"></b></td>
        </tr>
        <tr height="36">
            <td>Password Lama </td><td></td>
            <td><input type="password" name="password_lama" size="30" maxlength="20" id="myInput" required></td>
        </tr>
        <tr height="36">
            <td>Password Baru </td><td></td>
            <td><input type="password" name="password_baru"  size="30" maxlength="20" id="myInput1" required></td>
        </tr>
        <tr height="36">
            <td>Konfirm Password Baru </td><td></td>
            <td><input type="password" name="konf_password"  size="30" maxlength="20" id="myInput2" required></td>
        </tr>
        <tr height="36">
            <td></td><td></td>
            <td><input type="checkbox" onclick="myFunction()"> Show Password</td>
        </tr>
        <tr height="56">
        <td><input type="submit" name="Ganti" value="Submit"></td>
            <td width="4%"> </td>
            <td></td>
        </tr>
    </table>
</form>

                        </div>
                    </div>
                
                        </div>
                
    </div><!-- .animated -->
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
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }

  var xx = document.getElementById("myInput1");
  if (xx.type === "password") {
    xx.type = "text";
  } else {
    xx.type = "password";
  }

  var xxx = document.getElementById("myInput2");
  if (xxx.type === "password") {
    xxx.type = "text";
  } else {
    xxx.type = "password";
  }
}
    </script>

</body>

</html>
