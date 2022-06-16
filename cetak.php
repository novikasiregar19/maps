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
        <title>Print <?php echo date("d/m/Y"); ?></title>

<style>
    @media print{@page {size: landscape}}

    body{
        font-size : 12px;
    }
    
</style>
    </head>

    <body class="sb-nav-fixed">
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
    <br>
    <br>
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


    <input type="hidden" name="idx_alat" value="<?php echo $alat ?>" />
    <input type="hidden" name="idx_merk" value="<?php echo $merk ?>" />
    <input type="hidden" name="datepickerx" value="<?php echo $datepicker ?>" />
    

    <table width="100%" border="1">
        <thead>
        <tr>
            <th style="text-align:center" rowspan="2">Uraian Kegiatan</th>
            <th style="text-align:center" colspan="31">Tanggal Kegiatan</th>
            <th style="text-align:center" rowspan="2">Keterangan</th>
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
                                        if(trim($row['ket_p']) != "")
                                        {
                                            $merahu = "#fec4c1";
                                        }
                                        else
                                        {
                                            $merahu = "";
                                        }
                                        if($row['status_set'] == 0)
                                        {
                                            $merahuc = 'style="display: none;"';
                                            $x--;
                                        }
                                        else
                                        {
                                            $merahuc = '';
                                        }
                                        if($row['nama_pem'] != "")
                                        {
                                            ?>
                                            <tr <?php echo $merahuc;?>>
                                          <td colspan=34><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b></td>
                                      </tr>
                            
                                      <tr <?php echo $merahuc;?>>
<td>&nbsp;&nbsp;&nbsp; - <?php echo $row['nama_pem']?></td>
                        <td> <center><?php if ($row['day1'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day2'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day3'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day4'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day5'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day6'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day7'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day8'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day9'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day10'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day11'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day12'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day13'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day14'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day15'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day16'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day17'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day18'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day19'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day20'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day21'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day22'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day23'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day24'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day25'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day26'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day27'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day28'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day29'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day30'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day31'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php echo $row['ket_p']; ?></center></td>
<!-- lanjutkan dari day3 sampai day31 -->

    </tr> <?php

                }
                else
                {
                    ?>
                    <tr <?php echo $merahuc;?>>
                    <td><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b></td>
                    <td> <center><?php if ($row['day1'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day2'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day3'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day4'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day5'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day6'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day7'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day8'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day9'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day10'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day11'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day12'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day13'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day14'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day15'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day16'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day17'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day18'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day19'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day20'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day21'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day22'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day23'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day24'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day25'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day26'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day27'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day28'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day29'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day30'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day31'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php echo $row['ket_p']; ?></center></td>
<!-- lanjutkan dari day3 sampai day31 -->
</tr>
                                      <?php

                                  }
                                  ?>
                                              <?php
                                }
                            }
                                else
                                {
                                   
                                    ?>
                                    <tr >
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
                                        if($row['status_set'] == 0)
                                        {
                                            $merahuc = 'style="display: none;"';
                                        }
                                        else
                                        {
                                            $merahuc = '';
                                        }
                                        
                                ?>


<tr <?php echo $merahuc;?>>
    <td>&nbsp;&nbsp;&nbsp; - <?php echo $row['nama_pem']?> </td>
    <td> <center><?php if ($row['day1'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day2'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day3'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day4'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day5'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day6'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day7'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day8'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day9'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day10'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day11'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day12'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day13'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day14'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day15'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day16'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day17'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day18'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day19'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day20'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day21'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day22'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day23'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day24'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day25'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day26'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day27'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day28'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day29'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day30'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day31'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php echo $row['ket_p']; ?></center></td>
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
                                        if($row['status_set'] == 0)
                                        {
                                            $merahuc = 'style="display: none;"';
                                            $x--;
                                        }
                                        else
                                        {
                                            $merahuc = '';
                                        }
                                        if($row['nama_pem_ming'] != "")
                                        {
                                            ?>
                                           <tr <?php echo $merahuc;?>>
                                          <td colspan=33><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b></td>
                                      </tr>
                                      <tr <?php echo $merahuc;?>>
                <td>&nbsp;&nbsp;&nbsp; - <?php echo $row['nama_pem_ming']?> </td>
                        <td> <center><?php if ($row['day1'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day2'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day3'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day4'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day5'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day6'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day7'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day8'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day9'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day10'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day11'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day12'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day13'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day14'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day15'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day16'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day17'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day18'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day19'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day20'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day21'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day22'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day23'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day24'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day25'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day26'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day27'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day28'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day29'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day30'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day31'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td> 
                        <td> <center><?php echo $row['ket_p']; ?></center></td>
                        </tr>
                        <?php

                                }
                        else
                            {
                            ?>
<tr <?php echo $merahuc;?>>
<td><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b></td>
<td> <center><?php if ($row['day1'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day2'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day3'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day4'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day5'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day6'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day7'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day8'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day9'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day10'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day11'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day12'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day13'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day14'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day15'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day16'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day17'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day18'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day19'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day20'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day21'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day22'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day23'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day24'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day25'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day26'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day27'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day28'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day29'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day30'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day31'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td> 
                        <td> <center><?php echo $row['ket_p']; ?></center></td>

    </tr>

    <?php

            }
            ?>
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
                                        if($row['status_set'] == 0)
                                        {
                                            $merahuc = 'style="display: none;"';
                                        }
                                        else
                                        {
                                            $merahuc = '';
                                        }
            ?>

<tr <?php echo $merahuc;?>>
    <td>&nbsp;&nbsp;&nbsp; - <?php echo $row['nama_pem_ming']?> </td>
    <td> <center><?php if ($row['day1'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day2'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day3'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day4'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day5'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day6'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day7'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day8'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day9'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day10'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day11'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day12'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day13'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day14'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day15'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day16'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day17'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day18'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day19'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day20'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day21'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day22'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day23'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day24'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day25'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day26'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day27'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day28'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day29'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day30'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day31'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td> 
                        <td> <center><?php echo $row['ket_p']; ?></center></td>

    </tr>
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
                                        if($row['status_set'] == 0)
                                        {
                                            $merahuc = 'style="display: none;"';
                                            $x--;
                                        }
                                        else
                                        {
                                            $merahuc = '';
                                        }
                                        if($row['nama_pem_bul'] != "")
                                        {
                                            ?>
                                            <tr <?php echo $merahuc;?>>
                                          <td colspan=33><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b></td>
                                      </tr>
                                      <tr <?php echo $merahuc;?>>
                <td>&nbsp;&nbsp;&nbsp; - <?php echo $row['nama_pem_bul']?> </td>
                        <td> <center><?php if ($row['day1'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day2'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day3'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day4'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day5'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day6'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day7'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day8'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day9'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day10'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day11'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day12'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day13'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day14'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day15'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day16'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day17'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day18'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day19'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day20'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day21'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day22'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day23'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day24'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day25'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day26'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day27'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day28'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day29'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day30'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day31'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td> 
                        <td> <center><?php echo $row['ket_p']; ?></center></td>

    </tr>
                        <?php

                                }
                                else
                                {
                                ?>
              <tr <?php echo $merahuc;?>>
                <td><b>&nbsp;<?php echo $x; ?>. <?php echo $row['nama_keg']?> </b></td>
                        <td> <center><?php if ($row['day1'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day2'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day3'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day4'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day5'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day6'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day7'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day8'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day9'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day10'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day11'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day12'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day13'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day14'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day15'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day16'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day17'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day18'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day19'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day20'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day21'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day22'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day23'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day24'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day25'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day26'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day27'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day28'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day29'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day30'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day31'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td> 
                        <td> <center><?php echo $row['ket_p']; ?></center></td>
    </tr>
                <?php

                        }
?>
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
                                        if($row['status_set'] == 0)
                                        {
                                            $merahuc = 'style="display: none;"';
                                        }
                                        else
                                        {
                                            $merahuc = '';
                                        }
                        ?>
                      <tr <?php echo $merahuc;?>>
                    <td>&nbsp;&nbsp;&nbsp; - <?php echo $row['nama_pem_bul']?> </td>
                        <td> <center><?php if ($row['day1'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day2'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day3'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day4'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day5'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day6'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day7'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day8'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day9'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day10'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day11'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day12'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day13'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day14'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day15'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day16'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day17'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day18'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day19'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day20'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day21'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day22'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day23'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day24'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day25'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day26'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day27'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day28'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day29'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day30'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td>
                        <td> <center><?php if ($row['day31'] == 1) { ?> <i class="fa fa-check"></i><?php } else {echo "<img src='images/arsir.png'>";}?> </center></td> 
                        <td> <center><?php echo $row['ket_p']; ?></center></td>
    </tr>
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
<tr>
        <td><center><b>TEKNISI PELAKSANA</b></center></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

        </tr>

        <tr>
        <td><center><b>PENGAWAS</b></center></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

    </tbody>

        
        
</table>
    <table border=0 width=100%>
        <tr valign="top">
            <td width=40%>Keterangan: <br>
            <i class="fa fa-check"></i> = Normal <br>
            G = Ada Gangguan
        </td>
            <td width=40%></td>
            <td width=20%>
            <?php
                $sql="SELECT nama_kar, jabatan FROM karyawan, sign WHERE karyawan.id_kar=sign.id_kar AND sign.status='1'";
                $result=mysqli_query($conn,$sql);
                $row=mysqli_fetch_array($result);
            ?>
            <center>Mengetahui,<br>
            <?php echo $row['jabatan'];
            ?>
            <br>
            <br>
            <br>
            <br>
            <?php echo $row['nama_kar'];
            ?>
            </center></td>

        </tr>
    </tabble>


<script>
    $(document).ready(function() {
    $('#dataTables').DataTable();
} );

$("#datepicker").datepicker( {
    format: "yyyy-mm",
    startView: "months", 
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

<script>
    window.print()
</script>

<?php
// Close connection
mysqli_close($conn);
?>
</div>
    </div>

</body>
</html>