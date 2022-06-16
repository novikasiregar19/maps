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
    if(move_uploaded_file($_FILES['file']['tmp_name']))
            echo "Upload file berhasil...<br>
            Nama file: {$_FILES['file']['name']}<br>
            Ukuran: {$_FILES['file']['size']} byte";

        else{
        echo gagal;
        }
?>
                            
                        </div>
       
            <?php echo "$nilaihasil"; ?>
            
                          
            <table id="tabel-data" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Judul File</th>
                                        <th scope="col">Tanggal Upload</th>
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
                                        <td><?= $row['tanggal_up']; ?></td>
                                    </tr>

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
                                                <input type="file" name="upload" class="form-control" id="upload" autocomplete="off" required>
                                        </div>

                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-success" name="tambah" value="Upload">
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
