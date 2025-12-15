<?php
include  "../koneksi/koneksi.php";     $sql = mysqli_query($koneksi,"SELECT  * FROM temp_transaksi where  status='0' order by time DESC");	if(mysqli_num_rows($sql) > 0) {		$row = mysqli_fetch_assoc($sql);			if($row['sebelum'] != $row['nomor_antrian'] ){                echo '1';			} else {				echo '0';			}	}
     
?>
