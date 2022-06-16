<?php
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    ini_set('max_execution_time', 0);
    date_default_timezone_set('Asia/Jakarta');
    include "koneksi.php"
?>

<!DOCTYPE html>
<html>
    <head>

        <?php include 'header.php'?>
        <title>Report <?php echo date("d/m/Y"); ?></title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="jquery.tabledit.min.js"></script>

    </head>

    <body class="sb-nav-fixed">
<?php include 'menu.php'?>
<?php
    session_start();

    if($_SESSION['level']==""){
        header("location:dashboard.php?pesan=gagal");
    }
?>
<div class="content">
            <div class="animated fadeIn">

    <h5><b><center>LAPORAN PELAKSANAAN KEGIATAN PEMELIHARAAN PENCEGAHAN</center></b></h4>
    <h6><b><center>(Pemeliharaan Harian, Mingguan dan Bulanan)</center></b></h6>
    <hr>

<?php
if(isset($_GET['alatx']) AND isset($_GET['merkx']) AND isset($_GET['datepickerx'])) 
        {
        $alat = $_GET["alatx"];
        $merk = $_GET["merkx"];
        $datepicker = $_GET["datepickerx"];
        $dateElements = explode('-', $datepicker);
        $year = $dateElements[0];
    switch ($dateElements[1]) 
    {
        case '01'    :  $mo = "Januari";break;
        case '02'    :  $mo = "Februari";break;
        case '03'    :  $mo = "Maret";break;
        case '04'    :  $mo = "April";break;
        case '05'    :  $mo = "Mei";break;
        case '06'    :  $mo = "Juni";break;
        case '07'    :  $mo = "Juli";break;
        case '08'    :  $mo = "Agustus";break;
        case '09'    :  $mo = "September";break;
        case '10'    :  $mo = "Oktober";break;
        case '11'    :  $mo = "November";break;
        case '12'    :  $mo = "Desember";break;
    }


        $sql1="SELECT nama_alat FROM alat WHERE id_al = $alat";
       $result1=mysqli_query($conn,$sql1);
       $row1=mysqli_fetch_array($result1);
       $nama_alat = $row1['nama_alat'];


       $sql2="SELECT nama_merk FROM merk WHERE id_m = $merk";
       $result2=mysqli_query($conn,$sql2);
       $row2=mysqli_fetch_array($result2);
       $nama_merk = $row2['nama_merk'];

       $sql_tambahv="INSERT IGNORE INTO trans_tot_verify values (NULL,'$merk','$alat','$datepicker',now()
            ,0,0,0,0,0,0,0,0,0,0
            ,0,0,0,0,0,0,0,0,0,0
            ,0,0,0,0,0,0,0,0,0,0,0)";
            mysqli_query($conn, $sql_tambahv);

       $sql1c="SELECT * FROM trans_tot_verify WHERE id_m = '$merk' AND id_al = '$alat' AND datetime_a  LIKE '$datepicker%'";
       $result1c=mysqli_query($conn,$sql1c);
       $row=mysqli_fetch_array($result1c);


        }
?>

          <?php
          $id_tot = $_POST['id_tot'];
          $ket_p = $_POST['ket_p'];
          if(isset($_POST['status_set'])) { $status_set = 0; } else { $status_set = 1; }

          if($_POST['verifi']){
            
            $sql_edit = "UPDATE trans_tot SET ket_p = '$ket_p', status_set = '$status_set'  WHERE id_tot = '$id_tot'";
            if(mysqli_query($conn, $sql_edit))
            {
                $nilaihasil = "Records updated successfully.";
                ///
                $nilaiuser = "User $username verifikasi data";
                $sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'verifikasi','$nilaiuser')";
                mysqli_query($conn, $sql);
                ///
            } 
            else
            {
                echo "ERROR: Could not able to execute $sql_edit. " . mysqli_error($conn);
            }
        }
          ?>
<form action="" method="post">
    <table width=100%>
<tr>
    <td width=10%>
    <select class="form-control" name="alat" id="alat" style="width:150px;" required>
            <option value="">-Pilih Alat-</option>
                <?php
                //Perintah sql untuk menampilkan semua data pada tabel jurusan
                $sql="select * from alat";
                $hasil=mysqli_query($conn,$sql);
                while ($data = mysqli_fetch_array($hasil)) {
                    ?>
                    <option  value="<?php echo $data['id_al'];?>"><?php echo $data['nama_alat'];?></option>
                    <?php
                }
                ?>
            </select>
    </td>
    <td width=10%>
    <select class="form-control" name="merk" id="merk" style="width:150px;">
            <option value="0">-Pilih merk-</option>
                <!-- Merk motor akan diload menggunakan ajax, dan ditampilkan disini -->
            </select>
    </td>
    <td width=5%>
    <input type="text" style="width:150px;" class="form-control" name="datepicker" id="datepicker" placeholder="YYYY-MM" autocomplete="off" required>
    </td>      
    <td width=5%>
                <button type="submit" class="btn btn-primary" name="tambah"><i class="fa fa-search"></i> Filter</button>
                </form>
    </td>
    <td width=60%>
    </td>
    <td width=5%>
    <form action="" method="post">
<button type="button" class="btn btn-info add-new" onclick=" window.open('cetak.php?alatx=<?php echo $alat;?>&&merkx=<?php echo $merk;?>&&datepickerx=<?php echo $datepicker;?>','_blank')"><i class="fa fa-print"></i> Cetak</button>
    </td>
    <!-- <td width=5%>
    <button type="submit" class="btn btn-success" name="verifix"><i class="fa fa-save"></i> Approve</button>
    </td> -->
    </tr>
    </table>
            
<hr>

<table width=100%>
<tr align="left">
    <td width=5%>ALAT
    </td>
    <td width=1%>
        :
    </td>
    <td>
    <?php echo $nama_alat;?>
    </td>      
    <td>
    </td>
    <td width=5%>
        BULAN
    </td>
    <td width=1%>
        :
    </td>
    <td width=5%>
    <?php echo $mo;?>
    </td>
    </tr>
    <tr>
    <td>MERK
    </td>
    <td>
        :
    </td>
    <td>
    <?php echo $nama_merk;?>
    </td>      
    <td>
    </td>
    <td>
        TAHUN
    </td>
    <td>
        :
    </td>
    <td>
    <?php echo $year;?>
    </td>
    </tr>

    </table>              


    <input type="hidden" name="idx_alat" value="<?php echo $alat ?>" />
    <input type="hidden" name="idx_merk" value="<?php echo $merk ?>" />
    <input type="hidden" name="datepickerx" value="<?php echo $datepicker ?>" />
    <div class="tableFixHead">  
    <table id="entries">
        <thead>
        <tr>
            <th style="text-align:center" rowspan="2">Uraian Kegiatan</th>
            <th style="text-align:center" colspan="33">Tanggal Kegiatan <hr></th>
        </tr>
        <tr>
        <th width=2%><center>1</center></th>
            <th width=2%><center>2</center></th>
            <th width=2%><center>3</center></th>
            <th width=2%><center>4</center></th>
            <th width=2%><center>5</center></th>
            <th width=2%><center>6</center></th>
            <th width=2%><center>7</center></th>
            <th width=2%><center>8</center></th>
            <th width=2%><center>9</center></th>
            <th width=2%><center>10</center></th>
            <th width=2%><center>11</center></th>
            <th width=2%><center>12</center></th>
            <th width=2%><center>13</center></th>
            <th width=2%><center>14</center></th>
            <th width=2%><center>15</center></th>
            <th width=2%><center>16</center></th>
            <th width=2%><center>17</center></th>
            <th width=2%><center>18</center></th>
            <th width=2%><center>19</center></th>
            <th width=2%><center>20</center></th>
            <th width=2%><center>21</center></th>
            <th width=2%><center>22</center></th>
            <th width=2%><center>23</center></th>
            <th width=2%><center>24</center></th>
            <th width=2%><center>25</center></th>
            <th width=2%><center>26</center></th>
            <th width=2%><center>27</center></th>
            <th width=2%><center>28</center></th>
            <th width=2%><center>29</center></th>
            <th width=2%><center>30</center></th>
            <th width=2%><center>31</center></th>
            <th width=2%><center>Ket</center></th>
        </tr>
        <tr bgcolor=#eee>
                            <td><b>Verifikasi</b> <!-- <input type="checkbox" id="check-all"><label for="check-all">Check all</label> -->
</td>
                            <td><center><?php if ($row['day1'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day2'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day3'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day4'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day5'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day6'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day7'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day8'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day9'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day10'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day11'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day12'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center> <?php if ($row['day13'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center> <?php if ($row['day14'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day15'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day16'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day17'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day18'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day19'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day20'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day21'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day22'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day23'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day24'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day25'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day26'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day27'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day28'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day29'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day30'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
            <td><center><?php if ($row['day31'] == 1) { echo "<i class='fa fa-check' style='color:green'></i>"; } ?></center></td>
                                <td></td>

    </tr>         
    </thead>
    <tbody>

        
        <?php
    
        $x = 0;

        $xx = 0;
        if(isset($_POST['tambah']) OR (isset($_GET['alatx']) AND isset($_GET['merkx']) AND isset($_GET['datepickerx']))) 
        {
            
            if(isset($_POST['tambah']) AND (isset($_GET['alatx']) AND isset($_GET['merkx']) AND isset($_GET['datepickerx']))) 
        {
            $alat = $_POST["alat"];
        $merk = $_POST["merk"];
        $datepicker = $_POST["datepicker"];
        echo "<meta http-equiv='refresh' content='0;url=?alatx=$alat&&merkx=$merk&&datepickerx=$datepicker'>";
            
        }
        else {
            if(isset($_POST['tambah']))
            {
                $alat = $_POST["alat"];
                $merk = $_POST["merk"];
                $datepicker = $_POST["datepicker"];
                echo "<meta http-equiv='refresh' content='0;url=?alatx=$alat&&merkx=$merk&&datepickerx=$datepicker'>";
            }
            else {
                $alat = $_GET["alatx"];
            $merk = $_GET["merkx"];
            $datepicker = $_GET["datepickerx"];
            }
            
        }
        ?>
        <tr bgcolor="#eee">
        <td colspan="34"><b>Pemeliharaan Harian</b></td>
            
           
        </tr>
        <?php

                                        $sql_pem="SELECT DISTINCT id_k FROM pemeliharaan WHERE id_al=$alat";
                                        $result_pem=mysqli_query($conn,$sql_pem);
                                        $ndata = mysqli_num_rows($result_pem);
                                        if($ndata > 0)
                                        {
                                        while($row=mysqli_fetch_array($result_pem)){
                                            $x++;
                                            $id_k = $row['id_k'];
                                            $sql_keg="SELECT nama_keg FROM kegiatan WHERE id_k=$id_k";
                                            $result_keg=mysqli_query($conn,$sql_keg);
                                            $row=mysqli_fetch_array($result_keg);
                                            $nama_keg = $row['nama_keg'];
                                            ?>
                                           

                                        <?php
                                        if($merk != "0")
                                        {
                                            $sql="SELECT * FROM trans_tot,pemeliharaan,kegiatan,alat,merk
                                        WHERE trans_tot.id_p=pemeliharaan.id_p AND pemeliharaan.id_k=kegiatan.id_k 
                                        AND trans_tot.id_m=merk.id_m AND pemeliharaan.id_al=alat.id_al 
                                        AND alat.id_al=$alat AND trans_tot.id_m=$merk AND pemeliharaan.id_k=$id_k AND trans_tot.type_p=1 AND pemeliharaan.status_pem=1 AND datetime_a  LIKE '$datepicker%'";
                                        
                                        }
                                        else {
                                            $sql="SELECT * FROM trans_tot,pemeliharaan,kegiatan,alat
                                        WHERE trans_tot.id_p=pemeliharaan.id_p AND pemeliharaan.id_k=kegiatan.id_k 
                                        AND pemeliharaan.id_al=alat.id_al 
                                        AND alat.id_al=$alat AND trans_tot.id_m=$merk AND pemeliharaan.id_k=$id_k AND trans_tot.type_p=1 AND pemeliharaan.status_pem=1 AND datetime_a  LIKE '$datepicker%'";
                                        
                                        }
                                        
                                        $result=mysqli_query($conn,$sql);
                                        $vika=mysqli_num_rows($result);
                                        if($vika == 1)
                                        {
                                            while($row=mysqli_fetch_array($result))
                                            {
                                                if(trim($row['ket_p']) != "")
                                                {
                                                    $merahu = "#fec4c1";
                                                }
                                                else
                                                {
                                                    $merahu = "";
                                                }
                                                if($row['nama_pem'] != "")
                                                {
                                                    ?>
                                                    <tr>
                                                  <td colspan=34><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b></td>
                                              </tr>
                                    
                                              <tr bgcolor=<?php echo $merahu; ?>>
    <td>&nbsp;&nbsp;&nbsp; - <?php echo $row['nama_pem']?></td>
                                <td> <center><?php if ($row['day1'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day2'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day3'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day4'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day5'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day6'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day7'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day8'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day9'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day10'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day11'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day12'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day13'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day14'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day15'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day16'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day17'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day18'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day19'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day20'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day21'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day22'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day23'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day24'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day25'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day26'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day27'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day28'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day29'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day30'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day31'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><a href="#verifi<?php echo $row['id_tot']?>" data-toggle="modal"><i class="fa fa-pencil"></i></a></center></td>
    <!-- lanjutkan dari day3 sampai day31 -->
    
            </tr> <?php

                        }
                        else
                        {
                            ?>
                            <tr bgcolor=<?php echo $merahu; ?>>
                            <td><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b></td>
                            <td> <center><?php if ($row['day1'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day2'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day3'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day4'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day5'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day6'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day7'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day8'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day9'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day10'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day11'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day12'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day13'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day14'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day15'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day16'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day17'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day18'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day19'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day20'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day21'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day22'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day23'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day24'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day25'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day26'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day27'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day28'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day29'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day30'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day31'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><a href="#verifi<?php echo $row['id_tot']?>" data-toggle="modal"><i class="fa fa-pencil"></i></a></center></td>
    <!-- lanjutkan dari day3 sampai day31 -->
    </tr>
                                              <?php

                                          }
                                          ?>
                                          <div id="verifi<?php echo $row['id_tot']?>" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                              <h4 class="modal-title">Keterangan</h4>
                                                          </div>
                                                          <form action="" method="post">
                                                              <div class="modal-body">
                                                                  
                                                                  <div class="form-group">
                                                                  <b>Kegiatan</b> : <?php echo $row['nama_keg']?>
                                                                  </div>
                      
                                                                  <div class="form-group">
                                                                  <b>Sub Kegiatan</b> : <?php echo $row['nama_pem']?>
                                                                  </div>

                                                                  <div class="form-group">
                                                                  <b>Keterangan</b> :
                                                                  <input type="text" name="ket_p" value="<?php echo $row['ket_p']?>" class="form-control" id="ket_p">
                                                                  
                                                                  </div>

                                                                  <div class="form-group">
                                                                  <input type="checkbox" name="status_set" <?php if ($row['status_set'] == 0) { echo "checked='checked'"; } ?>>
                                                                  Hide item on report
                                                                  </div>

                                                                 
                                                                  <div class="modal-footer">
                                                                  <input type="hidden" name="id_tot" value="<?php echo $row['id_tot']?>" class="form-control" id="id_tot">
                                                                      <button type="reset" class="btn btn-danger">Reset</button>
                                                                      <input type="submit" class="btn btn-success" name="verifi" value="Simpan">
                                                                  </div>
                                                              </div>
                                                              </div>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                                      <?php
                                        }
                                    }
                                        else
                                        {
                                            ?>
                                            <tr>
                                            <td colspan=34><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b></td>
                                        </tr>
                                        <?php
                                            while($row=mysqli_fetch_array($result))
                                            {
                                                if(trim($row['ket_p']) != "")
                                                {
                                                    $merahu = "#fec4c1";
                                                }
                                                else
                                                {
                                                    $merahu = "";
                                                }
                                        ?>
        
        
        <tr bgcolor=<?php echo $merahu; ?>>
            <td>&nbsp;&nbsp;&nbsp; - <?php echo $row['nama_pem']?> </td>
            <td> <center><?php if ($row['day1'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day2'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day3'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day4'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day5'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day6'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day7'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day8'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day9'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day10'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day11'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day12'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day13'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day14'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day15'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day16'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day17'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day18'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day19'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day20'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day21'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day22'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day23'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day24'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day25'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day26'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day27'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day28'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day29'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day30'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day31'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><a href="#verifi<?php echo $row['id_tot']?>" data-toggle="modal"><i class="fa fa-pencil"></i></a></center></td>
    <!-- lanjutkan dari day3 sampai day31 -->
    
            </tr>
            <div id="verifi<?php echo $row['id_tot']?>" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                              <h4 class="modal-title">Keterangan</h4>
                                                          </div>
                                                          <form action="" method="post">
                                                              <div class="modal-body">
                                                                  
                                                                  <div class="form-group">
                                                                  <b>Kegiatan</b> : <?php echo $row['nama_keg']?>
                                                                  </div>
                      
                                                                  <div class="form-group">
                                                                  <b>Sub Kegiatan</b> : <?php echo $row['nama_pem']?>
                                                                  </div>

                                                                  <div class="form-group">
                                                                  <b>Keterangan</b> :
                                                                  <input type="text" name="ket_p" value="<?php echo $row['ket_p']?>" class="form-control" id="ket_p">
                                                                  
                                                                  </div>

                                                                  <div class="form-group">
                                                                  <input type="checkbox" name="status_set" <?php if ($row['status_set'] == 0) { echo "checked='checked'"; } ?>>
                                                                  Hide item on report
                                                                  </div>

                                                                 
                                                                  <div class="modal-footer">
                                                                  <input type="hidden" name="id_tot" value="<?php echo $row['id_tot']?>" class="form-control" id="id_tot">
                                                                      <button type="reset" class="btn btn-danger">Reset</button>
                                                                      <input type="submit" class="btn btn-success" name="verifi" value="Simpan">
                                                                  </div>
                                                              </div>
                                                              </div>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                        <?php
                                       
                                        } 
                                        }
                                                                                                                        
                                }
                                   
                                }
                                else {
                                    ?>
                                    <tr>
                                    <td colspan=34>
                                        No data
                                    </td>
                                    </tr>
                                    <?php
                                }
         
                            ?>
        
        
                                  

        <tr bgcolor="#eee">
<td colspan="34"><b>Pemeliharaan Mingguan</b></td>
           
        </tr>
        <?php

        $x = 0;
  
        $xx = 0;
        
        

                                        $sql_pem="SELECT DISTINCT id_k FROM pemeliharaan_ming WHERE id_al=$alat";
                                        $result_pem=mysqli_query($conn,$sql_pem);
                                        $ndata = mysqli_num_rows($result_pem);
                                        if($ndata > 0)
                                        {
                                        while($row=mysqli_fetch_array($result_pem)){
                                            $x++;
                                            $id_k = $row['id_k'];
                                            $sql_keg="SELECT nama_keg FROM kegiatan WHERE id_k=$id_k";
                                            $result_keg=mysqli_query($conn,$sql_keg);
                                            $row=mysqli_fetch_array($result_keg);
                                            $nama_keg = $row['nama_keg'];
                                            ?>
                                           

                                        <?php
                                        if($merk != "0")
                                        {
                                            $sql="SELECT * FROM trans_tot,pemeliharaan_ming,kegiatan,alat,merk
                                        WHERE trans_tot.id_p=pemeliharaan_ming.id_p_m AND pemeliharaan_ming.id_k=kegiatan.id_k 
                                        AND trans_tot.id_m=merk.id_m AND pemeliharaan_ming.id_al=alat.id_al 
                                        AND alat.id_al=$alat AND trans_tot.id_m=$merk AND pemeliharaan_ming.id_k=$id_k AND trans_tot.type_p=2 AND pemeliharaan_ming.status_pem_ming=1 AND datetime_a  LIKE '$datepicker%'";
                                        
                                        }
                                        else {
                                            $sql="SELECT * FROM trans_tot,pemeliharaan_ming,kegiatan,alat
                                        WHERE trans_tot.id_p=pemeliharaan_ming.id_p_m AND pemeliharaan_ming.id_k=kegiatan.id_k 
                                        AND pemeliharaan_ming.id_al=alat.id_al 
                                        AND alat.id_al=$alat AND trans_tot.id_m=$merk AND pemeliharaan_ming.id_k=$id_k AND trans_tot.type_p=2 AND pemeliharaan_ming.status_pem_ming=1 AND datetime_a  LIKE '$datepicker%'";
                                        
                                        }
                                        
                                        $result=mysqli_query($conn,$sql);
                                        $vika=mysqli_num_rows($result);
                                        if($vika == 1)
                                        {
                                            while($row=mysqli_fetch_array($result))
                                            {
                                                if(trim($row['ket_p']) != "")
                                                {
                                                    $merahu = "#fec4c1";
                                                }
                                                else
                                                {
                                                    $merahu = "";
                                                }
                                                if($row['nama_pem_ming'] != "")
                                                {
                                                    ?>
                                                    <tr >
                                                  <td colspan=33><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b></td>
                                              </tr>
                        <tr bgcolor=<?php echo $merahu; ?>>
                        <td>&nbsp;&nbsp;&nbsp; - <?php echo $row['nama_pem_ming']?> </td>
                                <td> <center><?php if ($row['day1'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day2'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day3'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day4'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day5'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day6'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day7'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day8'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day9'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day10'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day11'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day12'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day13'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day14'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day15'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day16'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day17'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day18'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day19'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day20'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day21'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day22'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day23'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day24'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day25'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day26'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day27'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day28'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day29'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day30'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day31'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td> 
                                <td> <center><a href="#verifi<?php echo $row['id_tot']?>" data-toggle="modal"><i class="fa fa-pencil"></i></a></center></td>
                                </tr>
                                <?php

                                        }
                                else
                                    {
                                    ?>
       <tr bgcolor=<?php echo $merahu; ?>>
        <td><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b></td>
        <td> <center><?php if ($row['day1'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day2'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day3'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day4'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day5'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day6'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day7'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day8'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day9'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day10'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day11'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day12'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day13'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day14'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day15'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day16'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day17'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day18'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day19'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day20'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day21'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day22'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day23'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day24'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day25'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day26'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day27'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day28'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day29'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day30'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day31'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td> 
                                <td> <center><a href="#verifi<?php echo $row['id_tot']?>" data-toggle="modal"><i class="fa fa-pencil"></i></a></center></td>
    
            </tr>
    
            <?php

                    }
                    ?>
                    <div id="verifi<?php echo $row['id_tot']?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Keterangan</h4>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    
                                    <div class="form-group">
                                    <b>Kegiatan</b> : <?php echo $row['nama_keg']?>
                                    </div>

                                    <div class="form-group">
                                    <b>Sub Kegiatan</b> : <?php echo $row['nama_pem_ming']?>
                                    </div>

                                    <div class="form-group">
                                    <b>Keterangan</b> :
                                    <input type="text" name="ket_p" value="<?php echo $row['ket_p']?>" class="form-control" id="ket_p">
                                    
                                    </div>

                                    <div class="form-group">
                                    <input type="checkbox" name="status_set" <?php if ($row['status_set'] == 0) { echo "checked='checked'"; } ?>>
                                    Hide item on report
                                    </div>

                                   
                                    <div class="modal-footer">
                                    <input type="hidden" name="id_tot" value="<?php echo $row['id_tot']?>" class="form-control" id="id_tot">
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                        <input type="submit" class="btn btn-success" name="verifi" value="Simpan">
                                    </div>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                    }
                    }
                    else
                    {
                    ?>
                    <tr>
                    <td colspan=33><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b></td>
                    </tr>
                    <?php
                    while($row=mysqli_fetch_array($result))
                    {
                        if(trim($row['ket_p']) != "")
                                                {
                                                    $merahu = "#fec4c1";
                                                }
                                                else
                                                {
                                                    $merahu = "";
                                                }
                    ?>

<tr bgcolor=<?php echo $merahu; ?>>
            <td>&nbsp;&nbsp;&nbsp; - <?php echo $row['nama_pem_ming']?> </td>
            <td> <center><?php if ($row['day1'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day2'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day3'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day4'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day5'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day6'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day7'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day8'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day9'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day10'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day11'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day12'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day13'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day14'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day15'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day16'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day17'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day18'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day19'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day20'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day21'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day22'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day23'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day24'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day25'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day26'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day27'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day28'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day29'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day30'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day31'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td> 
                                <td> <center><a href="#verifi<?php echo $row['id_tot']?>" data-toggle="modal"><i class="fa fa-pencil"></i></a></center></td>
    
            </tr>
            <div id="verifi<?php echo $row['id_tot']?>" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                              <h4 class="modal-title">Keterangan</h4>
                                                          </div>
                                                          <form action="" method="post">
                                                              <div class="modal-body">
                                                                  
                                                                  <div class="form-group">
                                                                  <b>Kegiatan</b> : <?php echo $row['nama_keg']?>
                                                                  </div>
                      
                                                                  <div class="form-group">
                                                                  <b>Sub Kegiatan</b> : <?php echo $row['nama_pem_ming']?>
                                                                  </div>

                                                                  <div class="form-group">
                                                                  <b>Keterangan</b> :
                                                                  <input type="text" name="ket_p" value="<?php echo $row['ket_p']?>" class="form-control" id="ket_p">
                                                                  
                                                                  </div>

                                                                  <div class="form-group">
                                                                  <input type="checkbox" name="status_set" <?php if ($row['status_set'] == 0) { echo "checked='checked'"; } ?>>
                                                                  Hide item on report
                                                                  </div>

                                                                 
                                                                  <div class="modal-footer">
                                                                  <input type="hidden" name="id_tot" value="<?php echo $row['id_tot']?>" class="form-control" id="id_tot">
                                                                      <button type="reset" class="btn btn-danger">Reset</button>
                                                                      <input type="submit" class="btn btn-success" name="verifi" value="Simpan">
                                                                  </div>
                                                              </div>
                                                              </div>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                        <?php
                                       
                                        } 
                                        }
                                       
                                                                                    
                                }
                                   
                                }
                                else {
                                    ?>
                                    <tr>
                                    <td colspan=34>
                                        No data
                                    </td>
                                    </tr>
                                    <?php
                                }
         
                            ?>
        
        
                 


        <tr bgcolor="#eee">
<td colspan="34"><b>Pemeliharaan Bulanan</b></td>
           
        </tr>
           
        </tr>
        <?php

        $x = 0;

        $xx = 0;
                
        

                                        $sql_pem_bul="SELECT DISTINCT id_k FROM pemeliharaan_bul WHERE id_al=$alat";
                                        $result_pem=mysqli_query($conn,$sql_pem_bul);
                                        $ndata = mysqli_num_rows($result_pem);
                                        if($ndata > 0)
                                        {
                                        while($row=mysqli_fetch_array($result_pem)){
                                            $x++;
                                            $id_k = $row['id_k'];
                                            $sql_keg="SELECT nama_keg FROM kegiatan WHERE id_k=$id_k";
                                            $result_keg=mysqli_query($conn,$sql_keg);
                                            $row=mysqli_fetch_array($result_keg);
                                            $nama_keg = $row['nama_keg'];
                                            ?>
                                           

                                        <?php
                                        if($merk != "0")
                                        {
                                            $sql="SELECT * FROM trans_tot,pemeliharaan_bul,kegiatan,alat,merk
                                        WHERE trans_tot.id_p=pemeliharaan_bul.id_p_b AND pemeliharaan_bul.id_k=kegiatan.id_k 
                                        AND trans_tot.id_m=merk.id_m AND pemeliharaan_bul.id_al=alat.id_al 
                                        AND alat.id_al=$alat AND trans_tot.id_m=$merk AND pemeliharaan_bul.id_k=$id_k AND trans_tot.type_p=3 AND pemeliharaan_bul.status_pem_bul=1 AND datetime_a  LIKE '$datepicker%'";
                                        
                                        }
                                        else {
                                            $sql="SELECT * FROM trans_tot,pemeliharaan_bul,kegiatan,alat
                                        WHERE trans_tot.id_p=pemeliharaan_bul.id_p_b AND pemeliharaan_bul.id_k=kegiatan.id_k 
                                        AND pemeliharaan_bul.id_al=alat.id_al 
                                        AND alat.id_al=$alat AND trans_tot.id_m=$merk AND pemeliharaan_bul.id_k=$id_k AND trans_tot.type_p=3 AND pemeliharaan_bul.status_pem_bul=1 AND datetime_a  LIKE '$datepicker%'";
                                        
                                        }
                                        
                                        $result=mysqli_query($conn,$sql);
                                        $vika=mysqli_num_rows($result);
                                        if($vika == 1)
                                        {
                                           
                                            while($row=mysqli_fetch_array($result))
                                            {
                                                if(trim($row['ket_p']) != "")
                                                {
                                                    $merahu = "#fec4c1";
                                                }
                                                else
                                                {
                                                    $merahu = "";
                                                }
                                                if($row['nama_pem_bul'] != "")
                                                {
                                                    ?>
                                                    <tr>
                                                  <td colspan=33><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b></td>
                                              </tr>
                                              <tr bgcolor=<?php echo $merahu; ?>>
                        <td>&nbsp;&nbsp;&nbsp; - <?php echo $row['nama_pem_bul']?> </td>
                                <td> <center><?php if ($row['day1'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day2'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day3'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day4'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day5'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day6'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day7'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day8'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day9'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day10'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day11'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day12'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day13'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day14'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day15'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day16'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day17'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day18'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day19'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day20'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day21'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day22'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day23'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day24'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day25'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day26'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day27'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day28'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day29'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day30'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day31'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td> 
                                <td> <center><a href="#verifi<?php echo $row['id_tot']?>" data-toggle="modal"><i class="fa fa-pencil"></i></a></center></td>
    
            </tr>
                                <?php

                                        }
                                        else
                                        {
                                        ?>
                      <tr bgcolor=<?php echo $merahu; ?>>
                        <td><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b></td>
                                <td> <center><?php if ($row['day1'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day2'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day3'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day4'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day5'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day6'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day7'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day8'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day9'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day10'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day11'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day12'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day13'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day14'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day15'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day16'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day17'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day18'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day19'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day20'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day21'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day22'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day23'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day24'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day25'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day26'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day27'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day28'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day29'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day30'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day31'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td> 
                                <td> <center><a href="#verifi<?php echo $row['id_tot']?>" data-toggle="modal"><i class="fa fa-pencil"></i></a></center></td>
            </tr>
                        <?php

                                }
?>
 <div id="verifi<?php echo $row['id_tot']?>" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                              <h4 class="modal-title">Keterangan</h4>
                                                          </div>
                                                          <form action="" method="post">
                                                              <div class="modal-body">
                                                                  
                                                                  <div class="form-group">
                                                                  <b>Kegiatan</b> : <?php echo $row['nama_keg']?>
                                                                  </div>
                      
                                                                  <div class="form-group">
                                                                  <b>Sub Kegiatan</b> : <?php echo $row['nama_pem_bul']?>
                                                                  </div>

                                                                  <div class="form-group">
                                                                  <b>Keterangan</b> :
                                                                  <input type="text" name="ket_p" value="<?php echo $row['ket_p']?>" class="form-control" id="ket_p">
                                                                  
                                                                  </div>

                                                                  <div class="form-group">
                                                                  <input type="checkbox" name="status_set" <?php if ($row['status_set'] == 0) { echo "checked='checked'"; } ?>>
                                                                  Hide item on report
                                                                  </div>

                                                                 
                                                                  <div class="modal-footer">
                                                                  <input type="hidden" name="id_tot" value="<?php echo $row['id_tot']?>" class="form-control" id="id_tot">
                                                                      <button type="reset" class="btn btn-danger">Reset</button>
                                                                      <input type="submit" class="btn btn-success" name="verifi" value="Simpan">
                                                                  </div>
                                                              </div>
                                                              </div>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                              <?php
                                }
                                }
                                else
                                {
                                ?>
                                <tr>
                                <td colspan=33><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b></td>
                                </tr>
                                <?php
                                while($row=mysqli_fetch_array($result))
                                {
                                    if(trim($row['ket_p']) != "")
                                                {
                                                    $merahu = "#fec4c1";
                                                }
                                                else
                                                {
                                                    $merahu = "";
                                                }
                                ?>
                               <tr bgcolor=<?php echo $merahu; ?>>
                            <td>&nbsp;&nbsp;&nbsp; - <?php echo $row['nama_pem_bul']?> </td>
                                <td> <center><?php if ($row['day1'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day2'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day3'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day4'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day5'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day6'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day7'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day8'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day9'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day10'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day11'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day12'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day13'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day14'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day15'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day16'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day17'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day18'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day19'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day20'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day21'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day22'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day23'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day24'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day25'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day26'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day27'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day28'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day29'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day30'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td>
                                <td> <center><?php if ($row['day31'] == 1) { ?> <i class="fa fa-check"></i><?php } ?> </center></td> 
                                <td> <center><a href="#verifi<?php echo $row['id_tot']?>" data-toggle="modal"><i class="fa fa-pencil"></i></a></center></td>
            </tr>
    <!-- lanjutkan dari day3 sampai day31 -->
    
            </tr>
            <div id="verifi<?php echo $row['id_tot']?>" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                              <h4 class="modal-title">Keterangan</h4>
                                                          </div>
                                                          <form action="" method="post">
                                                              <div class="modal-body">
                                                                  
                                                                  <div class="form-group">
                                                                  <b>Kegiatan</b> : <?php echo $row['nama_keg']?>
                                                                  </div>
                      
                                                                  <div class="form-group">
                                                                  <b>Sub Kegiatan</b> : <?php echo $row['nama_pem_bul']?>
                                                                  </div>

                                                                  <div class="form-group">
                                                                  <b>Keterangan</b> :
                                                                  <input type="text" name="ket_p" value="<?php echo $row['ket_p']?>" class="form-control" id="ket_p">
                                                                  
                                                                  </div>

                                                                  <div class="form-group">
                                                                  <input type="checkbox" name="status_set" <?php if ($row['status_set'] == 0) { echo "checked='checked'"; } ?>>
                                                                  Hide item on report
                                                                  </div>

                                                                 
                                                                  <div class="modal-footer">
                                                                  <input type="hidden" name="id_tot" value="<?php echo $row['id_tot']?>" class="form-control" id="id_tot">
                                                                      <button type="reset" class="btn btn-danger">Reset</button>
                                                                      <input type="submit" class="btn btn-success" name="verifi" value="Simpan">
                                                                  </div>
                                                              </div>
                                                              </div>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                        <?php
                                       
                                        } 
                                        }
                                       
                                                                                    
                                }
                                   
                                }
                                else {
                                    ?>
                                    <tr>
                                    <td colspan=34>
                                        No data
                                    </td>
                                    </tr>
                                    <?php
                                }
         
                            ?>
        
        <?php 
        }
        else
        {
            ?>
            <tr bgcolor="#eee">
        <td colspan="34"><b>No data</b></td>
            
           
        </tr>
        <?php
        }        
        ?>    
       
    </tbody>
</table>
    </div>
</form>


<script>
    $(document).ready(function() {
    $('#dataTables').DataTable();
} );

$("#datepicker").datepicker( {
    format: "yyyy-mm",
    startView: "months", 
    autoclose: true,
    minViewMode: "months"
});

</script>

<script>

        $("#alat").change(function(){
           
            var id_al = $("#alat").val();

            $.ajax({
                type: "POST",
                dataType: "html",
                url: "ambil-data.php",
                data: "alat="+id_al,
                success: function(data){
                   $("#merk").html(data);
                }
            });
        });

</script>

<?php
// Close connection
mysqli_close($conn);
?>
</div>
    </div>

</body>
</html>