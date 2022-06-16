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
    <title>Data Pemeliharaan</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

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
    <div class="col-md-6"><strong class="card-title">PEMELIHARAAN HARIAN</strong></div>
    <div class="col-md-6 text-right"><button type="button" class="btn btn-info add-new" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data </button>
</div>
  </div>
                        
  <?php
                                $id_p = $_POST['id_p'];
                                $id_al = $_POST['id_al'];
                                $id_k = $_POST['id_k']; 
                                $nama_pem = $_POST['nama_pem'];
                               
                                 if(isset($_POST['tambah'])){

                                    $sqlx="SELECT *
                                        FROM pemeliharaan
                                        WHERE id_k = '$id_k' AND id_al = '$id_al'";
                                        $resultx=mysqli_query($conn,$sqlx);
                                        $fafac = mysqli_fetch_array($resultx);
                                        if($fafac)
                                        {
                                            $nilaihasil = "Pemeliharaan Sudah Ada.";

                                              ///
                                              $nilaiuser = "User $username gagal menambah pemeliharaan harian";
                                              $sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'tambah-pemeliharaan','$nilaiuser')";
                                              mysqli_query($conn, $sql);
                                              ///

                                        }
                                        else{
                                                    $sql_tambah = "INSERT INTO pemeliharaan VALUES (NULL,'$id_al','$id_k','','1')";
                                                    if(mysqli_query($conn, $sql_tambah))
                                                    {
                                                        $nilaihasil = "Records updated successfully.";

                                                        ///
                                              $nilaiuser = "User $username sukses menambah pemeliharaan harian";
                                              $sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'tambah-pemeliharaan','$nilaiuser')";
                                              mysqli_query($conn, $sql);
                                              ///
                                                    } 
                                                    else
                                                    {
                                                        echo "ERROR: Could not able to execute $sql_tambah. " . mysqli_error($conn);
                                                    }
                                        }
                                    
                                 }

                                

                                 if($_POST['edit']){
                                    $sqlx="SELECT *
                                    FROM pemeliharaan
                                    WHERE id_k = '$id_k' AND id_al = '$id_al'";
                                    $resultx=mysqli_query($conn,$sqlx);
                                    $fafac = mysqli_fetch_array($resultx);
                                    if($fafac)
                                    {
                                        $nilaihasil = "Pemeliharaan Sudah Ada.";
                                        ///
                                        $nilaiuser = "User $username gagal edit pemeliharaan harian";
                                        $sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'edit-pemeliharaan','$nilaiuser')";
                                        mysqli_query($conn, $sql);
                                        ///
                                    }
                                    else{
                                    $sql_edit = "UPDATE pemeliharaan SET id_al = '$id_al', id_k = '$id_k' , nama_pem = '$nama_pem' WHERE id_p = '$id_p'";
                                    if(mysqli_query($conn, $sql_edit))
                                    {
                                        $nilaihasil = "Records updated successfully.";
                                        ///
                                        $nilaiuser = "User $username sukses edit pemeliharaan harian";
                                        $sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'edit-pemeliharaan','$nilaiuser')";
                                        mysqli_query($conn, $sql);
                                        ///
                                    } 
                                    else
                                    {
                                        echo "ERROR: Could not able to execute $sql_edit. " . mysqli_error($conn);
                                    }
                                }
                                }

                                if($_POST['editsemua']){
                                    $id_allam= $_POST['id_allam'];
                                    $id_klam= $_POST['id_klam'];
                                    $sqlx="SELECT *
                                    FROM pemeliharaan
                                    WHERE id_k = '$id_k' AND id_al = '$id_al'";
                                    $resultx=mysqli_query($conn,$sqlx);
                                    $fafac = mysqli_fetch_array($resultx);
                                    if($fafac)
                                    {
                                        $nilaihasil = "Pemeliharaan Sudah Ada.";
                                        ///
                                        $nilaiuser = "User $username gagal edit pemeliharaan harian";
                                        $sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'edit-pemeliharaan','$nilaiuser')";
                                        mysqli_query($conn, $sql);
                                        ///
                                    }
                                    else{
                                    $sql_edit = "UPDATE pemeliharaan SET id_al = '$id_al', id_k = '$id_k' WHERE id_k = '$id_klam' AND id_al = '$id_allam'";
                                    if(mysqli_query($conn, $sql_edit))
                                    {
                                        $nilaihasil = "Records updated successfully.";
                                        ///
                                        $nilaiuser = "User $username sukses edit pemeliharaan harian";
                                        $sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'edit-pemeliharaan','$nilaiuser')";
                                        mysqli_query($conn, $sql);
                                        ///
                                    } 
                                    else
                                    {
                                        echo "ERROR: Could not able to execute $sql_edit. " . mysqli_error($conn);
                                    }
                                }
                                }

                                if($_POST['hapussemua']){
                                    $id_allam= $_POST['id_allam'];
                                    $id_klam= $_POST['id_klam'];
                                    $queryhapus=mysqli_query($conn, "DELETE FROM pemeliharaan WHERE id_al='$id_allam' AND id_k='$id_klam'");
                                    $nilaihasil = "Deleted Row.";
                                        ///
                                        $nilaiuser = "User $username menghapus pemeliharaan harian";
                                        $sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'hapus-pemeliharaan','$nilaiuser')";
                                        mysqli_query($conn, $sql);
                                        ///
                                }                 
                                ?>
                        </div>
                        <?php
                            echo "$nilaihasil";
                            ?>

                        <table id="tabel-data" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Alat</th>
                                        <th scope="col">Kegiatan</th>
                                        <th scope="col">Komponen</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // $sql="SELECT pemeliharaan.id_p,pemeliharaan.status_pem,pemeliharaan.nama_pem,kegiatan.nama_keg,alat.nama_alat,pemeliharaan.id_keg,pemeliharaan.id_alat
                                        $sqlx="SELECT DISTINCT pemeliharaan.id_al
                                        FROM pemeliharaan, kegiatan, alat
                                        WHERE pemeliharaan.id_k=kegiatan.id_k AND pemeliharaan.id_al=alat.id_al";
                                        $resultx=mysqli_query($conn,$sqlx);
                                        

                                                    while($rowx=mysqli_fetch_array($resultx))
                                                    {
                                                    $id_alx = $rowx['id_al']; 
                                                    // echo "$id_kx";

                                                   $sql="SELECT *
                                                    FROM pemeliharaan, kegiatan, alat
                                                    WHERE pemeliharaan.id_k=kegiatan.id_k AND pemeliharaan.id_al=alat.id_al AND pemeliharaan.id_al = $id_alx GROUP BY pemeliharaan.id_k";
                                                    $result=mysqli_query($conn,$sql);
                                                    // echo "$fafa";
                               
                                                    while($row=mysqli_fetch_array($result))
                                                    {
                                    ?>
                                        <tr>
                                        <td><?= $row['nama_alat']; ?></td>
                                        <td><?= $row['nama_keg']; ?></td>
                                       
                                        <td> 
                                        <?php
                                        if($row['nama_pem'] == "")
                                        {
                                            ?>
                                              <a href="tables-subkeg.php?id_po=<?php echo $row['id_p']?>&&id_alpo=<?php echo $row['id_al']?>&&id_kpo=<?php echo $row['id_k']?>&&nama_pempo=<?php echo $row['nama_pem']?>&&nama_po=<?php echo $row['nama_keg']?>&&nama_alpo=<?php echo $row['nama_alat']?>" ><i class="fa fa-plus"></i> Add</a>
                                      
                                          <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <a href="tables-subkeg.php?id_po=<?php echo $row['id_p']?>&&id_alpo=<?php echo $row['id_al']?>&&id_kpo=<?php echo $row['id_k']?>&&nama_pempo=<?php echo $row['nama_pem']?>&&nama_po=<?php echo $row['nama_keg']?>&&nama_alpo=<?php echo $row['nama_alat']?>" > View Komponen</a>
                                      
                                            <?php
                                        }
                                        ?>
                                        
                                        </td>
                                        <td>
                                        <?php
                                        if($row['nama_pem'] == "")
                                        {
                                            ?>
                                              <a href="#edit<?php echo $row['id_p']?>" data-toggle="modal"><i class="fa fa-pencil"></i></a>
                                             <a href="#hapussemua<?php echo $row['id_p']?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                          <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <a href="#editsemua<?php echo $row['id_p']?>" data-toggle="modal"><i class="fa fa-pencil"></i></a>
                                           <a href="#hapussemua<?php echo $row['id_p']?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                           <?php
                                        }
                                        ?>
                                        </td>
                                    </tr>
                                    <div id="edit<?php echo $row['id_p']?>" class="modal fade" role="dialog">
                                    
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Data Pemeliharaan</h4>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                            
                                            <div class="form-group">
                                                <label class="control-table" for="id_alat">Nama Alat</label>
                                                <select name="id_al" id="alat" class="form-control" required>
                                                <option value="<?= $row['id_al']; ?>">--<?= $row['nama_alat']; ?> --</option>
                                                <?php
                                                $sql_alat = mysqli_query($conn, "SELECT * FROM alat") or die
                                                    (mysqli_error($conn));
                                                while($alat = mysqli_fetch_array($sql_alat)) {
                                                    echo '<option value="'.$alat['id_al'].'">' 
                                                    .$alat['nama_alat'].'</option>';
                                                }
                                                ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="kegiatan">Nama Kegiatan</label>
                                                <select name="id_k" id="kegiatan" class="form-control" required>
                                                <option value="<?= $row['id_k']; ?>">--<?= $row['nama_keg']; ?> --</option>
                                                <?php
                                                $sql_keg = mysqli_query($conn, "SELECT * FROM kegiatan") or die
                                                    (mysqli_error($conn));
                                                while($kegiatan = mysqli_fetch_array($sql_keg)) {
                                                    echo '<option value="'.$kegiatan['id_k'].'">' 
                                                    .$kegiatan['nama_keg'].'</option>';
                                                }
                                                ?>
                                                </select>
                                            </div>

                                            <div class="modal-footer">
                                            <input type="hidden" name="id_p" value="<?php echo $row['id_p']?>" class="form-control" id="id_k">
                                                <button type="reset" class="btn btn-danger">Reset</button>
                                                <input type="submit" class="btn btn-success" name="edit" value="Simpan">
                                            </div>
                                        </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="editsemua<?php echo $row['id_p']?>" class="modal fade" role="dialog">
                                    
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Edit Data Pemeliharaan</h4>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    
                                                    <div class="form-group">
                                                        <label class="control-table" for="id_alat">Nama Alat</label>
                                                        <select name="id_al" id="alat" class="form-control" required>
                                                        <option value="<?= $row['id_al']; ?>">--<?= $row['nama_alat']; ?> --</option>
                                                        <?php
                                                        $sql_alat = mysqli_query($conn, "SELECT * FROM alat") or die
                                                            (mysqli_error($conn));
                                                        while($alat = mysqli_fetch_array($sql_alat)) {
                                                            echo '<option value="'.$alat['id_al'].'">' 
                                                            .$alat['nama_alat'].'</option>';
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
        
                                                    <div class="form-group">
                                                        <label for="kegiatan">Nama Kegiatan</label>
                                                        <select name="id_k" id="kegiatan" class="form-control" required>
                                                        <option value="<?= $row['id_k']; ?>">--<?= $row['nama_keg']; ?> --</option>
                                                        <?php
                                                        $sql_keg = mysqli_query($conn, "SELECT * FROM kegiatan") or die
                                                            (mysqli_error($conn));
                                                        while($kegiatan = mysqli_fetch_array($sql_keg)) {
                                                            echo '<option value="'.$kegiatan['id_k'].'">' 
                                                            .$kegiatan['nama_keg'].'</option>';
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
                                                    Data terdapat relasi Komponen. Pastikan kembali sebelum proses edit data.
                                                    <div class="modal-footer">
                                                    <input type="hidden" name="id_allam" value="<?php echo $row['id_al']?>" class="form-control" >
                                                    <input type="hidden" name="id_klam" value="<?php echo $row['id_k']?>" class="form-control" >
                                                        <button type="reset" class="btn btn-danger">Reset</button>
                                                        <input type="submit" class="btn btn-success" name="editsemua" value="Simpan">
                                                    </div>
                                                </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
        
                                <div id="hapussemua<?php echo $row['id_p']?>" class="modal fade" role="dialog">                                            
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Hapus Data Pemeliharaan</h4>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    
                                                    <div class="form-group">
                                                        <label class="control-table" for="id_alat">Nama Alat</label>
                                                        <select name="id_al" id="alat" class="form-control" disabled>
                                                        <option value="<?= $row['id_al']; ?>">--<?= $row['nama_alat']; ?> --</option>
                                                        <?php
                                                        $sql_alat = mysqli_query($conn, "SELECT * FROM alat") or die
                                                            (mysqli_error($conn));
                                                        while($alat = mysqli_fetch_array($sql_alat)) {
                                                            echo '<option value="'.$alat['id_al'].'">' 
                                                            .$alat['nama_alat'].'</option>';
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
        
                                                    <div class="form-group">
                                                        <label for="kegiatan">Nama Kegiatan</label>
                                                        <select name="id_k" id="kegiatan" class="form-control" disabled>
                                                        <option value="<?= $row['id_k']; ?>">--<?= $row['nama_keg']; ?> --</option>
                                                        <?php
                                                        $sql_keg = mysqli_query($conn, "SELECT * FROM kegiatan") or die
                                                            (mysqli_error($conn));
                                                        while($kegiatan = mysqli_fetch_array($sql_keg)) {
                                                            echo '<option value="'.$kegiatan['id_k'].'">' 
                                                            .$kegiatan['nama_keg'].'</option>';
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
                                                    Data Akan terhapus secara permanen, pastikan kembali sebelum proses hapus data.
                                                    <div class="modal-footer">
                                                    <input type="hidden" name="id_allam" value="<?php echo $row['id_al']?>" class="form-control" >
                                                    <input type="hidden" name="id_klam" value="<?php echo $row['id_k']?>" class="form-control" >
                                                        <input type="submit" class="btn btn-danger" name="hapussemua" value="Hapus">
                                                    </div>
                                                </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                        <div id="status<?php echo $row['id_p']?>" class="modal fade" role="dialog">        
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Status Pemeliharaan</h4>
                                    </div>
                                    
                                    <?php
                                    if($row['status_pem'] == 0)
                                    {
                                    ?>
                                    <form action="" method="post">
                                    <div class="modal-body">
                                    Aktifkan <?php echo $row['nama_pem']?> ?

                                    <div class="modal-footer">
                                    <input hidden type="text" name="id_p" value="<?php echo $row['id_p']?>" class="form-control" id="id_p">
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
                                    Disable <?php echo $row['nama_pem']?> ?

                                    <div class="modal-footer">           
                                    <input hidden type="text" name="id_p" value="<?php echo $row['id_p']?>" class="form-control" id="id_p">
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
                            <div id="tambah" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Tambah Data Pemeliharaan</h4>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="control-table" for="id_alat">Nama Alat</label>
                                                <select name="id_al" id="alat" class="form-control" required>
                                                <option value="">-Pilih Alat-</option>
                                                <?php
                                                $sql_alat = mysqli_query($conn, "SELECT * FROM alat WHERE status = 1") or die
                                                    (mysqli_error($conn));
                                                while($alat = mysqli_fetch_array($sql_alat)) {
                                                    echo '<option value="'.$alat['id_al'].'">' 
                                                    .$alat['nama_alat'].'</option>';
                                                }
                                                ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="kegiatan">Nama Kegiatan</label>
                                                <select name="id_k" id="kegiatan" class="form-control" data-live-search="true" required>
                                                    <option value="">-Pilih Kegiatan-</option>
                                                    <?php
                                                $sql_keg = mysqli_query($conn, "SELECT * FROM kegiatan WHERE status = 1") or die
                                                (mysqli_error($conn));
                                                    while($kegiatan = mysqli_fetch_array($sql_keg)) {
                                                        echo '<option value="'.$kegiatan['id_k'].'">' 
                                                        .$kegiatan['nama_keg'].'</option>';
                                            }
                                                ?>
                                                </select>
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
<script type="text/javascript">
$(document).ready(function(){
    $('.search select').selectpicker();
</script>
</html>