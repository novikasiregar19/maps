<?php
//delete.php
$connect = mysqli_connect("localhost", "root", "", "jadwal_pel");
if(isset($_POST["id_k"]))
{
 foreach($_POST["id_k"] as $id_k)
 {
  $query = "DELETE FROM kegiatan WHERE id_k = '".$id_k."'";
  mysqli_query($connect, $query);
 }
}
?>