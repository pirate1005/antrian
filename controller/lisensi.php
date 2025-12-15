<?php


include  "../koneksi/koneksi.php";

$no_hp = $_POST['no_hp'];
$lisensi = $_POST['lisensi'];

$sql = "UPDATE aplikasi SET no_hp='$no_hp', lisensi='$lisensi' WHERE id = '1'";
$proses = mysqli_query($koneksi,$sql);
if ($proses) {
		header('location:../login?sukses='.base64_encode("Antrian id ".$id." Telah diproses ").'');
	} else { echo "Data belum dapat di simpan!!"; 
	}

?>

