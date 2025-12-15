<?php include '../koneksi/koneksi.php';$kategori = $_GET['kategori'];$skr = date('Y-m-d');// membaca kode / nilai tertinggi dari penomoran yang ada didatabase berdasarkan tanggal$query = "SELECT max(no) as maxKode FROM antrian where  kategori='$kategori' ";$hasil = mysql_query($query);$data  = mysql_fetch_assoc($hasil);$kodek = $data['maxKode']+1;echo $kategori;


?>
