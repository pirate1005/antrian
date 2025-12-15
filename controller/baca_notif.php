<?php

include  "../koneksi/koneksi.php";
$kategori=$_GET['kode'];
mysqli_query($koneksi,"UPDATE antrian SET notif='1'  WHERE kategori = '$kategori'");
?>