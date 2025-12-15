<?php 
include'koneksi/koneksi.php';
session_start();

/**
 * Jika Tidak login atau sudah login tapi bukan sebagai admin
 * maka akan dibawa kembali kehalaman login atau menuju halaman yang seharusnya.
 */
if ( !isset($_SESSION['username'])) {

	header('location:login');
	exit();
}

?>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?= $app['nama_aplikasi'];?></title>

	<link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link href="img/favicon.png" rel="icon" type="image/png">
	<link href="img/favicon.ico" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="css/separate/vendor/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="css/separate/vendor/bootstrap-daterangepicker.min.css">
	<link rel="stylesheet" href="css/lib/datatables-net/datatables.min.css">
	<link rel="stylesheet" href="css/separate/vendor/datatables-net.min.css">
    <link rel="stylesheet" href="css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
	
	<audio id="suarabel" src="Airport_Bell1.mp3"></audio>
	<script src="js/responsivevoice.js"></script>
	<script type="text/javascript" >
	$(document).ready(function(){
		$("#play").click(function(){
			document.getElementById('suarabel').play();		
		});
		
		
	});
	</script>
</head>
<body class="with-side-menu">
	<?php include'include/header.php'; ?>
	<div class="mobile-menu-left-overlay"></div>
	<?php include'include/sidebar.php'; ?>
	<div class="page-content">
	
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<div class="subtitle">Laporan Antrian <?= $_SESSION['nama_layanan']; ?></div>
						</div>
					</div>
				</div>
			</header>
			<div class="form-group-row">
					<form name="form1" action="" method="get">
						
						<div class="col-sm-2">
							<div class='input-group date'>
									<input id="daterange3" name="mulai" date-format="Y-m-d" value="<?= $_GET['mulai'];?>" Placeholder="Tgl Awal" type="text" class="form-control">
									
								</div>
						</div>
						<div class="col-sm-2">
							<div class='input-group date'>
									<input id="daterange4" name="selesai" date-format="Y-m-d" Placeholder="Tgl Akhir" value="<?= $_GET['selesai'];?>"  type="text" class="form-control">
									
								</div>
						</div>
						<div class="col-sm-2">
							<select id="exampleSelect" name="l" class="form-control" >
								<option value="">-- Pilih Layanan --</option>
								<?php
								$l=$_GET['l'];
								$sql_l= mysqli_query($koneksi,"SELECT * FROM loket where level !='admin' ORDER BY id ASC");
								 while($data_l = mysqli_fetch_assoc($sql_l)){
								if($l == $data_l['kode']){
								
								echo '<option value="'.$data_l['kode'].'" selected>'.$data_l['nama_layanan'].' </option>';
									} else {
								echo '<option value="'.$data_l['kode'].'" >'.$data_l['nama_layanan'].'</option>';
								}
								 }
								?>
							</select>

						</div>
						<div class="col-sm-2">
							<select id="exampleSelect" name="j" class="form-control" >
								<option value="">-- Pilih Status --</option>
								<?php
								$j=$_GET['j'];
								$sql_j= mysqli_query($koneksi,"SELECT * FROM status where kode !=0 ORDER BY id ASC");
								 while($data_j = mysqli_fetch_assoc($sql_j)){
								if($j == $data_j['kode']){
								
								echo '<option value="'.$data_j['kode'].'" selected>'.$data_j['status'].' </option>';
									} else {
								echo '<option value="'.$data_j['kode'].'" >'.$data_j['status'].'</option>';
								}
								 }
								?>
							</select>

						</div>
						<button type="submit" class="btn btn-inline">FILTER</button>
						</form>
					</div></br></br>
			<section class="card">
				<div class="card-block">
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No Antrian</th>
							<th>User</th>
							<th>Kategori</th>
							<th>Tanggal Antri</th>
							<th>Tanggal Panggil</th>
							
							<th>Tanggal Selesai</th>
							<th>Durasi Panggil</th>
							<th>Durasi Pelayanan</th>
							
							<th>Status</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$i=0;
						$s_antrian = mysqli_query($koneksi,"SELECT * from antrian where status!='0'  AND date(date_antri) between '$_GET[mulai]' AND '$_GET[selesai]' AND kategori LIKE '%$_GET[l]%' AND status LIKE '%$_GET[j]%' order by date_antri ASC");
						while ($d_antrian= mysqli_fetch_array($s_antrian)){
							$layanan = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from loket where kode='$d_antrian[kategori]'"));
						?>
						
						<tr>
							<td><?= $d_antrian['no_antrian'];?></td>
							<td><?= $layanan['username'];?></td>
							<td><?php  echo $layanan['nama_layanan'];?></td>
							<td><?= $d_antrian['date_antri'];?></td>
								<td><?= $d_antrian['date_panggil'];?></td>
									<td><?= $d_antrian['date_proses'];?></td>
									<td><?php $datetime1 = new DateTime($d_antrian['date_antri']);
$datetime2 = new DateTime($d_antrian['date_panggil']);
$interval = $datetime1->diff($datetime2);
$elapsed = $interval->format('%h : %i : %s ');
echo $elapsed; ?></td>
									<td><?php $datetime1a = new DateTime($d_antrian['date_panggil']);
$datetime2a = new DateTime($d_antrian['date_proses']);
$intervala = $datetime1a->diff($datetime2a);
$elapseda = $intervala->format('%h : %i : %s ');
echo $elapseda; ?></td>
							<td><?php $status = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from status where kode ='$d_antrian[status]'")); echo $status['status'];?></td>
							
						</tr>

						
						<?php ;} ?>
						</tbody>
					</table>
					
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->

	<script src="js/lib/jquery/jquery.min.js"></script>
	<script src="js/lib/tether/tether.min.js"></script>
	<script src="js/lib/bootstrap/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>

	<script src="js/lib/datatables-net/datatables.min.js"></script>
	<script>
		$(function() {
			$('#example').DataTable({
				"paging": false,
          "lengthChange": false,
          "searching": true,
          "ordering": false,
          "info": false,
          "autoWidth": false,
          dom: 'Bfrtip',
				buttons: [
					
					{ extend: 'excel', className: 'btn-sm' },
					{ extend: 'pdf', className: 'btn-sm' },
					{ extend: 'print', className: 'btn-sm' }
				],
			});
			
		});
		
	</script>
	<script type="text/javascript" src="js/lib/moment/moment-with-locales.min.js"></script>
	<script type="text/javascript" src="js/lib/eonasdan-bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
	<script src="js/lib/clockpicker/bootstrap-clockpicker.min.js"></script>
	<script src="js/lib/clockpicker/bootstrap-clockpicker-init.js"></script>
	<script src="js/lib/daterangepicker/daterangepicker.js"></script>
	<script src="js/lib/bootstrap-select/bootstrap-select.min.js"></script>
	<script>
		$(function() {
			function cb(start, end) {
				$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			}
			cb(moment().subtract(29, 'days'), moment());

			$('#daterange2').daterangepicker();

			$('#daterange3').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true
			});
			$('#daterange4').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true
			});
			
		});
	</script>							

<script src="js/app.js"></script>
</body>
</html>