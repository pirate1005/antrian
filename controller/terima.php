<?php
session_start();
include  "../koneksi/koneksi.php";
$id=$_GET['id'];$noantrian = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from antrian where id='$id'"));
$skr = date('Y-m-d H:i:s');
$sql = "UPDATE antrian SET status='1', date_proses='$skr' WHERE id = '$id'";
$proses = mysqli_query($koneksi,$sql);
if ($proses) {		mysqli_query($koneksi,"UPDATE temp_transaksi set sebelum ='$noantrian[no_antrian]', status='1' where loket='$_SESSION[loket]'");
		header('location:../index?sukses='.base64_encode("Antrian id ".$id." Telah diproses ").'');
	} else { echo "Data belum dapat di simpan!!"; 
	}
?>