<?php
include  "../koneksi/koneksi.php";
     $sql = mysqli_query($koneksi,"SELECT loket FROM temp_transaksi order by time DESC");
      $r    = mysqli_fetch_array($sql);
$nm = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from loket where loket='$r[loket]'"));
       
      echo  $nm['nama_layanan'];
?>
