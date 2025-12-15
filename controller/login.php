<?php

session_start();

include  "../koneksi/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];
// query untuk mendapatkan record dari username
$query = "SELECT * FROM loket WHERE username = '$username'";
$hasil = mysqli_query($koneksi,$query);
$data = mysqli_fetch_array($hasil);
// cek kesesuaian password
if ($password == $data['password'])
{ 
    // menyimpan username dan level ke dalam session
	$_SESSION['id'] 			= $data['id'];
    $_SESSION['username'] 		= $data['username'];
	$_SESSION['loket']     		= $data['loket'];
	$_SESSION['kode']     		= $data['kode'];
	$_SESSION['level']     		= $data['level'];
	$_SESSION['nama_layanan']   = $data['nama_layanan'];
	if ($_SESSION['level']=='loket'){
    header('location:../index');
	} else if ($_SESSION['level']=='admin'){
    header('location:../setting');
	} 
}
else {
header('location: ../login?error='.base64_encode('Maaf Username dan Password Salah'));
        exit();
}
?>

