<?php
include  "../koneksi/koneksi.php";
				$skr=date('Y-m-d');	
     $sql = mysql_query("SELECT * from antrian WHERE kategori='$_GET[kode]' AND date(date_antri)='$skr' AND status='0'");
      $r    = mysql_num_rows($sql);
        
      echo $r;
?>
