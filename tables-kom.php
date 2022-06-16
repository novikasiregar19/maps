<?php
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    ini_set('max_execution_time', 0);
    date_default_timezone_set('Asia/Jakarta');
    include "koneksi.php"
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
<?php include 'header.php' ?>
<title>Komponen Alat</title>
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
    <div class="col-md-6"><strong class="card-title">KOMPONEN ALAT</strong></div>
    <div class="col-md-6 text-right"><button type="button" class="btn btn-info add-new" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data </button>
</div>
  </div>
                            <?php
                                $id_kom = $_POST['id_kom']; 
                                $id_al = $_POST['id_al'];
                                $nama_kom = $_POST['nama_kom'];
                               
                                if(isset($_POST['tambah'])){
                                   
                                        //tambah
                                        $sql = "INSERT into komponen values (NULL,'$id_al','$nama_kom','1')";
                                        if(mysqli_query($conn, $sql))
                                        {
                                            $nilaihasil = "Records inserted successfully.";
                                            ///
                                            $nilaiuser = "User $username menambah nama komponen $nama_kom";
                                            $sql = "INSERT INTO log_user VALUES ('','$id_login',now(), 'tambah-komponen','$nilaiuser')";
                                            mysqli_query($conn, $sql);
                                            ///
                                        } 
                                        else
                                        {
                                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                                        }
                                    
                                    
                                 }

                                 if($_POST['edit']){
                                    $sql_edit = "UPDATE komponen SET nama_kom = '$nama_kom', id_al = '$id_al' WHERE id_kom = '$id_kom'";
                                    if(mysqli_query($conn, $sql_edit))
                                    {
                                        $nilaihasil = "Records updated successfully.";
                                        ///
                                        $nilaiuser = "User $username mengubah nama komponen menjadi $nama_kom";
                                        $sql = "INSERT INTO log_user VALUES ('','$id_login',now(), 'edit-komponen','$nilaiuser')";
                                        mysqli_query($conn, $sql);
                                        ///
                                    } 
                                    else
                                    {
                                        echo "ERROR: Could not able to execute $sql_edit. " . mysqli_error($conn);
                                    }
                                }

                                if(isset($_POST['hapus']))
                                {
                                    //delete
                                        $sql = "DELETE FROM komponen WHERE id_kom = '$id_kom'";
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
                                    $sql = "UPDATE komponen SET status_kom = '1' WHERE id_kom = '$id_kom'";
                                    if(mysqli_query($conn, $sql))
                                    {
                                        $nilaihasil = "Records updated successfully.";
                                         ///
                                        $nilaiuser = "User $username mengubah status $nama_kom menjadi aktif";
                                        $sql = "INSERT INTO log_user VALUES ('','$id_login',now(), 'edit-status','$nilaiuser')";
                                        mysqli_query($conn, $sql);
                                        ///
                                    }
                                    else
                                    {
                                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                                    }
                                }
    
                                if(isset($_POST['statusdis'])){
                                    $sql = "UPDATE komponen SET status_kom = '0' WHERE id_kom = '$id_kom'";
                                    if(mysqli_query($conn, $sql))
                                    {
                                        $nilaihasil = "Records updated successfully.";
                                        ///
                                        $nilaiuser = "User $username mengubah status $nama_kom menjadi tidak aktif";
                                        $sql = "INSERT INTO log_user VALUES ('','$id_login',now(), 'edit-status','$nilaiuser')";
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
                                        <th scope="col">Komponen</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql="SELECT * FROM komponen, alat WHERE komponen.id_al=alat.id_al";
                                        $result=mysqli_query($conn,$sql);
                                        if(!$conn){
                                            die("Could not connect to the database".mysqli_connect_error());
                                        }
                                        while($row=mysqli_fetch_array($result)){
                                    ?>
                                   
                                    <tr>
                                        
                                        <td><?= $row['nama_kom']; ?></td>
                                        <td><?php
                                        if($row['status_kom'] == "0")
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
                                        if($row['status_kom'] == 1)
                                    {
                                        ?>
                                            <a href="#edit<?php echo $row['id_kom']?>" data-toggle="modal"><i class="fa fa-pencil"></i></a>
                                            <a href="#status<?php echo $row['id_kom']?>" data-toggle="modal"><i class="fa fa-toggle-on"></i></a>
                                       <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <a href="#status<?php echo $row['id_kom']?>" data-toggle="modal"><i class="fa fa-toggle-off"></i></a>
                                        <?php
                                    }
                                    ?>
                                            
                                        </td>
                                    </tr>
                            <div id="edit<?php echo $row['id_kom']?>" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Komponen Alat</h4>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                           
                                            <div class="form-group">
                                            <label class="control-table" for="id_alat">Nama Alat</label>
                                            <select name="id_al" id="alat" class="form-control" required>
                                            <option value="<?= $row['id_al']; ?>"><?= $row['nama_alat']; ?></option>
                                                <?php
                                                    $sql_alat = mysqli_query($conn, "SELECT * FROM alat ") or die
                                                            (mysqli_error($conn));
                                                    while($alat = mysqli_fetch_array($sql_alat)) {
                                                    echo '<option value="'.$alat['id_al'].'">' 
                                                    .$alat['nama_alat'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-table" for="nama_kom">Nama Komponen Alat</label>
                                                <input type="text" name="nama_kom" value="<?php echo $row['nama_kom']?>" class="form-control" id="nama_kom" autocomplete="off" required>
                                            </div>

                                            <div class="modal-footer">
                                            <input type="hidden" name="id_kom" value="<?php echo $row['id_kom']?>" class="form-control" id="id_kom">
                                                <button type="reset" class="btn btn-danger">Reset</button>
                                                <input type="submit" class="btn btn-success" name="edit" value="Simpan">
                                            </div>
                                        </div>
                                    </form>
                                   
                                </div>
                            </div>
                        </div>

                        <div id="hapus<?php echo $row['id_kom']?>" class="modal fade" role="dialog">        
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Hapus Komponen Alat</h4>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                            Yakin nih Hapus <?php echo $row['nama_kom']?> ?

                                            <div class="modal-footer">
                                            <input type="hidden" name="id_kom" value="<?php echo $row['id_kom']?>" class="form-control" id="id_kom">
                                                <input type="submit" class="btn btn-success" name="hapus" value="Hapus">
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>


                        <div id="status<?php echo $row['id_kom']?>" class="modal fade" role="dialog">        
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Status Komponen Alat</h4>
                                    </div>
                                    
                                    <?php
                                    if($row['status_kom'] == 0)
                                    {
                                    ?>
                                    <form action="" method="post">
                                    <div class="modal-body">
                                    Aktifkan <?php echo $row['nama_kom']?> ?

                                    <div class="modal-footer">
                                    <input type="hidden" name="nama_kom" value="<?php echo $row['nama_kom']?>" class="form-control" id="nama_kom" autocomplete="off" required>
                                    <input type="hidden" name="id_kom" value="<?php echo $row['id_kom']?>" class="form-control" id="id_kom">
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
                                    Disable <?php echo $row['nama_kom']?> ?

                                    <div class="modal-footer">     
                                    <input type="hidden" name="nama_kom" value="<?php echo $row['nama_kom']?>" class="form-control" id="nama_kom" autocomplete="off" required>
      
                                    <input type="hidden" name="id_kom" value="<?php echo $row['id_kom']?>" class="form-control" id="id_kom">
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
                                        <h4 class="modal-title">Tambah Komponen Alat</h4>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                          
                                            <div class="form-group">
                                                <label class="control-table" for="nama_alat">Nama Alat</label>
                                                <select name="id_al" id="alat" class="form-control" required>
                                                <option value="">-Pilih Alat-</option>
                                                    <?php
                                                        $sql_alat = mysqli_query($conn, "SELECT * FROM alat ") or die
                                                                (mysqli_error($conn));
                                                        while($alat = mysqli_fetch_array($sql_alat)) {
                                                        echo '<option value="'.$alat['id_al'].'">' 
                                                        .$alat['nama_alat'].'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-table" for="nama_kom">Komponen Alat</label>
                                                <input type="text" name="nama_kom" class="form-control" id="nama_kom" autocomplete="off" required>
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
