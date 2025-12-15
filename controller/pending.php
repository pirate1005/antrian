<?php
include '../koneksi/koneksi.php';
$id = $_GET['id'];

// Ubah status menjadi 3 (Pending)
// Asumsi di database kolom 'status' tipe datanya mendukung angka 3
mysqli_query($koneksi, "UPDATE antrian SET status='3' WHERE id='$id'");

header("location:../index.php");
?>