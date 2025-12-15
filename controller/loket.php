<?php
include  "../koneksi/koneksi.php";
     $sql = mysqli_query($koneksi,"SELECT * FROM temp_transaksi where loket='$_GET[kode]'");
      $r    = mysqli_fetch_array($sql);
      
      echo $r['nomor_antrian'];
?>
