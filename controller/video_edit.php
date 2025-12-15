<?php

include  "../koneksi/koneksi.php";

$tipe = $_POST['tipe'];



$sql = "UPDATE aplikasi set tipe='$tipe' where 1";
$proses = mysqli_query($koneksi,$sql);
	if ($proses) {
		header('location:../video?sukses='.base64_encode("Data  berhasil diupdate").'');
	} else { echo "Data belum dapat di simpan!!"; 
	}
?>

