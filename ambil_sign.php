<?php
include "koneksi.php";
if (isset($_POST['id_kar'])) {
    $id_kar = $_POST["id_kar"];

    $sql = "select * from karyawan where id_kar=$id_kar";
    $hasil = mysqli_query($conn, $sql);
   
            while ($data = mysqli_fetch_array($hasil)) {
        
                $id_jab = $data['jabatan'];
                ?>
                <option value="<?php echo $id_jab; ?>"><?php echo $id_jab; ?></option>
                <?php
            }
            
            
    
}

?>