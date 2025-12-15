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
<body class="with-side-menu-addl-full">
	<?php include'include/header.php'; ?>
	<div class="mobile-menu-left-overlay"></div>
	<?php include'include/sidebar.php'; ?>
	<nav class="side-menu-addl">
		<ul class="side-menu-addl-list">
			<li>
				<a href="setting">
					<span class="tbl-row">
						<span class="tbl-cell tbl-cell-caption">Aplikasi</span>
					</span>
				</a>
			</li>
			<li>
				<a href="loket">
                <span class="tbl-row">
                    <span class="tbl-cell tbl-cell-caption">Loket</span>
                </span>
				</a>
			</li>
			
			<li>
				<a href="video">
                <span class="tbl-row">
                    <span class="tbl-cell tbl-cell-caption">Video/Foto</span>
                </span>
				</a>
			</li>
			<li>
				<a href="profil">
                <span class="tbl-row">
                    <span class="tbl-cell tbl-cell-caption">Ganti Password</span>
                </span>
				</a>
			</li>
		</ul>
	</nav>
	<div class="page-content">
	<?php if (isset($_GET['error'])) : ?>
						<div class="alert alert-danger alert-icon alert-close alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
					<i class="font-icon font-icon-warning"></i>
                    <?php echo base64_decode($_GET['error']);?>
					</div>
                <?php endif;?>
					<?php if (isset($_GET['sukses'])) : ?>
						<div class="alert alert-success alert-icon alert-close alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
					<i class="font-icon font-icon-warning"></i>
                    <?php echo base64_decode($_GET['sukses']);?>
					</div>
                <?php endif;?>
		<div class="container-fluid">
		    <form name="myForm" action="controller/video_edit" method="POST">
			<p>Silahkan Pilih Video/Foto untuk ditampilkan di halaman display (mohon diisi semua file):</p>
            <input type="radio" id="html" name="tipe" value="1" <?php if($app['tipe']==1) { ?> checked<?php ;} ?> onchange="this.form.submit()">
            <label for="html">Video</label><br>
            <input type="radio" id="css" name="tipe" value="2"<?php if($app['tipe']==2) { ?> checked<?php ;} ?> onchange="this.form.submit()">
            <label for="css">Foto</label><br>
            </form>
			<section class="card">
				<div class="card-block">
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
                            <th>#</th>
                            <th>Video/Foto</th>
							<th></th>
                            </tr>
						</thead>
						<tbody>
						<?php
							$s_feed=mysqli_query($koneksi,"SELECT * from aplikasi");
							$i=1;
							$d_feed=mysqli_fetch_array($s_feed);
						?>
						<tr>
                            <td><?= $i++;?></td>
                            <td><?= $d_feed['video'];?></td>
                            
							<td><button type="button" class="btn btn-inline" data-toggle="modal" data-target="#myModal">Ganti Video/Foto</button> </td>
						</tr>
						<tr>
                            <td><?= $i++;?></td>
                            <td><?= $d_feed['video2'];?></td>
                            
							<td><button type="button" class="btn btn-inline" data-toggle="modal" data-target="#myModal2">Ganti Video/Foto</button> </td>
						</tr>
						<tr>
                            <td><?= $i++;?></td>
                            <td><?= $d_feed['video3'];?></td>
                            
							<td><button type="button" class="btn btn-inline" data-toggle="modal" data-target="#myModal3">Ganti Video/Foto</button> </td>
						</tr>
						<tr>
                            <td><?= $i++;?></td>
                            <td><?= $d_feed['video4'];?></td>
                            
							<td><button type="button" class="btn btn-inline" data-toggle="modal" data-target="#myModal4">Ganti Video/Foto</button> </td>
						</tr>
						<tr>
                            <td><?= $i++;?></td>
                            <td><?= $d_feed['video5'];?></td>
                            
							<td><button type="button" class="btn btn-inline" data-toggle="modal" data-target="#myModal5">Ganti Video/Foto</button> </td>
						</tr>
						
						

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
											<h4 class="modal-title" id="myModalLabel">Ganti Video 1</h4>
										</div>
										<div class="modal-body">
											<div class="row">
											<form action="controller/video_simpan" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
														
														<div class="form-group">
															<label class="col-md-12">Insert Video</label>
															<div class="col-md-12">
																<input type="hidden" name="id" value="<?= $d_feed['id'];?>" class="form-control"></input>
																<input type="file" name="file_video" class="form-control"></input>
															</div>
														</div>
														
											
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Tutup</button>
											<button type="submit" class="btn btn-rounded btn-success" >Simpan</button>
										</div></form>
									</div>
								</div>
						</div><!--.modal-->                   
						<div class="modal fade"
						 id="myModal2"
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
											<h4 class="modal-title" id="myModalLabel">Ganti Video 2</h4>
										</div>
										<div class="modal-body">
											<div class="row">
											<form action="controller/video_simpan2" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
														
														<div class="form-group">
															<label class="col-md-12">Insert Video</label>
															<div class="col-md-12">
																<input type="hidden" name="id" value="<?= $d_feed['id'];?>" class="form-control"></input>
																<input type="file" name="file_video" class="form-control"></input>
															</div>
														</div>
														
											
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Tutup</button>
											<button type="submit" class="btn btn-rounded btn-success" >Simpan</button>
										</div></form>
									</div>
								</div>
						</div><!--.modal-->  
						<div class="modal fade"
						 id="myModal3"
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
											<h4 class="modal-title" id="myModalLabel">Ganti Video 3</h4>
										</div>
										<div class="modal-body">
											<div class="row">
											<form action="controller/video_simpan3" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
														
														<div class="form-group">
															<label class="col-md-12">Insert Video</label>
															<div class="col-md-12">
																<input type="hidden" name="id" value="<?= $d_feed['id'];?>" class="form-control"></input>
																<input type="file" name="file_video" class="form-control"></input>
															</div>
														</div>
														
											
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Tutup</button>
											<button type="submit" class="btn btn-rounded btn-success" >Simpan</button>
										</div></form>
									</div>
								</div>
						</div><!--.modal-->  
						<div class="modal fade"
						 id="myModal4"
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
											<h4 class="modal-title" id="myModalLabel">Ganti Video 4</h4>
										</div>
										<div class="modal-body">
											<div class="row">
											<form action="controller/video_simpan4" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
														
														<div class="form-group">
															<label class="col-md-12">Insert Video</label>
															<div class="col-md-12">
																<input type="hidden" name="id" value="<?= $d_feed['id'];?>" class="form-control"></input>
																<input type="file" name="file_video" class="form-control"></input>
															</div>
														</div>
														
											
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Tutup</button>
											<button type="submit" class="btn btn-rounded btn-success" >Simpan</button>
										</div></form>
									</div>
								</div>
						</div><!--.modal--> 
						<div class="modal fade"
						 id="myModal5"
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
											<h4 class="modal-title" id="myModalLabel">Ganti Video 5</h4>
										</div>
										<div class="modal-body">
											<div class="row">
											<form action="controller/video_simpan5" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
														
														<div class="form-group">
															<label class="col-md-12">Insert Video</label>
															<div class="col-md-12">
																<input type="hidden" name="id" value="<?= $d_feed['id'];?>" class="form-control"></input>
																<input type="file" name="file_video" class="form-control"></input>
															</div>
														</div>
														
											
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Tutup</button>
											<button type="submit" class="btn btn-rounded btn-success" >Simpan</button>
										</div></form>
									</div>
								</div>
						</div><!--.modal--> 
						
						
						
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
          "searching": false,
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

			$('#tanggal').daterangepicker({
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