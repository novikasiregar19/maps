<?php
    $conn=mysqli_connect("localhost","root","","jadwal_pel");
    $sql="SELECT * FROM alat";
    $result=mysqli_query($conn,$sql);
    if(!$conn){
        die("Could not connect to the database".mysqli_connect_error());
    }
    $jadwal_pel = new database();

    foreach ($jadwal_pel->login($username) as $x) {
        $akses_id = $x['akses_id'];
        if ($akses_id == '1'){

            if (isset($_GET['id'])) {
                $kode_peminjam = $_GET['id'];
                $data_peminjam = $db->kode_peminjam($kode_peminjam);
                $kode_peminjam = $data_peminjam[0]['kode_peminjam'];
                $db->hapus_data_peminjam($kode_peminjam);
                header('Location: tampilkan_data_peminjam.php');
            }
            else
            {
                header('Location: tampilkan_data_peminjam.php');
            }
        }
    }
?>