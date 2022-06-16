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
    <title>Manual Teknis</title>
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
    <div class="col-md-6"><strong class="card-title">FILE</strong></div>
    <div class="col-md-6 text-right"><button type="button" class="btn btn-info add-new" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Upload File</button>
</div>
  </div>
                            

  <?php

        //pengecekan tipe harus pdf
        $tipe_file = $_FILES['file']['type']; //mendapatkan mime type

        if ($tipe_file == "application/pdf") //mengecek apakah file tersebu pdf atau bukan
        {
        
        $file = trim($_FILES['file']['name']);

        $sql = "INSERT INTO upload_file (file, tanggal_up) VALUES ('$file', now())";
        mysqli_query($conn,$sql); //simpan data judul dahulu untuk mendapatkan id

        //dapatkan id terkahir
        $query = mysqli_query($conn,"SELECT file FROM upload_file ORDER BY id DESC LIMIT 1");
        $row  = mysqli_fetch_array($query);

        //mengganti nama pdf
        $nama_baru = $row['file']; 
        $file_temp = $_FILES['file']['tmp_name']; //data temp yang di upload
        $folder    = $_SERVER['DOCUMENT_ROOT'] . "/maps/files/";

        move_uploaded_file($file_temp, $folder.$nama_baru); //fungsi upload
        //update nama file di database

        header('location:teknis.php?pesan=upload-berhasil');

        } else
        {
         
        }
?>
<?php
        if($_POST['hapussemua']){
            $id    = $_POST['id'];
            $sql = "SELECT file FROM upload_file WHERE id='$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $file = $row['file'];
    
            $query = mysqli_query($conn,"DELETE FROM upload_file WHERE id='$id' ");
            header('location:teknis.php?pesan=hapus-berhasil');
            $filepath = $_SERVER['DOCUMENT_ROOT'] . "/maps/files/$file";
            unlink($filepath);
            if(mysqli_query($conn, $sql))
                {
                    $nilaihasil = "Records inserted successfully.";
                    ///
                    $nilaiuser = "User $username menghapus file $file";
                    $sql = "INSERT INTO log_user VALUES ('','$id_login',now(), 'hapus-file','$nilaiuser')";
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
                          
            <table id="tabel-data" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Judul File</th>
                                        <th scope="col">Tanggal Upload</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $sql="SELECT * FROM upload_file";
                                        $result=mysqli_query($conn,$sql);
                                        if(!$conn){
                                            die("Could not connect to the database".mysqli_connect_error());
                                        }
                                        while($row=mysqli_fetch_array($result)){
                                    ?>
                                    <tr>
                                        <td><?= $row['file']; ?></td>
                                        <td><?= date('d-m-Y', strtotime($row['tanggal_up'])); ?></td>
                                        <td>
                                        <a href="view.php?id=<?php echo $row['id'];?>"><i class="fa fa-eye"></i></a>
                                        <a href="#hapussemua<?php echo $row['id']?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                    
                                    <div id="hapussemua<?php echo $row['id']?>" class="modal fade" role="dialog">                                            
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Hapus File</h4>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    Data Akan terhapus secara permanen, pastikan kembali sebelum proses hapus data.
                                                    <div class="modal-footer">
                                                    <input type="hidden" name="id" value="<?php echo $row['id']?>" class="form-control" >
                                                        <input type="submit" class="btn btn-danger" name="hapussemua" value="Hapus">
                                                    </div>
                                                </div>
                                                </div>
                                            </form>
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
                                        <h4 class="modal-title">Upload File</h4>
                                    </div>
                                    
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">

                                        <div class="form-group">
                                                <label class="control-table" for="upload">Upload Here</label>
                                                <input type="file" name="file" class="form-control" id="file" autocomplete="off" required>
                                        </div>

                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-success" name="submit" value="Upload">

                                        </div>

                                        - Pastikan Nama File tidak Mengandung Simbol. 
                                        <br>
                                        - Ukuran File Maks 20MB
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