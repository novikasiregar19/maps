<?php
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    ini_set('max_execution_time', 0);
    date_default_timezone_set('Asia/Jakarta');
    include "koneksi.php"
?>

    <?php
    $date = date('Y-m-d');
    $date_update = date('Y-m-d H:i:s');
       $sql="SELECT * FROM pemeliharaan WHERE id_al = 1";
       $result=mysqli_query($conn,$sql);
            if(!$conn){
                die("Could not connect to the database".mysqli_connect_error());
            }
            while($row=mysqli_fetch_array($result)){
                $id_p = $row['id_p'];
echo "$id_p <br>";
            $sqltambah="INSERT into trans_tot values ('','$id_p','$date','$date_update'
            ,'','','','','','','','','',''
            ,'','','','','','','','','',''
            ,'','','','','','','','','','','')";
            mysqli_query($conn, $sqltambah);
                        }
        
    ?>
    