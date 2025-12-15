<?php
include  "../koneksi/koneksi.php";
     $sql = mysqli_query($koneksi,"SELECT nomor_antrian FROM temp_transaksi order by time DESC");
      $r    = mysqli_fetch_array($sql);
        $nomor = $r['nomor_antrian'];
      echo $r['nomor_antrian'];
?>
