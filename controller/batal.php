<?php

include  "../koneksi/koneksi.php";
$id=$_GET['id'];
$skr = date('Y-m-d H:i:s');
$sql = "UPDATE antrian SET status='2' , date_proses='$skr' WHERE id = '$id'";
$proses = mysqli_query($koneksi,$sql);
if ($proses) {
		header('location:../index?sukses='.base64_encode("Antrian id ".$id." Telah dibatalkan").'');
	} else { echo "Data belum dapat di simpan!!"; 
	}
?>