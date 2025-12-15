<?php

include  "../koneksi/koneksi.php";

$loket = $_POST['loket'];
$kode = $_POST['kode'];
$nama_layanan = $_POST['nama_layanan'];
$username = $_POST['username'];
$password = $_POST['password'];
$warna = $_POST['warna'];

$cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * from loket where loket='$loket' "));

if ($cek==1){
	header('location:../loket?error='.base64_encode("loket dengan kode atau nomor tersebut sudah ada").'');
}else {

$sql = "INSERT INTO loket (loket,kode,nama_layanan,username,password,warna,level) VALUES ('$loket','$kode','$nama_layanan', '$username', '$password', '$warna', 'loket')";
} 
$proses = mysqli_query($koneksi,$sql);
	if ($proses) {
		header('location:../loket?sukses='.base64_encode("Data Loket berhasil ditambah").'');
	} else { echo "Data belum dapat di simpan!!"; 
	}
?>

