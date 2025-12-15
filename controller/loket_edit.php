<?php

include  "../koneksi/koneksi.php";

$id = $_POST['id'];
$loket = $_POST['loket'];
$kode = $_POST['kode'];
$nama_layanan = $_POST['nama_layanan'];
$username = $_POST['username'];
$password = $_POST['password'];
$warna = $_POST['warna'];


$sql = "UPDATE loket set loket='$loket',kode='$kode' ,nama_layanan='$nama_layanan',username='$username',password='$password',warna='$warna',level='loket' where id='$id'";
$proses = mysqli_query($koneksi,$sql);
	if ($proses) {
		header('location:../loket?sukses='.base64_encode("Data Loket berhasil diupdate").'');
	} else { echo "Data belum dapat di simpan!!"; 
	}
?>

