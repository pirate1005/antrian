<?php

include  "../koneksi/koneksi.php";

$id = $_GET['id'];

$sql = "DELETE from loket WHERE id='$id'";
$proses = mysqli_query($koneksi,$sql);
	if ($proses) {
		header('location:../loket?sukses='.base64_encode("Data loket telah dihapus").'');
	} else { echo "Data belum dapat di simpan!!"; 
	}
?>
