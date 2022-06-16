<?php
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    ini_set('max_execution_time', 0);
    date_default_timezone_set('Asia/Jakarta');
    include "koneksi.php"
?>

<!doctype html>
<!--
     <a href="#hapus<?php //echo $row['id_kar']?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
    [if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <?php include 'header.php' ?>
    <title>Data User</title>
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
    <div class="col-md-6"><strong class="card-title">USER</strong></div>
    <div class="col-md-6 text-right"><button type="button" class="btn btn-info add-new" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data </button>
</div>
  </div>
                            <?php
                                $id_login = $_POST['id_login']; 
                                $nama_kar = $_POST['nama_kar'];
                                $jabatan = $_POST['jabatan'];
                                $level = $_POST['level'];
                                $username = $_POST['username'];
                                $password = md5("Angkasapura1");

                                

                                 if(isset($_POST['tambah'])){
                                    $sql = "SELECT * FROM login WHERE username = '$username'";
                                    $result = mysqli_query($conn,$sql);
                                    $rowv = mysqli_fetch_array($result);
    
                                    if($rowv)
                                    {
                                        echo "Username sudah ada, ulangi kembali";
                                    }
                                    else
                                    {
    
                                
                                        //tambah
                                        $sql = "INSERT into login values (NULL,'$nama_kar', '$username','$password', '$level','1')";
                                        if(mysqli_query($conn, $sql))
                                        {
                                            $nilaihasil = "Records inserted successfully.";
                                            ///
                                            $nilaiuser = "User $username menambah data user";
                                            $sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'tambah-user','$nilaiuser')";
                                            mysqli_query($conn, $sql);
                                            ///
                                        } 
                                        else
                                        {
                                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                                        }
                                    }
                                    
                                 }

                                 if(isset($_POST['edit'])){
                                    $sql = "SELECT * FROM login WHERE username = '$username'";
                                    $result = mysqli_query($conn,$sql);
                                    $rowv = mysqli_fetch_array($result);
    
                                    if($rowv)
                                    {
                                        echo "Username sudah ada, ulangi kembali";
                                    }
                                    else
                                    {
                                      $sql = "UPDATE login SET username='$username',level= '$level' WHERE id_login = '$id_login'";
                                      if(mysqli_query($conn, $sql))
                                      {
                                          $nilaihasil = "Records updated successfully.";
                                           ///
                                           $nilaiuser = "User $username mengubah level user";
                                           $sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'edit-user','$nilaiuser')";
                                           mysqli_query($conn, $sql);
                                           ///
                                      } 
                                      else
                                      {
                                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                                      }
                                    }
                                }

                                if(isset($_POST['reset'])){
                                    $sql = "UPDATE login SET password = '$password' WHERE id_login = '$id_login'";
                                    if(mysqli_query($conn, $sql))
                                    {
                                        $nilaihasil = "Records updated successfully.";
                                        ///
                                        $nilaiuser = "User $username mereset password";
                                        $sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'reset-pass','$nilaiuser')";
                                        mysqli_query($conn, $sql);
                                        ///
                                    } 
                                    else
                                    {
                                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                                    }
                              }

                                if(isset($_POST['hapus']))
                                {
                                    //delete
                                        $sql = "DELETE FROM login WHERE id_login = '$id_login'";
                                        if(mysqli_query($conn, $sql))
                                        {
                                            $nilaihasil = "Records deleted successfully.";
                                        } 
                                        else
                                        {
                                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                                        }
                              }

                              if(isset($_POST['status'])){
                                $sql = "UPDATE login SET status = '1' WHERE id_login = '$id_login'";
                                if(mysqli_query($conn, $sql))
                                {
                                    $nilaihasil = "Records updated successfully.";
                                    ///
                                    $nilaiuser = "User $username mengubah status $nama_kar menjadi aktif";
                                    $sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'edit-user','$nilaiuser')";
                                    mysqli_query($conn, $sql);
                                    ///
                                } 
                                else
                                {
                                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                                }
                          }

                            if(isset($_POST['statusdis'])){
                                $sql = "UPDATE login SET status = '0' WHERE id_login = '$id_login'";
                                if(mysqli_query($conn, $sql))
                                {
                                    $nilaihasil = "Records updated successfully.";
                                    ///
                                    $nilaiuser = "User $username mengubah status $nama_kar menjadi tidak aktif";
                                    $sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'edit-user','$nilaiuser')";
                                    mysqli_query($conn, $sql);
                                    ///
                                } 
                                else
                                {
                                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                                }
                        }                        
                            ?>
                            
                        </div>
       
            <?php echo "$nilaihasil"; ?>

            <table id="tabel-data" class="table table-striped table-hover">
                                
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Karyawan</th>
                                        <th scope="col">Jabatan</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql="SELECT * FROM karyawan,login WHERE karyawan.id_kar = login.id_kar";
                                        $result=mysqli_query($conn,$sql);
                                        if(!$conn){
                                            die("Could not connect to the database".mysqli_connect_error());
                                        }
                                        while($row=mysqli_fetch_array($result)){
                                    ?>
                                    <tr>
                                        <td><?= $row['nama_kar']; ?></td>
                                        <td><?= $row['jabatan']; ?></td>
                                        <td><?= $row['username']; ?></td>
                                        <td>******</td>
                                        <td><?php 
                                        if($row['level'] == "1")
                                        {
                                            $levelnub = "SuperAdmin";
                                        }
                                        if($row['level'] == "2")
                                        {
                                            $levelnub = "Manager/Leader";
                                        }
                                        if($row['level'] == "3")
                                        {
                                            $levelnub = "Supervisor";
                                        }
                                        if($row['level'] == "4")
                                        {
                                            $levelnub = "Teknisi";
                                        }
                                        echo "$levelnub";
                                        ?></td>
                                        <td><?php
                                        if($row['status'] == "0")
                                        {
                                            $nilaistatus = "Disable";
                                        } 
                                        else
                                        {
                                            $nilaistatus = "Aktif";
                                        }
                                        echo "$nilaistatus";
                                        ?></td>
                                        <td>
                                        <?php
                                        if($row['status'] == 1)
                                    {
                                        ?>
                                            <a href="#edit<?php echo $row['id_login']?>" data-toggle="modal"><i class="fa fa-pencil"></i></a>
                                            <a href="#status<?php echo $row['id_login']?>" data-toggle="modal"><i class="fa fa-toggle-on"></i></a>
                                            <a href="#reset<?php echo $row['id_login']?>" data-toggle="modal"><font color = "green">Reset Password</a>
                                          
                                      <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <a href="#status<?php echo $row['id_login']?>" data-toggle="modal"><i class="fa fa-toggle-off"></i></a>
                                        <?php
                                    }
                                    ?>
                                            
                                        </td>
                                    </tr>

                                    <div id="edit<?php echo $row['id_login']?>" class="modal fade" role="dialog">        
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Edit Level</h4>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                    
                                                       <div class="form-group">
                                                            <label class="control-table" for="username">Username</label>
                                                            <input type="text" name="username" value="<?php echo $row['username']?>" class="form-control" id="username" autocomplete="off" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-table" for="level">Level</label>
                                                            <select name="level" id="level" class="form-control" required>
                                                               <?php
                                                               $id_loginv = $row['id_login'];
                                                                    $sql_level=mysqli_query($conn, "SELECT * FROM login WHERE id_login = '$id_loginv'") or die
                                                                                (mysqli_error($conn));
                                                                    $level = mysqli_fetch_array($sql_level);
                                                                    if($level['level'] == "1")
                                                                    {
                                                                        $levelnu = "SuperAdmin";
                                                                    }
                                                                    if($level['level'] == "2")
                                                                    {
                                                                        $levelnu = "Manager/Leader";
                                                                    }
                                                                    if($level['level'] == "3")
                                                                    {
                                                                        $levelnu = "Supervisor";
                                                                    }
                                                                    if($level['level'] == "4")
                                                                    {
                                                                        $levelnu = "Teknisi";
                                                                    }
                                                                        ?>
                                                                        <option value="<?=$level['level']?>">- <?php echo $levelnu; ?> -</option>
                                                                    <?php
                                                                    
                                                                    
                                                                ?>
                                                                        <option value="1">SuperAdmin</option>
                                                                        <option value="2">Manager/leader</option>
                                                                        <option value="3">Supervisor</option>
                                                                        <option value="4">Teknisi</option>
                                                            </select>
                                                        </div>

                                                        <div class="modal-footer">
                                                        <input type="hidden" name="id_login" value="<?php echo $row['id_login']?>" class="form-control" id="id_login">
                                                            <input type="submit" class="btn btn-success" name="edit" value="Submit">

                                                        </div>
                                                    </div>
                                                </form>
                                            
                                            </div>
                                        </div>
                                    </div>

                                    <div id="reset<?php echo $row['id_login']?>" class="modal fade" role="dialog">        
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Reset Password</h4>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                    
                                                       <div class="form-group">
                                                            <label class="control-table" for="username">Username</label>
                                                            <input type="text" name="username" value="<?php echo $row['username']?>" class="form-control" id="username" disabled>
                                                        </div>

                                                        <hr>
                                                        ** Password Reset : Angkasapura1
                                                        <div class="modal-footer">
                                                        <input type="hidden" name="id_login" value="<?php echo $row['id_login']?>" class="form-control" id="id_login">
                                                            <input type="submit" class="btn btn-success" name="reset" value="Reset Password">

                                                        </div>
                                                    </div>
                                                </form>
                                            
                                            </div>
                                        </div>
                                    </div>

                                    <div id="hapus<?php echo $row['id_kar']?>" class="modal fade" role="dialog">        
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Hapus Data Karyawan</h4>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        Yakin nih Hapus <?php echo $row['nama_karyawan']?> ?

                                                        <div class="modal-footer">
                                                        <input type="hidden" name="id_kar" value="<?php echo $row['id_kar']?>" class="form-control" id="id_kar">
                                                            <input type="submit" class="btn btn-success" name="hapus" value="Hapus">
                                                    </div>
                                                    </div>
                                                </form>
                                            
                                            </div>
                                        </div>
                                    </div>

                                    <div id="status<?php echo $row['id_login']?>" class="modal fade" role="dialog">        
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Status Karyawan</h4>
                                                </div>
                                                
                                                <?php
                                                if($row['status'] == 0)
                                                {
                                                ?>
                                                <form action="" method="post">
                                                <div class="modal-body">
                                                Aktifkan <?php echo $row['nama_kar']?> ?

                                                <div class="modal-footer">
                                                <input type="hidden" name="id_login" value="<?php echo $row['id_login']?>" class="form-control" id="id_login">
                                                    <input type="submit" class="btn btn-success" name="status" value="Aktif">
                                            </div>
                                            </div>      
                                            </form>                        
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <form action="" method="post">
                                                    <div class="modal-body">
                                                Disable <?php echo $row['nama_kar']?> ?

                                                <div class="modal-footer">           
                                                <input type="hidden" name="id_login" value="<?php echo $row['id_login']?>" class="form-control" id="id_login">
                                                    <input type="submit" class="btn btn-success" name="statusdis" value="Disable">
                                            </div>
                                            </div>
                                            </form>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                            <?php } ?>
                                                
                                            </tbody>
                                        </table>

                                    <div id="tambah" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Tambah Data Karyawan</h4>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">

                                                        <div class="form-group">
                                                            <label class="control-table" for="nama_kar">Nama Karyawan</label>
                                                                <select name="nama_kar" id="nama_kar" class="form-control" required>
                                                                <option value="">-Pilih Nama Karyawan-</option>
                                                                    <?php
                                                                        $sql_kar = mysqli_query($conn, "SELECT * FROM karyawan ") or die
                                                                                (mysqli_error($conn));
                                                                        while($karyawan = mysqli_fetch_array($sql_kar)) {
                                                                        echo '<option value="'.$karyawan['id_kar'].'">' 
                                                                        .$karyawan['nama_kar'].'</option>';
                                                                        }
                                                                    ?>
                                                                </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-table" for="level">Level</label>
                                                            <select name="level" id="level" class="form-control" required>
                                                               
                                                                        <option value="1">SuperAdmin</option>
                                                                        <option value="2">Manager/leader</option>
                                                                        <option value="3">Supervisor</option>
                                                                        <option value="4">Teknisi</option>
                                                                   
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-table" for="username">Username</label>
                                                            <input type="text" name="username" value="<?php echo $row['username']?>" class="form-control" id="username" autocomplete="off" required>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="reset" class="btn btn-danger">Reset</button>
                                                            <input type="submit" class="btn btn-success" name="tambah" value="Simpan">
                                                        </div>
                                                        </form>
                                            
                                            </div>
                                        </div>
                                    </div>
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
</body>

</html>

