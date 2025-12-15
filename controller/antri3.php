<?php include  "../koneksi/koneksi.php";
$kategori = $_GET['kategori'];$skr = date('Y-m-d');// membaca kode / nilai tertinggi dari penomoran yang ada didatabase berdasarkan tanggal
$query = "SELECT max(no) as maxKode FROM antrian where date(date_antri) = '$skr' and kategori='$kategori' ";$hasil = mysql_query($query);$data  = mysql_fetch_array($hasil);$kodek = $data['maxKode']+1;if($kodek<10){$kkode=''.$kategori.'-0'.$kodek;}else{$kkode=''.$kategori.'-0'.$kodek;}$sisa= mysql_num_rows(mysql_query("SELECT * from antrian WHERE kategori='$kategori' AND date(date_antri)='$skr' AND status='0'")); 
$date_antri = date('Y-m-d H:i:s');



$sql = "INSERT INTO antrian (kategori, no, no_antrian, date_antri) VALUES ('$kategori','$kodek','$kkode','$date_antri')";

$proses = mysql_query($sql);
	if ($proses) {
		header('location:../print_tiket3?id='.$kkode.'&kategori='.$kategori.'&date='.$date_antri.'');
	} else { echo "Data belum dapat di simpan!!"; 
	}


?>
