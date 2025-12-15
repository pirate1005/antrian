<?php
session_start();
include  "../koneksi/koneksi.php";     
$sql = mysqli_query($koneksi,"SELECT  sebelum FROM temp_transaksi where sebelum='call' and kategori !='$_SESSION[kode]'");	
if(mysqli_num_rows($sql) > 0) {		
    $row = mysqli_fetch_assoc($sql);                
    echo '1';	
    
} else {		
    echo '0';	}
     
?>
