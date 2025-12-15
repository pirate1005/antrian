<?php

include  "../koneksi/koneksi.php";

$tanggal = $_POST['tanggal'];
$feed = $_POST['feed'];
$status = $_POST['status'];



$sql = "INSERT INTO feed (tanggal, feed, status) VALUES ('$tanggal','$feed','$status')";

$proses = mysqli_query($koneksi,$sql);
	if ($proses) {
		header('location:../feed?sukses='.base64_encode("Data Running Text berhasil ditambah").'');
	} else { echo "Data belum dapat di simpan!!"; 
	}
?>

