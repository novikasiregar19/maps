<?php
include "koneksi.php";
if (isset($_POST['alat'])) {
    $alat = $_POST["alat"];

    $sql = "select * from merk where id_al=$alat";
    $hasil = mysqli_query($conn, $sql);
    $ndata = mysqli_num_rows($hasil);
    if($ndata > 0)
        {
            while ($data = mysqli_fetch_array($hasil)) {
        
                $id_mm = $data['id_m'];
                $id_nm = $data['nama_merk'];
                ?>
                <option value="<?php echo $id_mm; ?>"><?php echo $id_nm; ?></option>
                <?php
            }
            
            
        }
        else {
            
            ?>
            <option value="0">-No Type-</option>
            <?php
        }
    
}

?>