<?php
include "koneksi.php";
if (isset($_POST['nama_kar'])) {
    $id_kar = $_POST["nama_kar"];

    $sql = "select * from karyawan where nama_kar=$nama_kar";
    $hasil = mysqli_query($conn, $sql);
   
            while ($data = mysqli_fetch_array($hasil)) {
        
                $id_jabb = $data['jabatan'];
                ?>
                <option value="<?php echo $id_jabb; ?>"><?php echo $id_jabb; ?></option>
                <?php
            }
            
            
    
}

?>