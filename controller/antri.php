<?php include  "../koneksi/koneksi.php";
$kategori = $_GET['kategori'];
$skr = date('Y-m-d');
$d = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from loket where kode='$kategori'"));
$loket=$d['loket'];
// membaca kode / nilai tertinggi dari penomoran yang ada didatabase berdasarkan tanggal
$query = "SELECT max(no) as maxKode FROM antrian where date(date_antri) = '$skr' and kategori='$kategori' ";
$hasil = mysqli_query($koneksi,$query);
$data  = mysqli_fetch_array($hasil);
$kodek = $data['maxKode']+1;if($kodek<10){$kkode=''.$kategori.'-0'.$kodek;}else{$kkode=''.$kategori.'-'.$kodek;}
$sisa= mysqli_num_rows(mysqli_query($koneksi,"SELECT * from antrian WHERE kategori='$kategori' AND date(date_antri)='$skr' AND status='0'")); 
$date_antri = date('Y-m-d H:i:s');



$sql = "INSERT INTO antrian (kategori, no, no_antrian, date_antri, loket) VALUES ('$kategori','$kodek','$kkode','$date_antri','$loket')";

$proses = mysqli_query($koneksi,$sql);
	if ($proses) {
		header('location:../print_tiket?id='.$kkode.'&kategori='.$kategori.'&date='.$date_antri.'');
	} else { echo "Data belum dapat di simpan!!"; 
	}


?>
