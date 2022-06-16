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
    <title>Log</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>


<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
</script>
    
    
</head>
    <body class="sb-nav-fixed">
<?php include 'menu.php'?>
        <!-- Header-->
        <div class="content">
            <div class="animated fadeIn">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                        <div class="row">
    <div class="col-md-6"><strong class="card-title">LOG USER</strong></div>
  </div>
</div>
                        <form action="" method="post">
                        <table width=100%>
   <tr>
<td width=10%>
Filter Date : 
</td>
    <td width=5%>
    <input style="width:150px;" type="text" class="form-control" name="datepicker" id="datepicker" autocomplete="off" placeholder="YYYY-MM-DD" required>
    </td>      
    <td width=5%>
                <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-search"></i> Filter</button>
</td>
<td width=80%>
</td>
</tr>     
</table>
</form>
<hr>

            <table id="tabel-data" class="table table-striped table-hover">
                                
                                <thead>
 
                                    <tr>
                                        <th scope="col">Login by</th>
                                        <th scope="col">Aktivitas</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Date Time</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($_POST['submit'])){
                                        $datetime = $_POST['datepicker'];
                                        }
                                        else{
                                            $datetime = date('Y-m-d');
                                        }
                                        $sql="SELECT username, aktivitas, keterangan, tanggal_log FROM log_user,login WHERE log_user.id_login = login.id_login AND tanggal_log LIKE '$datetime%' ORDER BY tanggal_log DESC";
                                        $result=mysqli_query($conn,$sql);
                                        if(!$conn){
                                            die("Could not connect to the database".mysqli_connect_error());
                                        }
                                        while($row=mysqli_fetch_array($result)){
                                        
                                    ?>
                                    <tr>
                                        <td><?= $row['username']; ?></td>
                                        <td><?= $row['aktivitas']; ?></td>
                                        <td><?= $row['keterangan']; ?></td>
                                        <td><?= date('d-m-Y H:i:s', strtotime($row['tanggal_log'])); ?></td>
                                    </tr>

                                        
                                            <?php } ?>
                                                
                                            </tbody>
                                        </table>
                        </div>
                    </div>
                        </div>
                
    </div><!-- .animated -->
</div><!-- .content -->  
<script>
    $(document).ready(function() {
    $('#dataTables').DataTable();
} );

$("#datepicker").datepicker( {
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true,
    });

</script>
<?php
// Close connection
mysqli_close($conn);
?>

<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="jquery.tabledit.min.js"></script>


</body>

</html>

