<?php
include  "../koneksi/koneksi.php";	$kategori = $_GET['kode'];
     $sql = mysqli_query($koneksi,"SELECT  count(id) as jml FROM antrian where kategori='$kategori' and notif='0'");	if(mysqli_num_rows($sql) > 0) {		$row = mysqli_fetch_assoc($sql);                echo $row['jml'];	}
     
?>
