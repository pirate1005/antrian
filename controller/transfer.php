<?php
include '../koneksi/koneksi.php';

$id_antrian  = $_POST['id_antrian'];
$kode_tujuan = $_POST['kode_tujuan']; // Contoh: A, B, C

// 1. Ambil data lama untuk history jika perlu (opsional)
$cek = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM antrian WHERE id='$id_antrian'"));

if($cek){
    // 2. Update Kategori ke tujuan baru & Reset Status jadi 0 (Menunggu)
    // Jadi antrian ini akan hilang dari loket ini, dan muncul di loket tujuan
    mysqli_query($koneksi, "UPDATE antrian SET kategori='$kode_tujuan', status='0' WHERE id='$id_antrian'");
}

header("location:../index.php");
?>