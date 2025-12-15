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
$profil = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from loket where level='admin'"));
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
							<div class="subtitle">Ganti Password </div>
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				<div class="card-block">
					<form action="controller/profil?id=<?= $profil['id']?>" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
                                    
									<div class="form-group">
                                        <div class="col-md-4">
                                            <input type="password"  id="password" value="<?= $profil['password'];?>" Placeholder="Password Baru" class="form-control form-control-line" required>
                                        </div>
                                    </div><br/><br/><br/>
									<div class="form-group">
                                        <div class="col-md-4">
                                            <input type="password" name="password"  id="confirm_password" value="<?= $profil['password'];?>" Placeholder="Confirn Password" class="form-control form-control-line" required>
                                        </div>
                                    </div>
                                    <span id='message'></span>
                                    
                                   
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">Update</button>
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
<script type="text/javascript">
    var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

	function validatePassword(){
	  if(password.value != confirm_password.value) {
		confirm_password.setCustomValidity("Passwords Don't Match");
	  } else {
		confirm_password.setCustomValidity('');
	  }
	}

	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;
	
	$('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Not Matching').css('color', 'red');
});
	</script>
<script src="js/app.js"></script>
</body>
</html>