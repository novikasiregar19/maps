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
    <style>
    iframe {
        display:block;
        width:100%;
        height:95vh;
    }
</style>
</head>

<body>
    <?php include 'menu.php' ?>
        <!-- Header-->
        <div class="content">
            <div class="animated fadeIn">
                <div class="col-lg-12">
               
                    <div class="card">
                        <div class="card-header">
                        <div class="row">
                        <?php
$id    = mysqli_real_escape_string($conn,$_GET['id']);
$query = mysqli_query($conn,"SELECT file FROM upload_file WHERE id='$id'");
$row  = mysqli_fetch_array($query);
?>
                        <div class="col-md-6 "> <a href="teknis.php"><i class="fa fa-chevron-left"></i> Back</a> <strong class="card-title"><?php echo $row['file']; ?></strong></div>

 <iframe src="files/<?php echo $row['file'];?>" type="application/pdf" width="100%" height="95vh"></iframe>
                        </div>
                        </div>
</div>

                        
                        </div>
                    </div>
</div>
            

<?php
// Close connection
mysqli_close($conn);
?>

</body>
</html>