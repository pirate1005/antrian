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
							<div class="subtitle">Feed </div>
							<br/>
							<button data-toggle="modal"
						data-target="#myModal" type="button" class="btn btn-inline btn-primary btn-sm ladda-button" ><i class="fa fa-plus"></i> Tambah Running Text</button> 
						<div class="modal fade"
						 id="myModal"
								 tabindex="-1"
								 role="dialog"
								 aria-labelledby="myModalLabel"
								 aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
												<i class="font-icon-close-2"></i>
											</button>
											<h4 class="modal-title" id="myModalLabel">Tambah Running Text</h4>
										</div>
										<div class="modal-body">
											
											
											<form action="controller/feed_tambah" method="post">
											<div class="row">
											<div class="form-group">
												<label class="col-md-4">Tanggal</label>
												<div class="col-md-4">
													<input type="text" name="tanggal" id="daterange3"   class="form-control form-control-line" required>
												</div>
											</div>
											<br/><br/>
											<div class="form-group">
												<label class="col-md-4">Feed</label>
												<div class="col-md-8">
													<input type="text" name="feed"   class="form-control form-control-line" required>
												</div>
											</div>
											<br/><br/>
											<div class="form-group">
												<label class="col-md-4">Status</label>
												<div class="col-md-4">
													<select name="status" class="form-control" required>
														<option value="">Pilih status</option>
														<option value="1">Aktif</option>
														<option value="0">Tidak Aktif</option>
													</select>
												</div>
											</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Tidak</button>
											<button type="submit" class="btn btn-rounded btn-primary">Ya</button>
											</form>
										</div>
									</div>
								</div>
						</div><!--.modal-->
						</div>
					</div>
				</div>
			</header>
			
			<section class="card">
				<div class="card-block">
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>Feed</th>
							<th>Status</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						<?php
						$i=1;
						$s_antrian = mysqli_query($koneksi,"SELECT * from feed where status!='0' ");
						while ($d_antrian= mysqli_fetch_array($s_antrian)){
						?>
						
						<tr>
							<td><?= $i++;?></td>
							<td><?= $d_antrian['tanggal'];?></td>
							<td  align="left"><?= $d_antrian['feed'];?></td>
							<td><?php if($d_antrian['status']==1){ echo 'aktif';} else{ echo 'tidak aktif';}?></td>
							<td></button>
								<a href="controller/feed_hapus?id=<?= $d_antrian['id'];?>" onclick="return confirm('Yakin Runing text <?= $d_antrian['feed'];?> ini akan dihapus ?')"><button type="button" class="btn btn-inline btn-danger btn-sm ladda-button" >
								<i class="fa fa-trash"></i></button></td>
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
          "autoWidth": false
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