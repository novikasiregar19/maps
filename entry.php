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
        <title>Entry <?php echo date("d/m/Y"); ?></title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
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

    <h5><b><center>JADWAL PELAKSANAAN KEGIATAN PEMELIHARAAN PENCEGAHAN</center></b></h4>
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
    <td width=5%>
    <button type="submit" class="btn btn-success" name="simpan"><i class="fa fa-save"></i> Simpan</button>
    </td>
    </tr>
    </table>
            
<hr>

    <input type="hidden" name="idx_alat" value="<?php echo $alat ?>" />
    <input type="hidden" name="idx_merk" value="<?php echo $merk ?>" />
    <input type="hidden" name="datepickerx" value="<?php echo $datepicker ?>" />
    <?php
if(isset($_POST['simpan'])) 
{
$n = $_POST['n'];
        $alatx = $_POST["idx_alat"];
        $merkx = $_POST["idx_merk"];
        $datepickerx = $_POST["datepickerx"];
        if($n == 0)
        {
        echo "<font color=red>Can not to save, data null</font>";
        }
        else
        {   
            
for ($i=1; $i<=$n; $i++)

{
    
    $id_tot = $_POST['id_tot'.$i]; 

    $ket_p = $_POST['ket'.$i]; 

    if(isset($_POST['dayy1x'.$i])) { $day1 = 1; } else { $day1 = 0; }
    if(isset($_POST['dayy2x'.$i])) { $day2 = 1; } else { $day2 = 0; }
    if(isset($_POST['dayy3x'.$i])) { $day3 = 1; } else { $day3 = 0; }
    if(isset($_POST['dayy4x'.$i])) { $day4 = 1; } else { $day4 = 0; }
    if(isset($_POST['dayy5x'.$i])) { $day5 = 1; } else { $day5 = 0; }
    if(isset($_POST['dayy6x'.$i])) { $day6 = 1; } else { $day6 = 0; }
    if(isset($_POST['dayy7x'.$i])) { $day7 = 1; } else { $day7 = 0; }
    if(isset($_POST['dayy8x'.$i])) { $day8 = 1; } else { $day8 = 0; }
    if(isset($_POST['dayy9x'.$i])) { $day9 = 1; } else { $day9 = 0; }
    if(isset($_POST['dayy10x'.$i])) { $day10 = 1; } else { $day10 = 0; }
    if(isset($_POST['dayy11x'.$i])) { $day11 = 1; } else { $day11 = 0; }
    if(isset($_POST['dayy12x'.$i])) { $day12 = 1; } else { $day12 = 0; }
    if(isset($_POST['dayy13x'.$i])) { $day13 = 1; } else { $day13 = 0; }
    if(isset($_POST['dayy14x'.$i])) { $day14 = 1; } else { $day14 = 0; }
    if(isset($_POST['dayy15x'.$i])) { $day15 = 1; } else { $day15 = 0; }
    if(isset($_POST['dayy16x'.$i])) { $day16 = 1; } else { $day16 = 0; }
    if(isset($_POST['dayy17x'.$i])) { $day17 = 1; } else { $day17 = 0; }
    if(isset($_POST['dayy18x'.$i])) { $day18 = 1; } else { $day18 = 0; }
    if(isset($_POST['dayy19x'.$i])) { $day19 = 1; } else { $day19 = 0; }
    if(isset($_POST['dayy20x'.$i])) { $day20 = 1; } else { $day20 = 0; }
    if(isset($_POST['dayy21x'.$i])) { $day21 = 1; } else { $day21 = 0; }
    if(isset($_POST['dayy22x'.$i])) { $day22 = 1; } else { $day22 = 0; }
    if(isset($_POST['dayy23x'.$i])) { $day23 = 1; } else { $day23 = 0; }
    if(isset($_POST['dayy24x'.$i])) { $day24 = 1; } else { $day24 = 0; }
    if(isset($_POST['dayy25x'.$i])) { $day25 = 1; } else { $day25 = 0; }
    if(isset($_POST['dayy26x'.$i])) { $day26 = 1; } else { $day26 = 0; }
    if(isset($_POST['dayy27x'.$i])) { $day27 = 1; } else { $day27 = 0; }
    if(isset($_POST['dayy28x'.$i])) { $day28 = 1; } else { $day28 = 0; }
    if(isset($_POST['dayy29x'.$i])) { $day29 = 1; } else { $day29 = 0; }
    if(isset($_POST['dayy30x'.$i])) { $day30 = 1; } else { $day30 = 0; }
    if(isset($_POST['dayy31x'.$i])) { $day31 = 1; } else { $day31 = 0; }
    

    
    
    //lanjutkan if ini sampai day 31

    //lanjutkan set ini sampai day 31
    $query = "UPDATE IGNORE trans_tot SET datetime_update = now() , 
    day1 = '$day1',
    day2 = '$day2', 
    day3 = '$day3',
    day4 = '$day4',
    day5 = '$day5',
    day6 = '$day6',
    day7 = '$day7',
    day8 = '$day8',
    day9 = '$day9',
    day10 = '$day10',
    day11 = '$day11',
    day12 = '$day12',
    day13 = '$day13',
    day14 = '$day14',
    day15 = '$day15',
    day16 = '$day16',
    day17 = '$day17',
    day18 = '$day18',
    day19 = '$day19',
    day20 = '$day20',
    day21 = '$day21',
    day22 = '$day22',
    day23 = '$day23',
    day24 = '$day24',
    day25 = '$day25',
    day26 = '$day26',
    day27 = '$day27',
    day28 = '$day28',
    day29 = '$day29',
    day30 = '$day30',
    day31 = '$day31' ,
    ket_p = '$ket_p' 
    WHERE id_tot = '$id_tot' AND datetime_a  LIKE '$datepicker%'";
    mysqli_query($conn,$query);
    


}
///
echo "<font color=green>Please Wait Data Saving..</font>";
$nilaiuser = "User $username input checklist pemeliharaan $nama_alat;$nama_merk;$datepickerx";
$sql = "INSERT INTO log_user VALUES (NULL,'$id_login',now(), 'checklist-pemeliharaan','$nilaiuser')";
mysqli_query($conn, $sql);
echo "<meta http-equiv='refresh' content='3;url=?alatx=$alatx&&merkx=$merkx&&datepickerx=$datepickerx'>";
///
}
}
else
{
    
}
   ?>
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
    <div class="tableFixHead">    
    <table id="entries">
        <thead>
        <tr>
            <th style="text-align:center" rowspan="2">Uraian Kegiatan</th>
            <th style="text-align:center" colspan="32">Tanggal Kegiatan <hr></th>
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
        <td colspan="33"><b>Pemeliharaan Harian</b></td>
            
           
        </tr>
        <?php
        
        $i = 0;

        $x = 0;

        $xx = 0;

        $sql="SELECT * FROM pemeliharaan WHERE id_al = $alat AND status_pem = 1";
       $result=mysqli_query($conn,$sql);
            if(!$conn){
                die("Could not connect to the database".mysqli_connect_error());
            }
            while($row=mysqli_fetch_array($result))
            {
                $id_p = $row['id_p'];
            $sql_tambah="INSERT IGNORE INTO trans_tot values (NULL,'$merk','$id_p','1','$datepicker',now()
            ,0,0,0,0,0,0,0,0,0,0
            ,0,0,0,0,0,0,0,0,0,0
            ,0,0,0,0,0,0,0,0,0,0,0,'',1)";
            mysqli_query($conn, $sql_tambah);
            }
        

                                        $sql_pem="SELECT DISTINCT id_k FROM pemeliharaan WHERE id_al=$alat AND status_pem = 1";
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
                                        AND alat.id_al=$alat AND trans_tot.id_m=$merk AND pemeliharaan.id_k=$id_k AND trans_tot.type_p=1 AND datetime_a  LIKE '$datepicker%'";
                                        
                                        }
                                        else {
                                            $sql="SELECT * FROM trans_tot,pemeliharaan,kegiatan,alat
                                        WHERE trans_tot.id_p=pemeliharaan.id_p AND pemeliharaan.id_k=kegiatan.id_k 
                                        AND pemeliharaan.id_al=alat.id_al 
                                        AND alat.id_al=$alat AND trans_tot.id_m=$merk AND pemeliharaan.id_k=$id_k AND trans_tot.type_p=1 AND datetime_a  LIKE '$datepicker%'";
                                        
                                        }
                                        
                                        $result=mysqli_query($conn,$sql);
                                        $vika=mysqli_num_rows($result);
                                        if($vika == 1)
                                        {
                                            while($row=mysqli_fetch_array($result))
                                            {
                                                $i++;
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
                                            <td colspan=33><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b></td>
                                        </tr>
    <tr bgcolor=<?php echo $merahu; ?>>
            <td>&nbsp;&nbsp;&nbsp; - <?php echo $row['nama_pem']?> <input name="id_tot<?php echo $i; ?>" type="hidden" id="id_tot" value="<?php echo $row['id_tot']; ?>"></td>
            <td><center><input type="checkbox" name="dayy1x<?php echo $i; ?>"  <?php if ($row['day1'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy2x<?php echo $i; ?>" <?php if ($row['day2'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy3x<?php echo $i; ?>" <?php if ($row['day3'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy4x<?php echo $i; ?>" <?php if ($row['day4'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy5x<?php echo $i; ?>" <?php if ($row['day5'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy6x<?php echo $i; ?>" <?php if ($row['day6'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy7x<?php echo $i; ?>" <?php if ($row['day7'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy8x<?php echo $i; ?>" <?php if ($row['day8'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy9x<?php echo $i; ?>" <?php if ($row['day9'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy10x<?php echo $i; ?>" <?php if ($row['day10'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy11x<?php echo $i; ?>" <?php if ($row['day11'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy12x<?php echo $i; ?>" <?php if ($row['day12'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy13x<?php echo $i; ?>" <?php if ($row['day13'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy14x<?php echo $i; ?>" <?php if ($row['day14'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy15x<?php echo $i; ?>" <?php if ($row['day15'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy16x<?php echo $i; ?>" <?php if ($row['day16'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy17x<?php echo $i; ?>" <?php if ($row['day17'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy18x<?php echo $i; ?>" <?php if ($row['day18'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy19x<?php echo $i; ?>" <?php if ($row['day19'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy20x<?php echo $i; ?>" <?php if ($row['day20'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy21x<?php echo $i; ?>" <?php if ($row['day21'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy22x<?php echo $i; ?>" <?php if ($row['day22'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy23x<?php echo $i; ?>" <?php if ($row['day23'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy24x<?php echo $i; ?>" <?php if ($row['day24'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy25x<?php echo $i; ?>" <?php if ($row['day25'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy26x<?php echo $i; ?>" <?php if ($row['day26'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy27x<?php echo $i; ?>" <?php if ($row['day27'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy28x<?php echo $i; ?>" <?php if ($row['day28'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy29x<?php echo $i; ?>" <?php if ($row['day29'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy30x<?php echo $i; ?>" <?php if ($row['day30'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy31x<?php echo $i; ?>" <?php if ($row['day31'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="text" name="ket<?php echo $i; ?>" value="<?php echo $row['ket_p']; ?>"></center></td>
    <!-- lanjutkan dari day3 sampai day31 -->
    
            </tr>


                                              <?php

                                          }
                                          else
                                          {
                                              ?>
                                                <tr bgcolor=<?php echo $merahu; ?>>
            <td><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b><input name="id_tot<?php echo $i; ?>" type="hidden" id="id_tot" value="<?php echo $row['id_tot']; ?>"></td>
            <td><center><input type="checkbox" name="dayy1x<?php echo $i; ?>"  <?php if ($row['day1'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy2x<?php echo $i; ?>" <?php if ($row['day2'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy3x<?php echo $i; ?>" <?php if ($row['day3'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy4x<?php echo $i; ?>" <?php if ($row['day4'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy5x<?php echo $i; ?>" <?php if ($row['day5'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy6x<?php echo $i; ?>" <?php if ($row['day6'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy7x<?php echo $i; ?>" <?php if ($row['day7'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy8x<?php echo $i; ?>" <?php if ($row['day8'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy9x<?php echo $i; ?>" <?php if ($row['day9'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy10x<?php echo $i; ?>" <?php if ($row['day10'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy11x<?php echo $i; ?>" <?php if ($row['day11'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy12x<?php echo $i; ?>" <?php if ($row['day12'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy13x<?php echo $i; ?>" <?php if ($row['day13'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy14x<?php echo $i; ?>" <?php if ($row['day14'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy15x<?php echo $i; ?>" <?php if ($row['day15'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy16x<?php echo $i; ?>" <?php if ($row['day16'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy17x<?php echo $i; ?>" <?php if ($row['day17'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy18x<?php echo $i; ?>" <?php if ($row['day18'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy19x<?php echo $i; ?>" <?php if ($row['day19'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy20x<?php echo $i; ?>" <?php if ($row['day20'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy21x<?php echo $i; ?>" <?php if ($row['day21'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy22x<?php echo $i; ?>" <?php if ($row['day22'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy23x<?php echo $i; ?>" <?php if ($row['day23'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy24x<?php echo $i; ?>" <?php if ($row['day24'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy25x<?php echo $i; ?>" <?php if ($row['day25'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy26x<?php echo $i; ?>" <?php if ($row['day26'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy27x<?php echo $i; ?>" <?php if ($row['day27'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy28x<?php echo $i; ?>" <?php if ($row['day28'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy29x<?php echo $i; ?>" <?php if ($row['day29'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy30x<?php echo $i; ?>" <?php if ($row['day30'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy31x<?php echo $i; ?>" <?php if ($row['day31'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="text" name="ket<?php echo $i; ?>" value="<?php echo $row['ket_p']; ?>"></center></td>
    <!-- lanjutkan dari day3 sampai day31 -->
    
            </tr>
                                              <?php

                                          }

                                        }
                                    }
                                        else
                                        {
                                            ?>
                                            <tr >
                                            <td colspan=33><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b></td>
                                        </tr>
                                        <?php
                                            while($row=mysqli_fetch_array($result))
                                            {
                                            $i++;
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
            <td>&nbsp;&nbsp;&nbsp; - <?php echo $row['nama_pem']?> <input name="id_tot<?php echo $i; ?>" type="hidden" id="id_tot" value="<?php echo $row['id_tot']; ?>"></td>
            <td><center><input type="checkbox" name="dayy1x<?php echo $i; ?>"  <?php if ($row['day1'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy2x<?php echo $i; ?>" <?php if ($row['day2'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy3x<?php echo $i; ?>" <?php if ($row['day3'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy4x<?php echo $i; ?>" <?php if ($row['day4'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy5x<?php echo $i; ?>" <?php if ($row['day5'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy6x<?php echo $i; ?>" <?php if ($row['day6'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy7x<?php echo $i; ?>" <?php if ($row['day7'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy8x<?php echo $i; ?>" <?php if ($row['day8'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy9x<?php echo $i; ?>" <?php if ($row['day9'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy10x<?php echo $i; ?>" <?php if ($row['day10'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy11x<?php echo $i; ?>" <?php if ($row['day11'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy12x<?php echo $i; ?>" <?php if ($row['day12'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy13x<?php echo $i; ?>" <?php if ($row['day13'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy14x<?php echo $i; ?>" <?php if ($row['day14'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy15x<?php echo $i; ?>" <?php if ($row['day15'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy16x<?php echo $i; ?>" <?php if ($row['day16'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy17x<?php echo $i; ?>" <?php if ($row['day17'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy18x<?php echo $i; ?>" <?php if ($row['day18'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy19x<?php echo $i; ?>" <?php if ($row['day19'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy20x<?php echo $i; ?>" <?php if ($row['day20'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy21x<?php echo $i; ?>" <?php if ($row['day21'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy22x<?php echo $i; ?>" <?php if ($row['day22'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy23x<?php echo $i; ?>" <?php if ($row['day23'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy24x<?php echo $i; ?>" <?php if ($row['day24'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy25x<?php echo $i; ?>" <?php if ($row['day25'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy26x<?php echo $i; ?>" <?php if ($row['day26'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy27x<?php echo $i; ?>" <?php if ($row['day27'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy28x<?php echo $i; ?>" <?php if ($row['day28'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy29x<?php echo $i; ?>" <?php if ($row['day29'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy30x<?php echo $i; ?>" <?php if ($row['day30'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy31x<?php echo $i; ?>" <?php if ($row['day31'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="text" name="ket<?php echo $i; ?>" value="<?php echo $row['ket_p']; ?>"></center></td>
    <!-- lanjutkan dari day3 sampai day31 -->
    
            </tr>
    
                                        <?php
                                       
                                        } 
                                        }
                                       
                                                                                    
                                }
                                   
                                }
                                else {
                                    ?>
                                    <tr>
                                    <td colspan=33>
                                        Data pemeliharaan kosong, Silahkan tambahkan pada menu data pemeliharaan terlebih dahulu.
                                    </td>
                                    </tr>
                                    <?php
                                }
         
                            ?>
        
        
                   

<tr bgcolor="#eee">
<td colspan="33"><b>Pemeliharaan Mingguan</b></td>
           
        </tr>
        <?php
        $x = 0;

        $xx = 0;
        
       
        

        $sql="SELECT * FROM pemeliharaan_ming WHERE id_al = $alat AND status_pem_ming = 1";
       $result=mysqli_query($conn,$sql);
            if(!$conn){
                die("Could not connect to the database".mysqli_connect_error());
            }
            while($row=mysqli_fetch_array($result))
            {
            $id_p_m = $row['id_p_m'];
            $sql_tambah_ming="INSERT IGNORE INTO trans_tot values (NULL,'$merk','$id_p_m','2','$datepicker',now()
            ,0,0,0,0,0,0,0,0,0,0
            ,0,0,0,0,0,0,0,0,0,0
            ,0,0,0,0,0,0,0,0,0,0,0,'',1)";
            mysqli_query($conn, $sql_tambah_ming);
            }
        

                                        $sql_pem="SELECT DISTINCT id_k FROM pemeliharaan_ming WHERE id_al=$alat AND status_pem_ming = 1";
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
                                        AND alat.id_al=$alat AND trans_tot.id_m=$merk AND pemeliharaan_ming.id_k=$id_k AND trans_tot.type_p=2 AND datetime_a  LIKE '$datepicker%'";
                                        
                                        }
                                        else {
                                            $sql="SELECT * FROM trans_tot,pemeliharaan_ming,kegiatan,alat
                                        WHERE trans_tot.id_p=pemeliharaan_ming.id_p_m AND pemeliharaan_ming.id_k=kegiatan.id_k 
                                        AND pemeliharaan_ming.id_al=alat.id_al 
                                        AND alat.id_al=$alat AND trans_tot.id_m=$merk AND pemeliharaan_ming.id_k=$id_k AND trans_tot.type_p=2 AND datetime_a  LIKE '$datepicker%'";
                                        
                                        }
                                        
                                        $result=mysqli_query($conn,$sql);
                                        $vika=mysqli_num_rows($result);
                                        if($vika == 1)
                                        {
                                            while($row=mysqli_fetch_array($result))
                                            {
                                                $i++;
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
                                                    <tr>
                                                  <td colspan=33><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b></td>
                                              </tr>
    <tr bgcolor=<?php echo $merahu; ?>>
    <td>&nbsp;&nbsp;&nbsp; - <?php echo $row['nama_pem_ming']?> <input name="id_tot<?php echo $i; ?>" type="hidden" id="id_tot" value="<?php echo $row['id_tot']; ?>"></td>
    <td><center><input type="checkbox" name="dayy1x<?php echo $i; ?>"  <?php if ($row['day1'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy2x<?php echo $i; ?>" <?php if ($row['day2'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy3x<?php echo $i; ?>" <?php if ($row['day3'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy4x<?php echo $i; ?>" <?php if ($row['day4'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy5x<?php echo $i; ?>" <?php if ($row['day5'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy6x<?php echo $i; ?>" <?php if ($row['day6'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy7x<?php echo $i; ?>" <?php if ($row['day7'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy8x<?php echo $i; ?>" <?php if ($row['day8'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy9x<?php echo $i; ?>" <?php if ($row['day9'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy10x<?php echo $i; ?>" <?php if ($row['day10'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy11x<?php echo $i; ?>" <?php if ($row['day11'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy12x<?php echo $i; ?>" <?php if ($row['day12'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy13x<?php echo $i; ?>" <?php if ($row['day13'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy14x<?php echo $i; ?>" <?php if ($row['day14'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy15x<?php echo $i; ?>" <?php if ($row['day15'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy16x<?php echo $i; ?>" <?php if ($row['day16'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy17x<?php echo $i; ?>" <?php if ($row['day17'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy18x<?php echo $i; ?>" <?php if ($row['day18'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy19x<?php echo $i; ?>" <?php if ($row['day19'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy20x<?php echo $i; ?>" <?php if ($row['day20'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy21x<?php echo $i; ?>" <?php if ($row['day21'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy22x<?php echo $i; ?>" <?php if ($row['day22'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy23x<?php echo $i; ?>" <?php if ($row['day23'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy24x<?php echo $i; ?>" <?php if ($row['day24'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy25x<?php echo $i; ?>" <?php if ($row['day25'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy26x<?php echo $i; ?>" <?php if ($row['day26'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy27x<?php echo $i; ?>" <?php if ($row['day27'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy28x<?php echo $i; ?>" <?php if ($row['day28'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy29x<?php echo $i; ?>" <?php if ($row['day29'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy30x<?php echo $i; ?>" <?php if ($row['day30'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy31x<?php echo $i; ?>" <?php if ($row['day31'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="text" name="ket<?php echo $i; ?>" value="<?php echo $row['ket_p']; ?>"></center></td>
    <!-- lanjutkan dari day3 sampai day31 -->
    </tr>

            <?php

                }
        else
            {
            ?>
        <tr bgcolor=<?php echo $merahu; ?>>
        <td><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b><input name="id_tot<?php echo $i; ?>" type="hidden" id="id_tot" value="<?php echo $row['id_tot']; ?>"></td>
        <td><center><input type="checkbox" name="dayy1x<?php echo $i; ?>"  <?php if ($row['day1'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy2x<?php echo $i; ?>" <?php if ($row['day2'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy3x<?php echo $i; ?>" <?php if ($row['day3'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy4x<?php echo $i; ?>" <?php if ($row['day4'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy5x<?php echo $i; ?>" <?php if ($row['day5'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy6x<?php echo $i; ?>" <?php if ($row['day6'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy7x<?php echo $i; ?>" <?php if ($row['day7'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy8x<?php echo $i; ?>" <?php if ($row['day8'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy9x<?php echo $i; ?>" <?php if ($row['day9'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy10x<?php echo $i; ?>" <?php if ($row['day10'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy11x<?php echo $i; ?>" <?php if ($row['day11'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy12x<?php echo $i; ?>" <?php if ($row['day12'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy13x<?php echo $i; ?>" <?php if ($row['day13'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy14x<?php echo $i; ?>" <?php if ($row['day14'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy15x<?php echo $i; ?>" <?php if ($row['day15'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy16x<?php echo $i; ?>" <?php if ($row['day16'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy17x<?php echo $i; ?>" <?php if ($row['day17'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy18x<?php echo $i; ?>" <?php if ($row['day18'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy19x<?php echo $i; ?>" <?php if ($row['day19'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy20x<?php echo $i; ?>" <?php if ($row['day20'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy21x<?php echo $i; ?>" <?php if ($row['day21'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy22x<?php echo $i; ?>" <?php if ($row['day22'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy23x<?php echo $i; ?>" <?php if ($row['day23'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy24x<?php echo $i; ?>" <?php if ($row['day24'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy25x<?php echo $i; ?>" <?php if ($row['day25'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy26x<?php echo $i; ?>" <?php if ($row['day26'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy27x<?php echo $i; ?>" <?php if ($row['day27'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy28x<?php echo $i; ?>" <?php if ($row['day28'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy29x<?php echo $i; ?>" <?php if ($row['day29'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy30x<?php echo $i; ?>" <?php if ($row['day30'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy31x<?php echo $i; ?>" <?php if ($row['day31'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="text" name="ket<?php echo $i; ?>" value="<?php echo $row['ket_p']; ?>"></center></td>
    <!-- lanjutkan dari day3 sampai day31 -->
    
            </tr>
    
            <?php

                    }

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
                    $i++;
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
            <td>&nbsp;&nbsp;&nbsp; - <?php echo $row['nama_pem_ming']?> <input name="id_tot<?php echo $i; ?>" type="hidden" id="id_tot" value="<?php echo $row['id_tot']; ?>"></td>
            <td><center><input type="checkbox" name="dayy1x<?php echo $i; ?>"  <?php if ($row['day1'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy2x<?php echo $i; ?>" <?php if ($row['day2'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy3x<?php echo $i; ?>" <?php if ($row['day3'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy4x<?php echo $i; ?>" <?php if ($row['day4'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy5x<?php echo $i; ?>" <?php if ($row['day5'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy6x<?php echo $i; ?>" <?php if ($row['day6'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy7x<?php echo $i; ?>" <?php if ($row['day7'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy8x<?php echo $i; ?>" <?php if ($row['day8'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy9x<?php echo $i; ?>" <?php if ($row['day9'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy10x<?php echo $i; ?>" <?php if ($row['day10'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy11x<?php echo $i; ?>" <?php if ($row['day11'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy12x<?php echo $i; ?>" <?php if ($row['day12'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy13x<?php echo $i; ?>" <?php if ($row['day13'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy14x<?php echo $i; ?>" <?php if ($row['day14'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy15x<?php echo $i; ?>" <?php if ($row['day15'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy16x<?php echo $i; ?>" <?php if ($row['day16'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy17x<?php echo $i; ?>" <?php if ($row['day17'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy18x<?php echo $i; ?>" <?php if ($row['day18'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy19x<?php echo $i; ?>" <?php if ($row['day19'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy20x<?php echo $i; ?>" <?php if ($row['day20'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy21x<?php echo $i; ?>" <?php if ($row['day21'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy22x<?php echo $i; ?>" <?php if ($row['day22'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy23x<?php echo $i; ?>" <?php if ($row['day23'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy24x<?php echo $i; ?>" <?php if ($row['day24'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy25x<?php echo $i; ?>" <?php if ($row['day25'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy26x<?php echo $i; ?>" <?php if ($row['day26'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy27x<?php echo $i; ?>" <?php if ($row['day27'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy28x<?php echo $i; ?>" <?php if ($row['day28'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy29x<?php echo $i; ?>" <?php if ($row['day29'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy30x<?php echo $i; ?>" <?php if ($row['day30'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy31x<?php echo $i; ?>" <?php if ($row['day31'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="text" name="ket<?php echo $i; ?>" value="<?php echo $row['ket_p']; ?>"></center></td>
    <!-- lanjutkan dari day3 sampai day31 -->
    
            </tr>
    
                                        <?php
                                       
                                        } 
                                        }
                                       
                                                                                    
                                }
                                   
                                }
                                else {
                                    ?>
                                    <tr>
                                    <td colspan=33>
                                        Data pemeliharaan kosong, Silahkan tambahkan pada menu data pemeliharaan terlebih dahulu.
                                    </td>
                                    </tr>
                                    <?php
                                }
         
                            ?>
        
        
                  

<tr bgcolor="#eee">
<td colspan="33"><b>Pemeliharaan Bulanan</b></td>
           
        </tr>
        <?php

        $x = 0;

        $xx = 0;
        
       

        $sql="SELECT * FROM pemeliharaan_bul WHERE id_al = $alat AND status_pem_bul = 1";
        $result=mysqli_query($conn,$sql);
            if(!$conn){
                die("Could not connect to the database".mysqli_connect_error());
            }
            while($row=mysqli_fetch_array($result))
            {
            $id_p_b = $row['id_p_b'];
            $sql_tambah_bul="INSERT IGNORE INTO trans_tot values (NULL,'$merk','$id_p_b','3','$datepicker',now()
            ,0,0,0,0,0,0,0,0,0,0
            ,0,0,0,0,0,0,0,0,0,0
            ,0,0,0,0,0,0,0,0,0,0,0,'',1)";
            mysqli_query($conn, $sql_tambah_bul);
            }
        

                                        $sql_pem_bul="SELECT DISTINCT id_k FROM pemeliharaan_bul WHERE id_al=$alat AND status_pem_bul = 1";
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
                                        AND alat.id_al=$alat AND trans_tot.id_m=$merk AND pemeliharaan_bul.id_k=$id_k AND trans_tot.type_p=3 AND datetime_a  LIKE '$datepicker%'";
                                        
                                        }
                                        else {
                                            $sql="SELECT * FROM trans_tot,pemeliharaan_bul,kegiatan,alat
                                        WHERE trans_tot.id_p=pemeliharaan_bul.id_p_b AND pemeliharaan_bul.id_k=kegiatan.id_k 
                                        AND pemeliharaan_bul.id_al=alat.id_al 
                                        AND alat.id_al=$alat AND trans_tot.id_m=$merk AND pemeliharaan_bul.id_k=$id_k AND trans_tot.type_p=3 AND datetime_a  LIKE '$datepicker%'";
                                        
                                        }
                                        
                                        $result=mysqli_query($conn,$sql);
                                        $vika=mysqli_num_rows($result);
                                        if($vika == 1)
                                        {
                                            while($row=mysqli_fetch_array($result))
                                            {
                                                $i++;
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
    <td>&nbsp;&nbsp;&nbsp; - <?php echo $row['nama_pem_bul']?> <input name="id_tot<?php echo $i; ?>" type="hidden" id="id_tot" value="<?php echo $row['id_tot']; ?>"></td>
    <td><center><input type="checkbox" name="dayy1x<?php echo $i; ?>"  <?php if ($row['day1'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy2x<?php echo $i; ?>" <?php if ($row['day2'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy3x<?php echo $i; ?>" <?php if ($row['day3'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy4x<?php echo $i; ?>" <?php if ($row['day4'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy5x<?php echo $i; ?>" <?php if ($row['day5'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy6x<?php echo $i; ?>" <?php if ($row['day6'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy7x<?php echo $i; ?>" <?php if ($row['day7'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy8x<?php echo $i; ?>" <?php if ($row['day8'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy9x<?php echo $i; ?>" <?php if ($row['day9'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy10x<?php echo $i; ?>" <?php if ($row['day10'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy11x<?php echo $i; ?>" <?php if ($row['day11'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy12x<?php echo $i; ?>" <?php if ($row['day12'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy13x<?php echo $i; ?>" <?php if ($row['day13'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy14x<?php echo $i; ?>" <?php if ($row['day14'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy15x<?php echo $i; ?>" <?php if ($row['day15'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy16x<?php echo $i; ?>" <?php if ($row['day16'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy17x<?php echo $i; ?>" <?php if ($row['day17'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy18x<?php echo $i; ?>" <?php if ($row['day18'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy19x<?php echo $i; ?>" <?php if ($row['day19'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy20x<?php echo $i; ?>" <?php if ($row['day20'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy21x<?php echo $i; ?>" <?php if ($row['day21'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy22x<?php echo $i; ?>" <?php if ($row['day22'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy23x<?php echo $i; ?>" <?php if ($row['day23'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy24x<?php echo $i; ?>" <?php if ($row['day24'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy25x<?php echo $i; ?>" <?php if ($row['day25'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy26x<?php echo $i; ?>" <?php if ($row['day26'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy27x<?php echo $i; ?>" <?php if ($row['day27'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy28x<?php echo $i; ?>" <?php if ($row['day28'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy29x<?php echo $i; ?>" <?php if ($row['day29'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy30x<?php echo $i; ?>" <?php if ($row['day30'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy31x<?php echo $i; ?>" <?php if ($row['day31'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="text" name="ket<?php echo $i; ?>" value="<?php echo $row['ket_p']; ?>"></center></td>
    <!-- lanjutkan dari day3 sampai day31 -->
    </tr>

            <?php

                }
        else
            {
            ?>
    <tr bgcolor=<?php echo $merahu; ?>>
        <td><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b><input name="id_tot<?php echo $i; ?>" type="hidden" id="id_tot" value="<?php echo $row['id_tot']; ?>"></td>
        <td><center><input type="checkbox" name="dayy1x<?php echo $i; ?>"  <?php if ($row['day1'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy2x<?php echo $i; ?>" <?php if ($row['day2'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy3x<?php echo $i; ?>" <?php if ($row['day3'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy4x<?php echo $i; ?>" <?php if ($row['day4'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy5x<?php echo $i; ?>" <?php if ($row['day5'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy6x<?php echo $i; ?>" <?php if ($row['day6'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy7x<?php echo $i; ?>" <?php if ($row['day7'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy8x<?php echo $i; ?>" <?php if ($row['day8'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy9x<?php echo $i; ?>" <?php if ($row['day9'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy10x<?php echo $i; ?>" <?php if ($row['day10'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy11x<?php echo $i; ?>" <?php if ($row['day11'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy12x<?php echo $i; ?>" <?php if ($row['day12'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy13x<?php echo $i; ?>" <?php if ($row['day13'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy14x<?php echo $i; ?>" <?php if ($row['day14'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy15x<?php echo $i; ?>" <?php if ($row['day15'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy16x<?php echo $i; ?>" <?php if ($row['day16'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy17x<?php echo $i; ?>" <?php if ($row['day17'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy18x<?php echo $i; ?>" <?php if ($row['day18'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy19x<?php echo $i; ?>" <?php if ($row['day19'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy20x<?php echo $i; ?>" <?php if ($row['day20'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy21x<?php echo $i; ?>" <?php if ($row['day21'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy22x<?php echo $i; ?>" <?php if ($row['day22'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy23x<?php echo $i; ?>" <?php if ($row['day23'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy24x<?php echo $i; ?>" <?php if ($row['day24'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy25x<?php echo $i; ?>" <?php if ($row['day25'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy26x<?php echo $i; ?>" <?php if ($row['day26'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy27x<?php echo $i; ?>" <?php if ($row['day27'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy28x<?php echo $i; ?>" <?php if ($row['day28'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy29x<?php echo $i; ?>" <?php if ($row['day29'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy30x<?php echo $i; ?>" <?php if ($row['day30'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy31x<?php echo $i; ?>" <?php if ($row['day31'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="text" name="ket<?php echo $i; ?>" value="<?php echo $row['ket_p']; ?>"></center></td>
    <!-- lanjutkan dari day3 sampai day31 -->
    
            </tr>
    
            <?php

                    }

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
                    $i++;
                    ?>
        <tr bgcolor=<?php echo $merahu; ?>>
            <td>&nbsp;&nbsp;&nbsp; - <?php echo $row['nama_pem_bul']?> <input name="id_tot<?php echo $i; ?>" type="hidden" id="id_tot" value="<?php echo $row['id_tot']; ?>"></td>
            <td><center><input type="checkbox" name="dayy1x<?php echo $i; ?>"  <?php if ($row['day1'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy2x<?php echo $i; ?>" <?php if ($row['day2'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy3x<?php echo $i; ?>" <?php if ($row['day3'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy4x<?php echo $i; ?>" <?php if ($row['day4'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy5x<?php echo $i; ?>" <?php if ($row['day5'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy6x<?php echo $i; ?>" <?php if ($row['day6'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy7x<?php echo $i; ?>" <?php if ($row['day7'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy8x<?php echo $i; ?>" <?php if ($row['day8'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy9x<?php echo $i; ?>" <?php if ($row['day9'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy10x<?php echo $i; ?>" <?php if ($row['day10'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy11x<?php echo $i; ?>" <?php if ($row['day11'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy12x<?php echo $i; ?>" <?php if ($row['day12'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy13x<?php echo $i; ?>" <?php if ($row['day13'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy14x<?php echo $i; ?>" <?php if ($row['day14'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy15x<?php echo $i; ?>" <?php if ($row['day15'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy16x<?php echo $i; ?>" <?php if ($row['day16'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy17x<?php echo $i; ?>" <?php if ($row['day17'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy18x<?php echo $i; ?>" <?php if ($row['day18'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy19x<?php echo $i; ?>" <?php if ($row['day19'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy20x<?php echo $i; ?>" <?php if ($row['day20'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy21x<?php echo $i; ?>" <?php if ($row['day21'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy22x<?php echo $i; ?>" <?php if ($row['day22'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy23x<?php echo $i; ?>" <?php if ($row['day23'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy24x<?php echo $i; ?>" <?php if ($row['day24'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy25x<?php echo $i; ?>" <?php if ($row['day25'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy26x<?php echo $i; ?>" <?php if ($row['day26'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy27x<?php echo $i; ?>" <?php if ($row['day27'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy28x<?php echo $i; ?>" <?php if ($row['day28'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy29x<?php echo $i; ?>" <?php if ($row['day29'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy30x<?php echo $i; ?>" <?php if ($row['day30'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="checkbox" name="dayy31x<?php echo $i; ?>" <?php if ($row['day31'] == 1) { echo "checked='checked'"; } ?></center></td>
            <td><center><input type="text" name="ket<?php echo $i; ?>" value="<?php echo $row['ket_p']; ?>"></center></td>
    <!-- lanjutkan dari day3 sampai day31 -->
    
            </tr>
    
                                        <?php
                                       
                                        } 
                                        }
                                       
                                                                                    
                                }
                                   
                                }
                                else {
                                    ?>
                                    <tr>
                                    <td colspan=33>
                                        Data pemeliharaan kosong, Silahkan tambahkan pada menu data pemeliharaan terlebih dahulu.
                                    </td>
                                    </tr>
                                    <?php
                                }
         
                            ?>
        
                                        
                                    <input type="hidden" name="n" value="<?php echo $i ?>" />
        <?php 
        }
        else
        {
            ?>
            <tr bgcolor="#eee">
        <td colspan="33"><b>No data</b></td>
            
           
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