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
<link rel="stylesheet" href="css/lib/jquery-minicolors/jquery.minicolors.css">
<link rel="stylesheet" href="css/separate/vendor/jquery.minicolors.min.css">
    <link rel="stylesheet" href="css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
	

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
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<button type="button" class="btn btn-inline" data-toggle="modal" data-target="#myModal">Tambah Loket</button>
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				<div class="card-block">
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>Kode Tiket</th>
							<th>No Loket</th>
							<th>Warna</th>
							<th>Nama Layanan</th>
							<th>Username</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						<?php
						$i=0;
						$s_antrian = mysqli_query($koneksi,"SELECT * from loket where level!='admin' order by id asc");
						while ($d_antrian= mysqli_fetch_array($s_antrian)){
						?>
						
						<tr>
							<td><?= $d_antrian['kode'];?></td>
							<td><?= $d_antrian['loket'];?></td>
							<td><?= $d_antrian['warna'];?></td>
							<td><?= $d_antrian['nama_layanan'];?></td>
							<td><?= $d_antrian['username'];?></td>
							<td><button type="button" class="btn btn-inline btn-primary btn-sm ladda-button" data-toggle="modal" data-target="#myModal<?= $d_antrian['id'];?>">
								<i class="fa fa-pencil"></i></button>
								<a href="controller/loket_hapus?id=<?= $d_antrian['id'];?>" onclick="return confirm('Yakin Loket <?= $d_antrian['nama_layanan'];?> ini akan dihapus ?')"><button type="button" class="btn btn-inline btn-danger btn-sm ladda-button" >
								<i class="fa fa-trash"></i></button></a>
							</td>
						</tr>

						<div class="modal fade"
						 id="myModal<?= $d_antrian['id'];?>"
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
											<h4 class="modal-title" id="myModalLabel">Edit Loket <?= $d_antrian['loket'];?> <?= $d_antrian['nama_layanan'];?></h4>
										</div>
										<div class="modal-body">
											<form action="controller/loket_edit" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
											
											<div class="row">
											<div class="form-group">
												<label class="col-md-4">No Loket</label>
												<div class="col-md-5">
												<?php $loket = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from loket where id='$d_antrian[id]'")); ?>
												<input type="hidden" name="id" value="<?= $d_antrian['id'];?>" class="form-control form-control-line" required>
													<input type="number" name="loket" readonly="readonly" min="0" max="8" value="<?= $loket['loket']?>" class="form-control form-control-line" required>
												</div>
												<label class="col-md-4">Kode Tiket</label>
												<div class="col-md-5">
													<input type="text" name="kode" value="<?= $loket['kode']?>" class="form-control form-control-line" required>
												</div>
												
											</div>
											
											<div class="form-group">
												<label class="col-md-4">Nama Layanan</label>
												<div class="col-md-8">
													<input type="text" name="nama_layanan" value="<?= $loket['nama_layanan']?>"  class="form-control form-control-line" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4">Username</label>
												<div class="col-md-5">
													<input type="text" name="username"  value="<?= $loket['username']?>" class="form-control form-control-line" required>
												</div>
												<label class="col-md-4">Password</label>
												<div class="col-md-5">
													<input type="password" name="password" value="<?= $loket['password']?>" class="form-control form-control-line" required>
												</div>
											</div>
											<div class="form-group">
											<label class="col-md-4">Warna Tampilan</label>
												<div class="col-md-5">
												<select id="exampleSelect" name="warna" class="form-control" required>
													<option value="">-- Pilih Warna --</option>
													<option value="green" <?php if (!(strcmp("green", htmlentities($loket['warna'])))) {echo "selected=\"selected\"";} ?>>Hijau</option>
													<option value="red" <?php if (!(strcmp("red", htmlentities($loket['warna'])))) {echo "selected=\"selected\"";} ?>>Merah</option>
													<option value="yellow" <?php if (!(strcmp("yellow", htmlentities($loket['warna'])))) {echo "selected=\"selected\"";} ?>>Kuning</option>
													<option value="purple" <?php if (!(strcmp("purple", htmlentities($loket['warna'])))) {echo "selected=\"selected\"";} ?>>Ungu</option>
												</select>
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
						<?php ;} ?>
						</tbody>
					</table>
					
				</div>
			</section>
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
											<h4 class="modal-title" id="myModalLabel">Tambah Loket</h4>
										</div>
										<div class="modal-body">
											<form action="controller/loket_tambah" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
											
											<div class="row">
											<div class="form-group">
												<label class="col-md-4">No Loket</label>
												<div class="col-md-5">
													<input type="number" name="loket" min="0" max="8" class="form-control form-control-line" required>
												</div>
												<label class="col-md-4">Kode Tiket</label>
												<div class="col-md-5">
													<input type="text" name="kode" class="form-control form-control-line" maxlength="1" required>
												</div>
												
											</div>
											
											<div class="form-group">
												<label class="col-md-4">Nama Layanan</label>
												<div class="col-md-8">
													<input type="text" name="nama_layanan"  class="form-control form-control-line" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-4">Username</label>
												<div class="col-md-5">
													<input type="text" name="username"  class="form-control form-control-line" required>
												</div>
												<label class="col-md-4">Password</label>
												<div class="col-md-5">
													<input type="password" name="password"  class="form-control form-control-line" required>
												</div>
											</div>
											<div class="form-group">
											<label class="col-md-4">Warna Tampilan</label>
												<div class="col-md-5">
												<select id="exampleSelect" name="warna" class="form-control" >
													<option value="">-- Pilih Warna --</option>
													<option value="green">Hijau</option>
													<option value="red">Merah</option>
													<option value="yellow">Kuning</option>
													<option value="purple">Ungu</option>
												</select>
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
		</div><!--.container-fluid-->
	</div><!--.page-content-->
<script src="js/lib/jquery/jquery.min.js"></script>
	<script src="js/lib/tether/tether.min.js"></script>
	<script src="js/lib/bootstrap/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>

<script src="js/lib/jquery-minicolors/jquery.minicolors.min.js"></script>
<script>
	(function () {
		$(document).ready(function () {
			$('.demo').each( function() {
				$(this).minicolors({
					control: $(this).attr('data-control') || 'hue',
					defaultValue: $(this).attr('data-defaultValue') || '',
					format: $(this).attr('data-format') || 'hex',
					keywords: $(this).attr('data-keywords') || '',
					inline: $(this).attr('data-inline') === 'true',
					letterCase: $(this).attr('data-letterCase') || 'lowercase',
					opacity: $(this).attr('data-opacity'),
					position: $(this).attr('data-position') || 'bottom left',
					swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
					theme: 'bootstrap'
				});

			});
		});
	})();
</script>
<script src="js/app.js"></script>
</body>
</html>