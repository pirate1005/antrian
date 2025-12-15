<?php include 'koneksi/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $app['nama_aplikasi'];?></title>
    
    <link href="img/favicon.png" rel="icon" type="image/png">

    <link rel="stylesheet" href="css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap/bootstrap.min.css">

    <style>
        /* --- CSS RESET & LAYOUT --- */
        body {
            background-color: #eef1f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden; 
            margin: 0; padding: 0;
        }

        /* 1. HEADER */
        .site-header {
            height: 110px;
            background: <?= $app['header'];?>;
            border-bottom: 4px solid #d9aa00; 
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            position: fixed; top: 0; width: 100%; z-index: 50;
        }
        .header-logo img { height: 80px; }
        .header-center { text-align: center; color: <?= $app['text_header']?>; flex-grow: 1; }
        .header-center h1 { margin: 0; font-size: 28px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; }
        .header-center h4 { margin: 5px 0 0; font-size: 16px; font-weight: 400; opacity: 0.9; }
        .header-date { text-align: right; color: <?= $app['text_header']?>; min-width: 200px; }
        .header-date h3 { margin: 0; font-size: 18px; font-weight: 600; }

        /* 2. MAIN CONTAINER */
        .main-container {
            margin-top: 110px; 
            height: calc(100vh - 170px); 
            padding: 20px;
            display: flex;
        }

        /* 3. VIDEO COLUMN (Left) */
        .col-video {
            width: 65%;
            padding-right: 20px;
            height: 100%;
            position: relative;
        }
        .video-box {
            width: 100%; height: 100%;
            background: #000;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
            position: relative;
        }
        video { width: 100%; height: 100%; object-fit: cover; }
        
        /* POPUP OVERLAY */
        #active-call-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.9);
            z-index: 20;
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
        }
        .popup-title { font-size: 2em; margin-bottom: 10px; color: #ddd; text-transform: uppercase;}
        .popup-number { font-size: 8em; font-weight: bold; color: #ffeb3b; line-height: 1; margin: 0; text-shadow: 0 0 20px rgba(255,235,59,0.5); }
        .popup-loket { font-size: 3em; margin-top: 20px; color: #fff; font-weight: bold; border-top: 2px solid #555; padding-top: 20px; width: 80%; }

        /* 4. QUEUE LIST (Right) */
        .col-queue {
            width: 35%;
            height: 100%;
            overflow-y: auto; 
            padding-right: 5px;
        }
        .queue-card {
            background: #fff;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border-left: 5px solid <?= $app['header'];?>;
        }
        .queue-header {
            padding: 10px;
            background: #f8f9fa;
            font-size: 16px;
            font-weight: 600;
            color: #555;
            text-align: center;
            text-transform: uppercase;
            border-bottom: 1px solid #eee;
        }
        .queue-number {
            font-size: 42px;
            font-weight: 800;
            color: #333;
            text-align: center;
            padding: 10px 0;
            letter-spacing: 2px;
        }

        /* 5. FOOTER */
        .site-footer {
            position: fixed; bottom: 0; left: 0; width: 100%;
            height: 60px;
            background: <?= $app['footer'];?>;
            display: flex; z-index: 50;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        }
        .footer-clock {
            width: 180px;
            background: <?= $app['jam'];?>;
            color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; font-weight: bold;
        }
        .footer-marquee {
            flex-grow: 1; display: flex; align-items: center;
            color: #fff; font-size: 20px; overflow: hidden;
        }

        /* 6. OVERLAY CLICK TO START */
        #start-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.95); z-index: 9999;
            display: flex; justify-content: center; align-items: center;
            flex-direction: column; color: white; cursor: pointer;
        }
        .start-btn {
            margin-top: 20px; padding: 15px 40px;
            background: #ffeb3b; color: #333;
            font-size: 20px; font-weight: bold;
            border-radius: 50px; border: none;
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.05); } 100% { transform: scale(1); } }

        @media (max-width: 768px) {
            .main-container { flex-direction: column; height: auto; overflow: auto; margin-top: 130px;}
            .col-video { width: 100%; height: 300px; margin-bottom: 20px; padding-right: 0;}
            .col-queue { width: 100%; height: auto; }
            body { overflow: auto; }
        }
    </style>
</head>
<body>

    <div id="start-overlay" onclick="startApp()">
        <img src="img/<?= $app['logo'];?>" height="100" style="margin-bottom:20px; background:white; padding:10px; border-radius:10px;">
        <h2 style="text-align:center">KLIK LAYAR UNTUK MENYINKRONKAN DISPLAY</h2>
        <button class="start-btn"><i class="fa fa-play"></i> MULAI APLIKASI</button>
    </div>

    <audio id="suarabel" src="Airport_Bell1.mp3"></audio>
    <audio id="suarabelnomorurut" src="audio/antrian.wav"></audio>
    <audio id="suarabelsuarabelloket" src="audio/loket.wav"></audio>
    <audio id="belas" src="audio/belas.wav"></audio>
    <audio id="sebelas" src="audio/sebelas.wav"></audio>
    <audio id="puluh" src="audio/puluh.wav"></audio>
    <audio id="sepuluh" src="audio/sepuluh.wav"></audio>
    <audio id="ratus" src="audio/ratus.wav"></audio>
    <audio id="seratus" src="audio/seratus.wav"></audio>
    
    <?php 
    $chars = ['A','B','C','D','E','F',1,2,3,4,5,6,7,8,9];
    foreach($chars as $c) {
        echo '<audio id="'.$c.'" src="audio/'.$c.'.wav"></audio>' . "\n";
    }
    ?>

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

    <div class="main-container">
        <div class="col-video">
            <div class="video-box">
                <div id="active-call-overlay">
                    <div class="popup-title">Nomor Antrian</div>
                    <div class="popup-number" id="popup-number">A-000</div>
                    <div class="popup-loket" id="popup-loket">MENUJU LOKET 1</div>
                </div>

                <?php if($app['tipe']=='2'){ ?>
                    <div class="w3-content" style="width:100%; height:100%;">
                        <?php for($i=1; $i<=5; $i++) { 
                            if(!empty($app['video'.$i]) || $i==1 && !empty($app['video'])) {
                                $src = ($i==1) ? $app['video'] : $app['video'.$i];
                                if(!empty($src)) echo '<img class="mySlides" src="img/'.$src.'" style="width:100%;height:100%;object-fit:cover;display:none;">';
                            }
                        } ?>
                    </div>
                <?php } else { ?>
                    <video id="myvideo" autoplay loop>
                         <source src="img/<?= $app['video'];?>" type="video/mp4">
                         <?php if(!empty($app['video2'])) echo '<source src="img/'.$app['video2'].'" type="video/mp4">'; ?>
                    </video>
                <?php } ?>
            </div>
        </div>

        <div class="col-queue">
            <div style="display:none;" id="panggilan"></div>
            <div style="display:none;" id="loket_panggilan"></div>

            <?php 
            $s_kat = mysqli_query($koneksi,"SELECT * from loket where level='loket' ORDER BY loket ASC");
            while ($d_kat = mysqli_fetch_array($s_kat)){
            ?>
            <div class="queue-card">
                <div class="queue-header" style="background: <?= $d_kat['warna'] ? $d_kat['warna'] : '#f0f0f0'; ?>; color: #fff; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
                    <?= $d_kat['nama_layanan'];?>
                </div>
                <div class="queue-number" id="l<?= $d_kat['loket'];?>">---</div>
            </div>
            <?php } ?>
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
        if(document.getElementsByClassName("mySlides").length > 0) {
            var myIndex = 0;
            carousel();
            function carousel() {
                var i; var x = document.getElementsByClassName("mySlides");
                for (i = 0; i < x.length; i++) { x[i].style.display = "none"; }
                myIndex++;
                if (myIndex > x.length) {myIndex = 1}    
                x[myIndex-1].style.display = "block";  
                setTimeout(carousel, 8000); 
            }
        }
    </script>

    <script>
        var isPlaying = false; 
        var audioQueue = []; 

        function fadeVideoVolume(targetVolume) {
            var vid = document.getElementById('myvideo');
            if(!vid) return;
            $(vid).stop().animate({volume: targetVolume}, 1000); 
        }

        // --- FUNGSI START APP & SYNC VIDEO ---
        function startApp() {
            $('#start-overlay').fadeOut();
            
            // 1. Pancing Audio
            var audio = document.getElementById('suarabel');
            audio.play().then(() => {
                audio.pause(); audio.currentTime = 0;
            }).catch((e) => console.log("Izin audio perlu interaksi user"));
            
            // 2. Play Video & Sync Waktu
            var vid = document.getElementById('myvideo');
            if(vid) { 
                vid.volume = 1.0; 
                vid.play(); 
                
                // LOGIKA SYNC VIDEO: 
                // Mengambil detik saat ini dari jam sistem. 
                // Misal jam 10:00:30, video durasi 60s, maka video lompat ke detik 30.
                if (vid.readyState >= 1) { // Pastikan metadata video loaded
                    syncVideoTime(vid);
                } else {
                    vid.onloadedmetadata = function() { syncVideoTime(vid); };
                }
            }
        }

        // Fungsi Menyamakan Waktu Video antar Device
        function syncVideoTime(videoElement) {
            var duration = videoElement.duration;
            if(!isNaN(duration)) {
                var now = new Date();
                var totalSeconds = (now.getHours() * 3600) + (now.getMinutes() * 60) + now.getSeconds();
                var seekTime = totalSeconds % duration;
                
                // Lompat ke detik yang sama untuk semua device
                videoElement.currentTime = seekTime;
                console.log("Video synced to: " + seekTime);
            }
        }

        function getAudioListFromNumber(n) {
            n = parseInt(n);
            var list = [];
            if (n < 10) { list.push(n.toString()); } 
            else if (n == 10) { list.push('sepuluh'); } 
            else if (n == 11) { list.push('sebelas'); } 
            else if (n < 20) { list.push((n % 10).toString()); list.push('belas'); } 
            else if (n < 100) {
                list.push(Math.floor(n / 10).toString()); list.push('puluh');
                if (n % 10 > 0) list.push((n % 10).toString());
            } else if (n == 100) { list.push('seratus'); } 
            else if (n < 200) {
                list.push('seratus');
                if (n - 100 > 0) list = list.concat(getAudioListFromNumber(n - 100));
            } else if (n < 1000) {
                list.push(Math.floor(n / 100).toString()); list.push('ratus');
                if (n % 100 > 0) list = list.concat(getAudioListFromNumber(n % 100));
            }
            return list;
        }

        function playNextAudio() {
            if (audioQueue.length === 0) {
                isPlaying = false;
                fadeVideoVolume(1.0); // Kembalikan volume video
                $('#active-call-overlay').fadeOut();

                var loketID = $('#loket-target-id').val();
                if(loketID) {
                    $.ajax({ type: 'POST', url: 'controller/uncounter', data :{loket : loketID} });
                }
                return;
            }

            var audioId = audioQueue.shift();
            var audioEl = document.getElementById(audioId);

            if (audioEl) {
                audioEl.currentTime = 0;
                var playPromise = audioEl.play();
                if (playPromise !== undefined) {
                    playPromise.then(_ => {
                        audioEl.onended = function() { playNextAudio(); };
                    }).catch(err => { playNextAudio(); });
                }
            } else {
                playNextAudio(); 
            }
        }

        $(document).ready(function() {
            loadLoketData();
            setInterval(function() {
                loadLoketData();
                checkStatus();
            }, 1000);

            function loadLoketData() {
                <?php 
                $s_loket1 = mysqli_query($koneksi,"SELECT * from loket where level='loket'");
                while ($d_loket1 = mysqli_fetch_array($s_loket1)){ 
                    echo '$("#l'.$d_loket1['loket'].'").load("controller/loket?kode='.$d_loket1['loket'].'");';
                } 
                ?>
            }

            function checkStatus() {
                if (!isPlaying) {
                    $.ajax({
                        url: 'controller/status.php',
                        success: function(data) {
                            try {
                                var sukses = JSON.parse(data);
                                if (sukses.sebelum == 'call'){
                                    isPlaying = true;
                                    var kategori = sukses.kategori; 
                                    var antrian  = sukses.nomor;    
                                    var loket    = sukses.loket;    

                                    if($('#loket-target-id').length == 0) {
                                        $('body').append('<input type="hidden" id="loket-target-id">');
                                    }
                                    $('#loket-target-id').val(loket);

                                    $('#popup-number').text(kategori + "-" + antrian);
                                    $('#popup-loket').text("MENUJU LOKET " + loket);
                                    $('#active-call-overlay').css('display', 'flex').hide().fadeIn();

                                    fadeVideoVolume(0.15); // Kecilkan Video

                                    // --- LOGIKA ANTRIAN AUDIO (DENGAN DOUBLE BELL) ---
                                    audioQueue = [];
                                    
                                    // 1. Bell Awal
                                    audioQueue.push('suarabel'); 
                                    
                                    // 2. "Nomor Antrian A - 123"
                                    audioQueue.push('suarabelnomorurut'); 
                                    audioQueue.push(kategori); 
                                    audioQueue = audioQueue.concat(getAudioListFromNumber(antrian)); 
                                    
                                    // 3. "Menuju Loket 1"
                                    audioQueue.push('suarabelsuarabelloket'); 
                                    audioQueue = audioQueue.concat(getAudioListFromNumber(loket)); 
                                    
                                    // 4. Bell Akhir (Baru Ditambahkan)
                                    audioQueue.push('suarabel'); 

                                    playNextAudio();
                                }
                            } catch (e) {}
                        }
                    });
                }
            }
        });
        
        $.ajaxSetup({ cache: false });
    </script>
</body>
</html>