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
    <title>Data RPN</title>
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
    <div class="col-md-6"><strong class="card-title">RPN</strong></div>
    <div class="col-md-6 text-right"><button type="button" class="btn btn-info add-new" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data </button>
</div>
  </div>
                            <?php
                                $id_rpn = $_POST['id_rpn']; 
                                $id_al = $_POST['id_al'];
                                $id_m = $_POST['id_m'];
                                $komponen = $_POST['nama_pem'];
                                $lokasi = $_POST['lokasi'];
                                $sev = $_POST['sev'];
                                $occ = $_POST['occ'];
                                $detect = $_POST['detect'];

                                

                                if(isset($_POST['tambah'])){
                                   
                                    //tambah
                                    $sql = "INSERT into rpn values (NULL,'$id_al','$id_m','$komponen','$lokasi','$sev','$occ','$detect')";
                                    if(mysqli_query($conn, $sql))
                                    {
                                        $nilaihasil = "Records inserted successfully.";
                                        ///
                                        // $nilaiuser = "User $username menambah alat $nama_alat";
                                        // $sql = "INSERT INTO log_user VALUES ('','$id_login',now(), 'tambah-alat','$nilaiuser')";
                                        // mysqli_query($conn, $sql);
                                        ///
                                    } 
                                    else
                                    {
                                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                                    }
                                
                                
                             }

                             if(isset($_POST['edit'])){
                                $sql = "UPDATE rpn SET nama_alat = '$nama_alat', nama_merk = '$nama_merk', nama_pem = '$komponen' , lokasi = '$lokasi', sev = '$sev', occ = '$occ', detect = '$detect' WHERE id_rpn = '$id_rpn'";
                                if(mysqli_query($conn, $sql))
                                {
                                    $nilaihasil = "Records updated successfully.";
                                    ///
                                    $nilaiuser = "User $username mengubah merk $nama_merk";
                                    $sql = "INSERT INTO log_user VALUES ('','$id_login',now(), 'edit-merk','$nilaiuser')";
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
                                        <th scope="col">Alat</th>
                                        <th scope="col">Merk</th>
                                        <th scope="col">Komponen</th>
                                        <th scope="col">Lokasi</th>
                                        <th scope="col">Severity</th>
                                        <th scope="col">Occurance</th>
                                        <th scope="col">Detection</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sql="SELECT * FROM rpn INNER JOIN alat on rpn.id_al=alat.id_al INNER JOIN merk on rpn.id_m=merk.id_m";
                                        $result=mysqli_query($conn,$sql);
                                        if(!$conn){
                                            die("Could not connect to the database".mysqli_connect_error());
                                        }
                                        while($row=mysqli_fetch_array($result))
                                        {
                                               
                                    ?>
                                    <tr>
                                        <td><?= $row['nama_alat']; ?></td>
                                        <td><?= $row['nama_merk']; ?></td>
                                        <td><?= $row['nama_pem']; ?></td>
                                        <td><?= $row['lokasi']; ?></td>
                                        <td><?= $row['sev']; ?></td>
                                        <td><?= $row['occ']; ?></td>
                                        <td><?= $row['detect']; ?></td>
                                        
                                        <!-- <td><?php 
                                        if($row['sev'] == "1")
                                        {
                                            $levelnub = "Kegagalan Tidak Berakibat Apapun";
                                        }
                                        if($row['sev'] == "2")
                                        {
                                            $levelnub = "Kegagalan Tidak Begitu Terlihat";
                                        }
                                        if($row['sev'] == "3")
                                        {
                                            $levelnub = "Kegagalan Kecil dan Dapat Diatasi";
                                        }
                                        if($row['sev'] == "4")
                                        {
                                            $levelnub = "Kegagalan Menyebabkan Penurunan Kinerja";
                                        }
                                        if($row['sev'] == "5")
                                        {
                                            $levelnub = "Kegagalan Menyebabkan Kerugian";
                                        }
                                        if($row['sev'] == "6")
                                        {
                                            $levelnub = "Kegagalan Menyebabkan Tidak Berfungsinya Sistem";
                                        }
                                        if($row['sev'] == "7")
                                        {
                                            $levelnub = "Kegagalan Tinggi";
                                        }
                                        if($row['sev'] == "8")
                                        {
                                            $levelnub = "Kegagalan Menyebabkan Tidak Layak Digunakan";
                                        }
                                        if($row['sev'] == "9")
                                        {
                                            $levelnub = "Kegagalan Menyebabkan Tidak Sesuai Peraturan";
                                        }
                                        if($row['sev'] == "10")
                                        {
                                            $levelnub = "Kegagalan Sangat Berbahaya";
                                        }
                                        echo "$levelnub";
                                        ?></td> -->


                                        <!-- <td><?php 
                                        if($row['occ'] == "1")
                                        {
                                            $levelnub2 = "Kejadian Lebih dari 5 Tahun";
                                        }
                                        if($row['occ'] == "2")
                                        {
                                            $levelnub2 = "Kejadian Setiap 3-5 Tahun";
                                        }
                                        if($row['occ'] == "3")
                                        {
                                            $levelnub2 = "Kejadian Setiap 1-3 Tahun";
                                        }
                                        if($row['occ'] == "4")
                                        {
                                            $levelnub2 = "Kejadian Setiap 1 Tahun";
                                        }
                                        if($row['occ'] == "5")
                                        {
                                            $levelnub2 = "Kejadian Setiap 6 Bulan";
                                        }
                                        if($row['occ'] == "6")
                                        {
                                            $levelnub2 = "Kejadian Setiap 3 Bulan";
                                        }
                                        if($row['occ'] == "7")
                                        {
                                            $levelnub2 = "Kejadian Setiap Bulan";
                                        }
                                        if($row['occ'] == "8")
                                        {
                                            $levelnub2 = "Kejadian Setiap Minggu";
                                        }
                                        if($row['occ'] == "9")
                                        {
                                            $levelnub2 = "Kejadian Setiap 3 - 4 Hari";
                                        }
                                        if($row['occ'] == "10")
                                        {
                                            $levelnub2 = "Kejadian Setiap Hari";
                                        }
                                        echo "$levelnub2";
                                        ?></td> -->


                                        <!-- <td><?php 
                                        if($row['detect'] == "1")
                                        {
                                            $levelnub3 = "Potensi Kerusakan Selalu Bisa Terdeteksi";
                                        }
                                        if($row['detect'] == "2")
                                        {
                                            $levelnub3 = "Potensi Kerusakan Sangat Tinggi dan Terkontrol Selalu";
                                        }
                                        if($row['detect'] == "3")
                                        {
                                            $levelnub3 = "Potensi Kerusakan Terdeteksi Tinggi dan Sering Terkontrol";
                                        }
                                        if($row['detect'] == "4")
                                        {
                                            $levelnub3 = "Potensi Kerusakan Kemungkinan akan Terdeteksi Tinggi";
                                        }
                                        if($row['detect'] == "5")
                                        {
                                            $levelnub3 = "Potensi Kerusakan Terdeteksi Sedang dan Terkontrol Berkala";
                                        }
                                        if($row['detect'] == "6")
                                        {
                                            $levelnub3 = "Potensi Kerusakan Terdeteksi Sedang dan Jarang Terkontrol";
                                        }
                                        if($row['detect'] == "7")
                                        {
                                            $levelnub3 = "Potensi Kerusakan Kemungkinan Kecil Terdeteksi";
                                        }
                                        if($row['detect'] == "8")
                                        {
                                            $levelnub3 = "Potensi Kerusakan Kemungkinan akan Terdeteksi Kecil";
                                        }
                                        if($row['detect'] == "9")
                                        {
                                            $levelnub3 = "Potensi Kerusakan akan Terdeteksi Kecil Sekali";
                                        }
                                        if($row['detect'] == "10")
                                        {
                                            $levelnub3 = "Potensi Kerusakan Tidak akan Terdeteksi Sama Sekali";
                                        }
                                        echo "$levelnub3";
                                        ?></td> -->
                                        
                                    </tr>

                                    <div id="edit<?php echo $row['id_rpn']?>" class="modal fade" role="dialog">        
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Edit RPN</h4>
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
                                                        <label class="control-table" for="id_m">Merk</label>
                                                        <select name="id_m" id="merk" class="form-control" required>
                                                        <option value="<?= $row['id_m']; ?>"><?= $row['nama_merk']; ?></option>
                                                            <?php
                                                                $sql_merk = mysqli_query($conn, "SELECT * FROM merk ") or die
                                                                        (mysqli_error($conn));
                                                                while($merk = mysqli_fetch_array($sql_merk)) {
                                                                echo '<option value="'.$merk['id_m'].'">' 
                                                                .$merk['nama_merk'].'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                        </div>   


                                                        <div class="form-group">
                                                            <label class="control-table" for="sev">Severity</label>
                                                            <select name="sev" id="sev" class="form-control" required>
                                                               <?php
                                                               $id_sevv = $row['id_rpn'];
                                                                    $sql_sev=mysqli_query($conn, "SELECT * FROM rpn WHERE id_rpn = '$id_sevv'") or die
                                                                                (mysqli_error($conn));
                                                                    $sev = mysqli_fetch_array($sql_sev);
                                                                    if($row['sev'] == "1")
                                                                    {
                                                                        $levelnu = "Kegagalan Tidak Berakibat Apapun";
                                                                    }
                                                                    if($row['sev'] == "2")
                                                                    {
                                                                        $levelnu = "Kegagalan Tidak Begitu Terlihat";
                                                                    }
                                                                    if($row['sev'] == "3")
                                                                    {
                                                                        $levelnu = "Kegagalan Kecil dan Dapat Diatasi";
                                                                    }
                                                                    if($row['sev'] == "4")
                                                                    {
                                                                        $levelnu = "Kegagalan Menyebabkan Penurunan Kinerja";
                                                                    }
                                                                    if($row['sev'] == "5")
                                                                    {
                                                                        $levelnu = "Kegagalan Menyebabkan Kerugian";
                                                                    }
                                                                    if($row['sev'] == "6")
                                                                    {
                                                                        $levelnu = "Kegagalan Menyebabkan Tidak Berfungsinya Sistem";
                                                                    }
                                                                    if($row['sev'] == "7")
                                                                    {
                                                                        $levelnu = "Kegagalan Tinggi";
                                                                    }
                                                                    if($row['sev'] == "8")
                                                                    {
                                                                        $levelnu = "Kegagalan Menyebabkan Tidak Layak Digunakan";
                                                                    }
                                                                    if($row['sev'] == "9")
                                                                    {
                                                                        $levelnu = "Kegagalan Menyebabkan Tidak Sesuai Peraturan";
                                                                    }
                                                                    if($row['sev'] == "10")
                                                                    {
                                                                        $levelnu = "Kegagalan Sangat Berbahaya";
                                                                    }
                                                                        ?>
                                                                        <option value="<?=$sev['sev']?>">- <?php echo $levelnu; ?> -</option>
                                                                    <?php
                                                                    
                                                                    
                                                                ?>
                                                                        <option value="1">Kegagalan Tidak Berakibat Apapun</option>
                                                                        <option value="2">Kegagalan Tidak Begitu Terlihat</option>
                                                                        <option value="3">Kegagalan Kecil dan Dapat Diatasi</option>
                                                                        <option value="4">Kegagalan Menyebabkan Penurunan Kinerja</option>
                                                                        <option value="5">Kegagalan Menyebabkan Kerugian</option>
                                                                        <option value="6">Kegagalan Menyebabkan Tidak Berfungsinya Sistem</option>
                                                                        <option value="7">Kegagalan Tinggi</option>
                                                                        <option value="8">Kegagalan Menyebabkan Tidak Layak Digunakan</option>
                                                                        <option value="9">Kegagalan Menyebabkan Tidak Sesuai Peraturan</option>
                                                                        <option value="10">Kegagalan Sangat Berbahaya</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-table" for="occ">Occurance</label>
                                                            <select name="occ" id="occ" class="form-control" required>
                                                               <?php
                                                               $id_occ = $row['id_rpn'];
                                                                    $sql_occ=mysqli_query($conn, "SELECT * FROM rpn WHERE id_rpn = '$id_occ'") or die
                                                                                (mysqli_error($conn));
                                                                    $sev = mysqli_fetch_array($sql_occ);
                                                                    if($row['occ'] == "1")
                                                                    {
                                                                        $leveln = "Kejadian Lebih dari 5 Tahun";
                                                                    }
                                                                    if($row['occ'] == "2")
                                                                    {
                                                                        $leveln = "Kejadian Setiap 3-5 Tahun";
                                                                    }
                                                                    if($row['occ'] == "3")
                                                                    {
                                                                        $leveln = "Kejadian Setiap 1-3 Tahun";
                                                                    }
                                                                    if($row['occ'] == "4")
                                                                    {
                                                                        $leveln = "Kejadian Setiap 1 Tahun";
                                                                    }
                                                                    if($row['occ'] == "5")
                                                                    {
                                                                        $leveln = "Kejadian Setiap 6 Bulan";
                                                                    }
                                                                    if($row['occ'] == "6")
                                                                    {
                                                                        $leveln = "Kejadian Setiap 3 Bulan";
                                                                    }
                                                                    if($row['occ'] == "7")
                                                                    {
                                                                        $leveln = "Kejadian Setiap Bulan";
                                                                    }
                                                                    if($row['occ'] == "8")
                                                                    {
                                                                        $leveln = "Kejadian Setiap Minggu";
                                                                    }
                                                                    if($row['occ'] == "9")
                                                                    {
                                                                        $leveln = "Kejadian Setiap 3 - 4 Hari";
                                                                    }
                                                                    if($row['occ'] == "10")
                                                                    {
                                                                        $leveln = "Kejadian Setiap Hari";
                                                                    }
                                                                    echo "$leveln";
                                                                        ?>
                                                                        <option value="<?=$occ['occ']?>">- <?php echo $leveln; ?> -</option>
                                                                    <?php
                                                                    
                                                                    
                                                                ?>
                                                                        <option value="1">Kejadian Lebih dari 5 Tahun</option>
                                                                        <option value="2">Kejadian Setiap 3-5 Tahun</option>
                                                                        <option value="3">Kejadian Setiap 1-3 Tahun</option>
                                                                        <option value="4">Kejadian Setiap 1 Tahun</option>
                                                                        <option value="5">Kejadian Setiap 6 Bulan</option>
                                                                        <option value="6">Kejadian Setiap 3 Bulan</option>
                                                                        <option value="7">Kejadian Setiap Bulan</option>
                                                                        <option value="8">Kejadian Setiap Minggu</option>
                                                                        <option value="9">Kejadian Setiap 3 - 4 Hari</option>
                                                                        <option value="10">Kejadian Setiap Hari</option>
                                                            </select>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label class="control-table" for="detect">Detection</label>
                                                            <select name="detect" id="detect" class="form-control" required>
                                                               <?php
                                                               $id_det = $row['id_rpn'];
                                                                    $sql_det=mysqli_query($conn, "SELECT * FROM rpn WHERE id_rpn = '$id_det'") or die
                                                                                (mysqli_error($conn));
                                                                    $det = mysqli_fetch_array($sql_det);
                                                                    if($row['detect'] == "1")
                                                                    {
                                                                        $level = "Potensi Kerusakan Selalu Bisa Terdeteksi";
                                                                    }
                                                                    if($row['detect'] == "2")
                                                                    {
                                                                        $level = "Potensi Kerusakan Sangat Tinggi dan Terkontrol Selalu";
                                                                    }
                                                                    if($row['detect'] == "3")
                                                                    {
                                                                        $level = "Potensi Kerusakan Terdeteksi Tinggi dan Sering Terkontrol";
                                                                    }
                                                                    if($row['detect'] == "4")
                                                                    {
                                                                        $level = "Potensi Kerusakan Kemungkinan akan Terdeteksi Tinggi";
                                                                    }
                                                                    if($row['detect'] == "5")
                                                                    {
                                                                        $level = "Potensi Kerusakan Terdeteksi Sedang dan Terkontrol Berkala";
                                                                    }
                                                                    if($row['detect'] == "6")
                                                                    {
                                                                        $level = "Potensi Kerusakan Terdeteksi Sedang dan Jarang Terkontrol";
                                                                    }
                                                                    if($row['detect'] == "7")
                                                                    {
                                                                        $level = "Potensi Kerusakan Kemungkinan Kecil Terdeteksi";
                                                                    }
                                                                    if($row['detect'] == "8")
                                                                    {
                                                                        $level = "Potensi Kerusakan Kemungkinan akan Terdeteksi Kecil";
                                                                    }
                                                                    if($row['detect'] == "9")
                                                                    {
                                                                        $level = "Potensi Kerusakan akan Terdeteksi Kecil Sekali";
                                                                    }
                                                                    if($row['detect'] == "10")
                                                                    {
                                                                        $level = "Potensi Kerusakan Tidak akan Terdeteksi Sama Sekali";
                                                                    }
                                                                    echo "$level";
                                                                        ?>
                                                                        <option value="<?=$detect['detect']?>">- <?php echo $level; ?> -</option>
                                                                    <?php
                                                                    
                                                                    
                                                                ?>
                                                                        <option value="1">Potensi Kerusakan Selalu Bisa Terdeteksi</option>
                                                                        <option value="2">Potensi Kerusakan Sangat Tinggi dan Terkontrol Selalu</option>
                                                                        <option value="3">Potensi Kerusakan Terdeteksi Tinggi dan Sering Terkontrol</option>
                                                                        <option value="4">Potensi Kerusakan Kemungkinan akan Terdeteksi Tinggi</option>
                                                                        <option value="5">Potensi Kerusakan Terdeteksi Sedang dan Terkontrol Berkala</option>
                                                                        <option value="6">Potensi Kerusakan Terdeteksi Sedang dan Jarang Terkontrol</option>
                                                                        <option value="7">Potensi Kerusakan Kemungkinan Kecil Terdeteksi</option>
                                                                        <option value="8">Potensi Kerusakan Kemungkinan akan Terdeteksi Kecil</option>
                                                                        <option value="9">Potensi Kerusakan akan Terdeteksi Kecil Sekali</option>
                                                                        <option value="10">Potensi Kerusakan Tidak akan Terdeteksi Sama Sekali</option>
                                                            </select>
                                                        </div>


                                                        <div class="modal-footer">
                                                        <input type="hidden" name="id_rpn" value="<?php echo $row['id_rpn']?>" class="form-control" id="id_rpn">
                                                            <input type="submit" class="btn btn-success" name="edit" value="Submit">

                                                        </div>
                                                    </div>
                                                </form>
                                            
                                            </div>
                                        </div>
                                    </div>

                                            <?php } 
                                            
                                            ?>
                                                
                                            </tbody>
                                        </table>

                                    <div id="tambah" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Tambah Data RPN</h4>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">

                                                        <div class="form-group">
                                                        <label class="control-table" for="id_al">Nama Alat</label>
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
                                                        <label class="control-table" for="id_m">Merk</label>
                                                        <select name="id_m" id="merk" class="form-control" required>
                                                        <option value="">-Pilih Alat-</option>
                                                            <?php
                                                                $sql_merk = mysqli_query($conn, "SELECT * FROM merk ") or die
                                                                        (mysqli_error($conn));
                                                                while($merk = mysqli_fetch_array($sql_merk)) {
                                                                echo '<option value="'.$merk['id_m'].'">' 
                                                                .$merk['nama_merk'].'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                        </div>   

                                                        
                                                        <div class="form-group">
                                                            <label class="control-table" for="nama_pem">Komponen</label>
                                                            <input type="text" name="nama_pem" value="<?php echo $row['nama_pem']?>" class="form-control" id="komponen" autocomplete="off" required>
                                                        </div>

                                                        
                                                        <div class="form-group">
                                                            <label class="control-table" for="lokasi">Lokasi</label>
                                                            <input type="text" name="lokasi" value="<?php echo $row['lokasi']?>" class="form-control" id="lokasi" autocomplete="off" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-table" for="sev">Severity</label>
                                                            <select name="sev" id="sev" class="form-control" required>
                                                                        <option value="">-Pilih Severity-</option>
                                                                        <option value="1">Kegagalan Tidak Berakibat Apapun</option>
                                                                        <option value="2">Kegagalan Tidak Begitu Terlihat</option>
                                                                        <option value="3">Kegagalan Kecil dan Dapat Diatasi</option>
                                                                        <option value="4">Kegagalan Menyebabkan Penurunan Kinerja</option>
                                                                        <option value="5">Kegagalan Menyebabkan Kerugian</option>
                                                                        <option value="6">Kegagalan Menyebabkan Tidak Berfungsinya Sistem</option>
                                                                        <option value="7">Kegagalan Tinggi</option>
                                                                        <option value="8">Kegagalan Menyebabkan Tidak Layak Digunakan</option>
                                                                        <option value="9">Kegagalan Menyebabkan Tidak Sesuai Peraturan</option>
                                                                        <option value="10">Kegagalan Sangat Berbahaya</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-table" for="occ">Occurance</label>
                                                            <select name="occ" id="occ" class="form-control" required>
                                                                        <option value="">-Pilih Occurance-</option>
                                                                        <option value="1">Kejadian Lebih dari 5 Tahun</option>
                                                                        <option value="2">Kejadian Setiap 3-5 Tahun</option>
                                                                        <option value="3">Kejadian Setiap 1-3 Tahun</option>
                                                                        <option value="4">Kejadian Setiap 1 Tahun</option>
                                                                        <option value="5">Kejadian Setiap 6 Bulan</option>
                                                                        <option value="6">Kejadian Setiap 3 Bulan</option>
                                                                        <option value="7">Kejadian Setiap Bulan</option>
                                                                        <option value="8">Kejadian Setiap Minggu</option>
                                                                        <option value="9">Kejadian Setiap 3 - 4 Hari</option>
                                                                        <option value="10">Kejadian Setiap Hari</option>
                                                                   
                                                            </select>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="control-table" for="detect">Detection</label>
                                                            <select name="detect" id="detect" class="form-control" required>
                                                                        <option value="">-Pilih Detection-</option>
                                                                        <option value="1">Potensi Kerusakan Selalu Bisa Terdeteksi</option>
                                                                        <option value="2">Potensi Kerusakan Sangat Tinggi dan Terkontrol Selalu</option>
                                                                        <option value="3">Potensi Kerusakan Terdeteksi Tinggi dan Sering Terkontrol</option>
                                                                        <option value="4">Potensi Kerusakan Kemungkinan akan Terdeteksi Tinggi</option>
                                                                        <option value="5">Potensi Kerusakan Terdeteksi Sedang dan Terkontrol Berkala</option>
                                                                        <option value="6">Potensi Kerusakan Terdeteksi Sedang dan Jarang Terkontrol</option>
                                                                        <option value="7">Potensi Kerusakan Kemungkinan Kecil Terdeteksi</option>
                                                                        <option value="8">Potensi Kerusakan Kemungkinan akan Terdeteksi Kecil</option>
                                                                        <option value="9">Potensi Kerusakan akan Terdeteksi Kecil Sekali</option>
                                                                        <option value="10">Potensi Kerusakan Tidak akan Terdeteksi Sama Sekali</option>
                                                                   
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

</html>

