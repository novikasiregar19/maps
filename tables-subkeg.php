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
    <title>Data Komponen</title>
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

<body>
    <?php include 'menu.php' ?>
        <!-- Header-->
<?php
//
  $id_po = $_GET['id_po'];
  $nama_po = $_GET['nama_po'];
  $nama_pempo = $_GET['nama_pempo'];
  $nama_alpo = $_GET['nama_alpo'];
  $id_alpo = $_GET['id_alpo'];
  $id_kpo = $_GET['id_kpo'];

  //
?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="col-lg-12">
                <a href="tables-pem.php"><i class="fa fa-chevron-left"></i> Back</a>
                    <div class="card">
                        <div class="card-header">
                        <div class="row">
                        <div class="col-md-6 "><strong class="card-title">KOMPONEN PEMELIHARAAN HARIAN </strong><?php echo"$nama_po  "; ?></div>
    <?php
                                        $sqlx="SELECT * FROM pemeliharaan WHERE id_p=$id_po";
                                        $resultx=mysqli_query($conn,$sqlx);
                                        $fafa = mysqli_num_rows($resultx);
                                        if($fafa <= 1 AND $nama_pempo == "")
                                        {
                                        ?>
<div class="col-md-6 text-right"><button type="button" class="btn btn-info add-new" data-toggle="modal" data-target="#tambahedit"><i class="fa fa-plus"></i> Tambah Data </button>
</div>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
<div class="col-md-6 text-right"><button type="button" class="btn btn-info add-new" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data </button>
</div>

                                       <?php
                                        }
                                        ?>
  </div>
                        
                                <?php
                                $nama_subkeg= $_POST['nama_subkeg'];
                                $id_pox= $_POST['id_po'];
                               
                                 if(isset($_POST['tambah'])){
                                    $sql_tambah = "insert into pemeliharaan values (NULL,'$id_alpo','$id_kpo','$nama_subkeg','1')";
                                     if(mysqli_query($conn, $sql_tambah))
                                     {
                                         $nilaihasil = "Records updated successfully.";
                                         ///
                                        $nilaiuser = "User $username sukses tambah sub kegiatan $nama_subkeg";
                                        $sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'tambah-subkegiatan','$nilaiuser')";
                                        mysqli_query($conn, $sql);
                                        ///
                                     } 
                                     else
                                     {
                                         echo "ERROR: Could not able to execute $sql_tambah. " . mysqli_error($conn);
                                     }
                                 }

                                 if(isset($_POST['tambahedit'])){
                                    $sql_tmbahedit = "UPDATE pemeliharaan SET nama_pem = '$nama_subkeg' WHERE id_p = '$id_po'";
                                    if(mysqli_query($conn, $sql_tmbahedit))
                                    {
                                        $nilaihasil = "Records updated successfully.";
                                        ///
                                        $nilaiuser = "User $username sukses tambah sub kegiatan $nama_subkeg";
                                        $sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'tambah-subkegiatan','$nilaiuser')";
                                        mysqli_query($conn, $sql);
                                        ///
                                        echo "<meta http-equiv='refresh' content='0;url=tables-subkeg.php?id_po=$id_po&&id_alpo=$id_alpo&&id_kpo=$id_kpo&&nama_pempo=$nama_subkeg&&nama_po=$nama_po&&nama_alpo=$nama_alpo'>";
                                    } 
                                    else
                                    {
                                        echo "ERROR: Could not able to execute $sql_tmbahedit. " . mysqli_error($conn);
                                    }
                                 }

                                

                                 if($_POST['edit']){
                                    $sql_edit = "UPDATE pemeliharaan SET nama_pem = '$nama_subkeg' WHERE id_p = '$id_pox'";
                                    if(mysqli_query($conn, $sql_edit))
                                    {
                                        $nilaihasil = "Records updated successfully.";
                                        ///
                                        $nilaiuser = "User $username sukses edit sub kegiatan $nama_subkeg";
                                        $sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'edit-subkegiatan','$nilaiuser')";
                                        mysqli_query($conn, $sql);
                                        ///
                                    } 
                                    else
                                    {
                                        echo "ERROR: Could not able to execute $sql_edit. " . mysqli_error($conn);
                                    }
                                }

                                 if($_GET['delete_pem']){
                                    $id_p=$_GET['delete_pem'];
                                    $queryhapus=mysqli_query($conn, "DELETE FROM pemeliharaan WHERE id_p='$id_p'");
                                 }

                                
                                if(isset($_POST['status'])){
                                    $sql = "UPDATE pemeliharaan SET status_pem = '1' WHERE id_p = '$id_pox'";
                                    if(mysqli_query($conn, $sql))
                                    {
                                        $nilaihasil = "Records updated successfully.";
                                         ///
                                         $nilaiuser = "User $username sukses edit status sub kegiatan $nama_subkeg";
                                         $sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'edit-status-subkegiatan','$nilaiuser')";
                                         mysqli_query($conn, $sql);
                                         ///
                                    } 
                                    else
                                    {
                                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                                    }
                                }

                                if(isset($_POST['statusdis'])){
                                    $sql = "UPDATE pemeliharaan SET status_pem = '0' WHERE id_p = '$id_pox'";
                                    if(mysqli_query($conn, $sql))
                                    {
                                        $nilaihasil = "Records updated successfully.";
                                        ///
                                        $nilaiuser = "User $username sukses edit status sub kegiatan $nama_subkeg";
                                        $sql = "INSERT INTO log_user VALUES ('','$id_login',now(), 'edit-status-subkegiatan','$nilaiuser')";
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
                        
                        <?php
                            echo "$nilaihasil";
                            ?>

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
                                if($fafa <= 1 AND $nama_pempo == "")
                                {

                                }
                                else
                                {
                                    $sqlxc="SELECT * FROM pemeliharaan WHERE id_k=$id_kpo";
                                    $resultxc=mysqli_query($conn,$sqlxc);
                                   while($rowxc=mysqli_fetch_array($resultxc))
                                   {
                                                    
                                    ?>
                                        <tr>
                                        <td><?= $rowxc['nama_pem']; ?></td>
                                       
                                        <td><?php
                                        if($rowxc['status_pem'] == "0")
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
                                        if($rowxc['status_pem'] == 1)
                                        {
                                            ?>
                                            <a href="#edit<?php echo $rowxc['id_p']?>" data-toggle="modal"><i class="fa fa-pencil"></i></a>
                                            <a href="#status<?php echo $rowxc['id_p']?>" data-toggle="modal"><i class="fa fa-toggle-on"></i></a>
                                            <?php
                                        }
                                        else
                                    {
                                        ?>
                                        <a href="#status<?php echo $rowxc['id_p']?>" data-toggle="modal"><i class="fa fa-toggle-off"></i></a>
                                        <?php
                                    }
                                    
                                    ?>
                                            
                                        </td>
                                    </tr>
                                    <div id="edit<?php echo $rowxc['id_p']?>" class="modal fade" role="dialog">
                                    
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Data Komponen</h4>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                            
                                        <div class="form-group">
                                                <label class="control-table" for="nama_alat">Nama Komponen</label>
                                                <input type="text" name="nama_subkeg" class="form-control" id="nama_subkeg" autocomplete="off" value="<?= $rowxc['nama_pem']; ?>" required>
                                            </div>

                                            <div class="modal-footer">
                                            <input type="hidden" name="id_po" value="<?php echo $rowxc['id_p']?>" class="form-control" id="id_k">
                                                <button type="reset" class="btn btn-danger">Reset</button>
                                                <input type="submit" class="btn btn-success" name="edit" value="Simpan">
                                            </div>
                                        </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div id="status<?php echo $rowxc['id_p']?>" class="modal fade" role="dialog">        
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Status Komponen</h4>
                                    </div>
                                      
                                    <?php
                                    if($rowxc['status_pem'] == 0)
                                    {
                                    ?>
                                    <form action="" method="post">
                                    <div class="modal-body">
                                    Aktifkan <?php echo $rowxc['nama_pem']?> ?

                                    <div class="modal-footer">
                                    <input type="hidden" name="nama_subkeg" value="<?php echo $row['nama_subkeg']?>" class="form-control" id="nama_subkeg" autocomplete="off" required>
                                    <input type="hidden" name="id_po" value="<?php echo $rowxc['id_p']?>" class="form-control" id="id_k">
                                    <input type="hidden" name="nama_subkeg" class="form-control" id="nama_subkeg" autocomplete="off" value="<?= $rowxc['nama_pem']; ?>" required>
                                    
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
                                    Disable <?php echo  $rowxc['nama_pem']?> ?

                                    <div class="modal-footer">
                                    <input type="hidden" name="nama_subkeg" value="<?php echo $row['nama_subkeg']?>" class="form-control" id="nama_subkeg" autocomplete="off" required>         
                                    <input type="hidden" name="id_po" value="<?php echo $rowxc['id_p']?>" class="form-control" id="id_k">  
                                    <input type="hidden" name="nama_subkeg" class="form-control" id="nama_subkeg" autocomplete="off" value="<?= $rowxc['nama_pem']; ?>" required>
                                    
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

                                           
                                           
                           <?php

                            }
                        }
                         ?>
                                </tbody>

                            </table>
                         
                         <div id="tambahedit" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Tambah Komponen <?php echo "$nama_po";?></h4>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                        <div class="form-group">
                                                <label class="control-table" for="nama_alat">Nama Komponen</label>
                                                <input type="text" name="nama_subkeg" class="form-control" id="nama_subkeg" autocomplete="off" required>
                                            </div>
                                            
                                            <div class="modal-footer">
                                                <button type="reset" class="btn btn-danger">Reset</button>
                                                <input type="submit" class="btn btn-success" name="tambahedit" value="Simpan">
                                         </div>
                                         </div>
                                    </form>
                                   
                                </div>
                            </div>
                        </div>

                         <div id="tambah" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Tambah Komponen</h4>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                        <div class="form-group">
                                                <label class="control-table" for="nama_alat">Nama Komponen</label>
                                                <input type="text" name="nama_subkeg" class="form-control" id="nama_subkeg" autocomplete="off" required>
                                            </div>
                                            
                                            <div class="modal-footer">
                                                <button type="reset" class="btn btn-danger">Reset</button>
                                                <input type="submit" class="btn btn-success" name="tambah" value="Simpan">
                                         </div>
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