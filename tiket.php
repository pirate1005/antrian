<?php include 'koneksi/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ambil Tiket - <?= $app['nama_aplikasi'];?></title>

    <link href="img/favicon.png" rel="icon" type="image/png">

    <link rel="stylesheet" href="css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap/bootstrap.min.css">

    <style>
        /* --- 1. GLOBAL STYLES --- */
        body {
            background-color: #f5f8fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0; padding: 0;
            overflow-x: hidden;
            padding-bottom: 80px; /* Space untuk footer */
        }

        /* --- 2. HEADER (Sama dengan Display agar seragam) --- */
        .site-header {
            height: 120px;
            background: <?= $app['header'];?>;
            border-bottom: 5px solid #d9aa00;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            position: fixed;
            top: 0; width: 100%; z-index: 100;
        }
        .header-logo img { height: 90px; }
        .header-center { text-align: center; color: <?= $app['text_header']?>; flex-grow: 1; }
        .header-center h1 { margin: 0; font-size: 28px; font-weight: 800; text-transform: uppercase; }
        .header-center h4 { margin: 5px 0 0; font-size: 16px; font-weight: 400; opacity: 0.9; }
        .header-date { text-align: right; color: <?= $app['text_header']?>; min-width: 150px; }
        .header-date h3 { margin: 0; font-size: 18px; font-weight: 600; }

        /* --- 3. TICKET CONTAINER --- */
        .page-content {
            margin-top: 140px; /* Jarak dari header */
            padding: 20px;
            min-height: calc(100vh - 200px);
            display: flex;
            align-items: center; /* Center secara vertikal jika sedikit */
        }
        
        /* --- 4. TOMBOL TIKET (Memanjang Kebawah / Kiosk Style) --- */
        .ticket-btn-wrapper {
            margin-bottom: 20px;
            transition: transform 0.2s;
        }
        .ticket-btn-wrapper:active {
            transform: scale(0.98);
        }
        
        .ticket-card {
            display: block;
            width: 100%;
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            text-decoration: none; /* Hilangkan garis bawah link */
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-left: 15px solid #ccc; /* Default border color */
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        
        /* Efek Hover */
        .ticket-card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
            background-color: #fafafa;
            text-decoration: none;
        }

        /* Bagian Kiri Tombol (Kode) */
        .ticket-code {
            font-size: 60px;
            font-weight: 900;
            color: #333;
            width: 120px;
            text-align: center;
            border-right: 2px solid #eee;
            margin-right: 20px;
        }

        /* Bagian Tengah Tombol (Nama Layanan) */
        .ticket-info {
            flex-grow: 1;
            text-align: left;
        }
        .ticket-info h3 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            color: #444;
            text-transform: uppercase;
        }
        .ticket-info p {
            margin: 5px 0 0;
            color: #888;
            font-size: 16px;
        }

        /* Bagian Kanan (Icon Panah) */
        .ticket-icon {
            font-size: 40px;
            color: #ccc;
            padding-right: 20px;
        }

        /* --- 5. FOOTER --- */
        .site-footer {
            position: fixed;
            bottom: 0; left: 0; width: 100%;
            height: 60px;
            background: <?= $app['footer'];?>;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 100;
            color: #fff;
            box-shadow: 0 -4px 10px rgba(0,0,0,0.1);
        }
        .footer-clock {
            width: 150px;
            background: rgba(0,0,0,0.2);
            height: 100%;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; font-weight: bold;
        }
        .footer-marquee {
            flex-grow: 1;
            font-size: 20px;
            padding: 0 20px;
            overflow: hidden;
        }

        /* RESPONSIVE MOBILE */
        @media (max-width: 768px) {
            .site-header { flex-direction: column; height: auto; padding: 10px; }
            .header-logo img { height: 60px; margin-bottom: 10px; }
            .header-center h1 { font-size: 20px; }
            .header-date { display: none; } /* Hide date on small mobile to save space */
            .page-content { margin-top: 160px; }
            .ticket-code { font-size: 40px; width: 80px; }
            .ticket-info h3 { font-size: 20px; }
        }
    </style>
</head>
<body>

    <header class="site-header">
        <div class="header-logo">
            <img src="img/<?= $app['logo'];?>" alt="Logo">
        </div>
        <div class="header-center">
            <h1><?= $app['nama_perusahaan'];?></h1>
            <h4><?= $app['alamat'];?></h4>
        </div>
        <div class="header-date">
            <?php
            $tanggal = date('d M Y');
            $day = date('D', strtotime($tanggal));
            $dayList = ['Sun'=>'Minggu', 'Mon'=>'Senin', 'Tue'=>'Selasa', 'Wed'=>'Rabu', 'Thu'=>'Kamis', 'Fri'=>'Jumat', 'Sat'=>'Sabtu'];
            ?>
            <h3><?php echo $dayList[$day];?>, <?php echo $tanggal;?></h3>
        </div>
    </header>

    <div class="page-content">
        <div class="container">
            <div class="row justify-content-center">
                
                <?php 
                // Query Loket
                $s_kat = mysqli_query($koneksi,"SELECT * from loket where level='loket' ORDER BY loket ASC");
                while ($d_kat = mysqli_fetch_array($s_kat)){
                    // Tentukan warna border berdasarkan class warna di DB (atau default)
                    // Anda bisa menyesuaikan mapping warna ini
                    $borderColor = '#1E88E5'; // Default Blue
                    if(strpos($d_kat['warna'], 'red') !== false) $borderColor = '#e53935';
                    if(strpos($d_kat['warna'], 'green') !== false) $borderColor = '#43A047';
                    if(strpos($d_kat['warna'], 'purple') !== false) $borderColor = '#8E24AA';
                    if(strpos($d_kat['warna'], 'orange') !== false) $borderColor = '#FB8C00';
                ?>
                
                <div class="col-12 col-md-10 ticket-btn-wrapper">
                    <a href="controller/antri?kategori=<?= $d_kat['kode'];?>" class="ticket-card" style="border-left-color: <?= $borderColor; ?>">
                        <div class="ticket-code" style="color: <?= $borderColor; ?>">
                            <?= $d_kat['kode'];?>
                        </div>
                        <div class="ticket-info">
                            <h3><?= $d_kat['nama_layanan'];?></h3>
                            <p>Sentuh disini untuk mengambil nomor antrian</p>
                        </div>
                        <div class="ticket-icon">
                            <i class="fa fa-print"></i>
                        </div>
                    </a>
                </div>

                <?php } ?>

            </div>
        </div>
    </div>

    <footer class="site-footer">
        <div class="footer-clock" id="clock">00:00:00</div>
        <div class="footer-marquee">
            <marquee scrollamount="6">
                <?php 
                $s_feed = mysqli_query($koneksi,"SELECT * FROM feed where status='1'");
                while ($d_feed = mysqli_fetch_array($s_feed)){
                    echo '<span style="margin-right: 50px;"><i class="fa fa-info-circle"></i> '.$d_feed['feed'].'</span>';
                }
                ?>
            </marquee>
        </div>
    </footer>

    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/bootstrap.min.js"></script>

    <script>
        function clock() {
            var now = new Date();
            var h = now.getHours(); var m = now.getMinutes(); var s = now.getSeconds();
            if (h < 10) h = "0" + h; if (m < 10) m = "0" + m; if (s < 10) s = "0" + s;
            document.getElementById("clock").innerHTML = h + ":" + m + ":" + s;
        }
        setInterval(clock, 1000);
    </script>

    <script>
    function refreshAt(hours, minutes, seconds) {
        var now = new Date();
        var then = new Date();

        if(now.getHours() > hours ||
           (now.getHours() == hours && now.getMinutes() > minutes) ||
            now.getHours() == hours && now.getMinutes() == minutes && now.getSeconds() >= seconds) {
            then.setDate(now.getDate() + 1);
        }
        then.setHours(hours);
        then.setMinutes(minutes);
        then.setSeconds(seconds);

        var timeout = (then.getTime() - now.getTime());
        setTimeout(function() { window.location.reload(true); }, timeout);
    }
    // Refresh otomatis jam 6 pagi setiap hari
    refreshAt(06,00,0);
    </script>

</body>
</html>