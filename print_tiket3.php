<?php 
include 'koneksi/koneksi.php'; 

// Ambil Data dari URL
$id       = $_GET['id'];
$kategori = $_GET['kategori'];
$date     = $_GET['date'];
$skr      = date('Y-m-d');

// Query Data (Diganti ke mysqli_query)
$d_print  = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * from antrian WHERE no_antrian='$id' AND kategori='$kategori' AND date_antri='$date'")); 
$sisa     = mysqli_num_rows(mysqli_query($koneksi, "SELECT * from antrian WHERE kategori='$kategori' AND date(date_antri)='$skr' AND status='0'")); 
$layanan  = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * from loket where kode='$kategori'"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Tiket</title>
    <style>
        /* Reset Printer Margin */
        @page {
            size: auto;
            margin: 0mm;
        }

        body {
            font-family: 'Courier New', Courier, monospace; /* Font struk */
            background: #fff;
            color: #000;
            margin: 0;
            padding: 5px;
            text-align: center;
        }

        /* Wrapper Struk */
        #detail {
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
        }

        /* Elemen Struk */
        .company-name {
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        
        .address {
            font-size: 11px;
            margin-bottom: 10px;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
        }

        .app-name {
            font-size: 12px;
            margin-top: 5px;
        }

        .ticket-number {
            font-size: 70px; /* Angka Besar */
            font-weight: 800;
            line-height: 1;
            margin: 10px 0;
        }

        .service-name {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .meta-info {
            font-size: 12px;
            border-top: 1px dashed #000;
            padding-top: 10px;
            margin-top: 10px;
        }

        .footer-msg {
            font-size: 11px;
            margin-top: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body onLoad="printContent('detail')">

    <div id="detail">
        <div class="company-name"><?= $app['nama_perusahaan']; ?></div>
        <div class="address"><?= $app['alamat']; ?></div>

        <div class="app-name"><?= $app['nama_aplikasi']; ?></div>
        
        <div class="ticket-number">
            <?= $d_print['no_antrian']; ?>
        </div>

        <div class="service-name">
            <?= $layanan['nama_layanan']; ?>
        </div>

        <div class="meta-info">
            <div><?= $d_print['date_antri']; ?></div>
            <div>Sisa Antrian: <b><?= $sisa - 1; ?></b></div>
        </div>

        <div class="footer-msg">
            Silahkan Menunggu<br>
            Terima Kasih
        </div>
        <br>
    </div>

    <script>
        function printContent(el) {
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            
            document.body.innerHTML = printcontent;
            
            // Print Dialog
            window.print();
            
            document.body.innerHTML = restorepage;
            
            // Redirect otomatis setelah print (dalam 1 detik)
            // Ganti 'tiket3' sesuai dengan halaman tujuan Anda (misal tiket3.php)
            setTimeout(function() {
                window.location.href = 'tiket3'; 
            }, 1000);
        }
    </script>

</body>
</html>