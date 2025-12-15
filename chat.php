<!DOCTYPE html>
<html>
  <head>
    <!-- Required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui, viewport-fit=cover">
	<meta name="apple-mobile-web-app-capable" content="yes">
	
    <title>SOS</title>
   <link rel="stylesheet" href="css/framework7.ios.min.css">
    <link rel="stylesheet" href="css/ionicons.css">
    <link rel="stylesheet" href="css/style.css">
	
	</style>
  </head>
  <body class="color-theme-pink" >
    <!-- App root element -->
    <div >
      <div>
			<div  class="page ">
			 <div class="navbar">
				<div class="navbar-inner sliding">
				  
				  <div class="title">Chat</div>
				</div>
			  </div>
			  <div class="toolbar messagebar">
				<div class="toolbar-inner">
				  <div class="messagebar-area">
					<textarea class="resizable pesan" id="pesan" name="pesan" placeholder="Message" required></textarea>
				  </div><span>Send</span>  <i class=" icon ion-ios-send open-preloader-indicator" id="kirimPesan"></i>
				</div>
				<p></p>
			  </div>
				
			  <div class="page-content messages-content">
				<div class="messages" id="historiObrolan">
				  
				</div>
			  </div>
			</div>
		</div>
        
        
      </div>
    </div>
	
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/framework7.min.js"></script>
    <script src="js/app.js"></script>
	<script>
		var refreshId = setInterval(function() {
					$.ajax({
						url: 'controller/historiObrolan.php?id=<?= $_GET['id'];?>',
						type: 'GET',
						cache:false,
						timeout:10000,
					}).done(function (response) {
						$('#historiObrolan').html(response)
					});
					 }, 500);
				 

	
		
		
			
		$("#kirimPesan").click(function(){
			
			
				var pesan = $('#pesan').val();
					$.ajax({
						url: 'controller/kirimPesan.php',
						type: 'POST',
						cache:false,
						timeout:10000,
						data: {
							temanObrolan: '<?= $_GET['id'];?>',
							pesan: pesan
						}
					}).done(function (response) {
						
						$('#pesan').val('');
					});
				}); 
		
		
	
	</script>
	<script>
function goBack() {
  window.history.back();
}
</script>
	
  </body>
</html>
