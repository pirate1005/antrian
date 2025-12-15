<?php
$srvr="localhost"; //SESUAIKAN DENGAN WEBSERVER ANDA
$db="antrian_tomo"; //SESUAIKAN DENGAN WEBSERVER ANDA
$usr="root"; //SESUAIKAN DENGAN WEBSERVER ANDA
$pwd="";//SESUAIKAN DENGAN WEBSERVER ANDA


$koneksi=mysqli_connect($srvr,$usr,$pwd,$db);

$app = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from aplikasi"));
?>