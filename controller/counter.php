<?php
include  "../koneksi/koneksi.php";
$id=$_GET['id'];
$data = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from antrian where id='$id'"));
$loket=$data['loket'];
$nomor_antrian = $data['no_antrian'];
$kategori=$_GET['kategori'];$nomor=$_GET['nomor'];
$skr = date ('Y-m-d H:i:s');
mysqli_query($koneksi,"UPDATE temp_transaksi SET sebelum='call', kategori='$kategori', nomor='$nomor',nomor_antrian='$nomor_antrian', time='$skr', status='0' WHERE loket = '$loket'");
mysqli_query($koneksi,"UPDATE antrian set date_panggil='$skr' where id='$id'");
?>