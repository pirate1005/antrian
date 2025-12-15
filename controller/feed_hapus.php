<?php

include  "../koneksi/koneksi.php";

$id = $_GET['id'];

$sql = "DELETE from feed WHERE id='$id'";
$proses = mysqli_query($koneksi,$sql);
	if ($proses) {
		header('location:../feed?sukses='.base64_encode("Data runing text telah dihapus").'');
	} else { echo "Data belum dapat di simpan!!"; 
	}
?>
