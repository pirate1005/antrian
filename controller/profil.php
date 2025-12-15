<?php

include  "../koneksi/koneksi.php";
$id = $_GET['id'];
$password = $_POST['password'];
$sql = "UPDATE loket SET password='$password' WHERE id = '$id' and level='admin'";
$proses = mysqli_query($koneksi,$sql);
if ($proses) {
		header('location:../profil?sukses='.base64_encode("Password sudah diubah").'');
	} else { echo "Data belum dapat di simpan!!"; 
	}
?>