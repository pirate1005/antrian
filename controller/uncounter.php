<?php
include  "../koneksi/koneksi.php";

$loket=$_POST['loket'];$kategori=$_POST['kategori'];$nomor=$_POST['nomor'];
$skr = date ('Y-m-d H:i:s');
mysqli_query($koneksi,"UPDATE temp_transaksi SET sebelum='' WHERE loket = '$loket'");
?>