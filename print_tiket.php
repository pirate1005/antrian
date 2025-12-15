<?php 
include 'koneksi/koneksi.php'; 

// Ambil Data
$id       = $_GET['id'];
$kategori = $_GET['kategori'];
$date     = $_GET['date'];
$skr      = date('Y-m-d');

// Query Data Antrian
$d_print  = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * from antrian WHERE no_antrian='$id' AND kategori='$kategori' AND date_antri='$date'")); 

// Hitung Sisa Antrian
$sisa     = mysqli_num_rows(mysqli_query($koneksi, "SELECT * from antrian WHERE kategori='$kategori' AND date(date_antri)='$skr' AND status='0'")); 

// Ambil Nama Layanan
$layanan  = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * from loket where kode='$kategori'"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Tiket</title>
    <style>
        /* Pengaturan Kertas saat Print */
        @page {
            size: auto;   /* auto is the initial value */
            margin: 0;  /* Hilangkan margin default printer */
        }
        
        body {
            font-family: 'Courier New', monospace; /* Font struk */
            margin: 0;
            padding: 5px;
            background-color: #fff;
            color: #000;
        }

        /* Container Struk */
        #detail {
            width: 100%;
            max-width: 300px; /* Batas lebar agar tampilan di layar mirip kertas struk */
            margin: 0 auto;
            text-align: center;
        }

        /* Elemen Struk */
        .company-name {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .address {
            font-size: 10px;
            margin-bottom: 10px;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
        }
        .app-name {
            font-size: 12px;
            margin-top: 10px;
        }
        .ticket-number {
            font-size: 55px; /* Ukuran Besar untuk Nomor */
            font-weight: 800;
            margin: 5px 0;
            line-height: 1;
        }
        .service-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .meta-info {
            font-size: 11px;
            margin-top: 15px;
            border-top: 1px dashed #000;
            padding-top: 10px;
        }
        .footer-msg {
            font-size: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body onLoad="printContent('detail')">

    <div id="detail">
        <div class="company-name"><?= $app['nama_perusahaan']; ?></div>
        <div class="address"><?= $app['alamat']; ?></div>

        <div class="app-name"><?= $app['nama_aplikasi']; ?></div>
        <div style="font-size: 12px; margin-top: 5px;">Nomor Antrian Anda:</div>
        
        <div class="ticket-number"><?= $d_print['no_antrian']; ?></div>
        
        <div class="service-name"><?= $layanan['nama_layanan']; ?></div>

        <div class="meta-info">
            <div>Tanggal: <?= $d_print['date_antri']; ?></div>
            <div>Sisa Antrian: <b><?= $sisa - 1; ?></b></div>
        </div>

        <div class="footer-msg">
            Terima Kasih<br>
            Mohon Menunggu Panggilan
        </div>
        <br>
    </div>

    <script>
        function printContent(el) {
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            
            // Set konten body hanya isi tiket untuk diprint
            document.body.innerHTML = printcontent;
            
            // Lakukan Print
            window.print();
            
            // Kembalikan konten asli (opsional karena akan redirect)
            document.body.innerHTML = restorepage;
            
            // Redirect kembali ke halaman ambil tiket setelah 1 detik
            setTimeout(function() {
                window.location.href = 'tiket';
            }, 1000);
        }
    </script>

</body>
</html>