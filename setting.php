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
	
<audio id="suarabel" src="Airport_Bell.mp3"></audio>
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
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<div class="subtitle">Aplikasi </div>
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				<div class="card-block">
					<form action="controller/app_edit" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-md-12">Nama Aplikasi</label>
                                        <div class="col-md-12">
											<input type="hidden" name="id_user" value="<?= $_SESSION['id'];?>" class="form-control form-control-line">
											 <input type="hidden" name="id" value="<?= $app['id'];?>" class="form-control form-control-line">
                                            <input type="text" name="nama_aplikasi" value="<?= $app['nama_aplikasi'];?>" class="form-control form-control-line">
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-md-12">Nama Perusahaan</label>
                                        <div class="col-md-12">
                                            <input type="text" name="nama_perusahaan" value="<?= $app['nama_perusahaan'];?>" class="form-control form-control-line">
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-md-12">Alamat</label>
                                        <div class="col-md-12">
                                            <input type="text" name="alamat" value="<?= $app['alamat'];?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Logo</label>
                                        <div class="col-md-12">
                                            <input type="file" name="logo" value="<?= $app['logo'];?>" class="form-control form-control-line">
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-md-12">Background</label>
                                        <div class="col-md-12">
                                            <input type="file" name="background" value="<?= $app['background'];?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <table width="100%">
											<tr>
												<td><label class="col-md-12">Warna Header</label>
												<div class="col-md-12">
												<input type="text" id="hue-demo" name="header" class="form-control demo" data-control="hue" value="<?= $app['header'];?>">
												</div><br/><br/>
												</td>
												<td><label class="col-md-12">Warna Footer</label>
												<div class="col-md-12">
													<input type="text" id="hue-demo"  name="footer" class="form-control demo" data-control="hue" value="<?= $app['footer'];?>">
												</div><br/><br/>
												</td>
												<td><label class="col-md-12">Background Jam</label>
												<div class="col-md-12">
													<input type="text" id="hue-demo" name="jam" class="form-control demo" data-control="hue" value="<?= $app['jam'];?>">
												</div><br/><br/>
												</td>
											</tr>
											
											<tr>
												<td><label class="col-md-12">Warna Text Header</label>
												<div class="col-md-12">
												<input type="text" id="hue-demo" name="text_header" class="form-control demo" data-control="hue" value="<?= $app['text_header'];?>">
												</div><br/><br/>
												</td>
												<td><label class="col-md-12">Warna Text Body</label>
												<div class="col-md-12">
												<input type="text" id="hue-demo" name="text_isi" class="form-control demo" data-control="hue" value="<?= $app['text_isi'];?>">
												</div><br/><br/>
												</td>
												<td><label class="col-md-12">Warna Text Footer</label>
												<div class="col-md-12">
												<input type="text" id="hue-demo" name="text_footer" class="form-control demo" data-control="hue" value="<?= $app['text_footer'];?>">
												</div><br/><br/></td>
											</tr>
											<tr>
												
											</tr>
										</table>
										
										
                                        
										
                                        
										
									</div>
                                    
                                   
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">Update Aplikasi</button>
                                        </div>
                                    </div>
                                </form>
					
				</div>
			</section>
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