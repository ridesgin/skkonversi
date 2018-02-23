<?php
include 'koneksi.php';
session_start();
if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
?>

<html>
<head>
	<title>Welcome | SK Konversi NIP</title>
	<meta charset=utf-8>
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="favicon.ico">
	 <style>
		/* Make the image fully responsive */
		.carousel-inner img {
			width: 100%;
			height: 100%;
  		}
  		.wkwk{
  			z-index: 100;
  			position: absolute;
  		}
  	</style>
</head>
<body style="overflow: hidden;">
	 <?php include 'head.php'; ?>
	 <center><img src="images/logo.png" class="wkwk animate" alt="logo"></center>
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>
		  	<div class="carousel-inner">
				<div class="carousel-item active">
				<img class="first-slide" src="images/1.jpg" alt="First slide">
				<div class="container">					
				  <div class="carousel-caption">
					 <h1 class="display-2" style="text-shadow: 0 0 2px #000, 0 0 10px #000;">Selamat Datang</h1>
					 <p></p>
					 <p><div class="btn-group btn-group-lg btn-group-justified" style="justify-content: center;display: flex; align-items: center; opacity: 0.8">
							<div class="btn-group">
								<a href="input_surat_tamu.php" class="btn btn-lg btn-primary"><span class="badge badge-light">1.</span> Surat Tamu</a>
							</div>
							<div class="btn-group">
								<a href="input_surat_pengantar.php" class="btn btn-lg btn-primary"><span class="badge badge-light">2.</span> Surat Pengantar</a>
							</div>
							<div class="btn-group">
								<a href="input_konversi.php" class="btn btn-lg btn-primary"><span class="badge badge-light">3.</span> Konversi NIP</a>
							</div>
						</div>
					</p>
				  </div>
				</div>
			 </div>
			 <div class="carousel-item">
				<img class="second-slide" src="images/2.jpg" alt="Second slide">
				<div class="container">					
				  <div class="carousel-caption">
					 <h1 class="display-3" style="text-shadow: 0 0 2px #000, 0 0 10px #000;">Di aplikasi SK Konversi NIP</h1>
					 <p></p>
					 <p><div class="btn-group btn-group-lg btn-group-justified" style="justify-content: center;display: flex; align-items: center; opacity: 0.8">
							<div class="btn-group">
								<a href="input_surat_tamu.php" class="btn btn-lg btn-primary"><span class="badge badge-light">1.</span> Surat Tamu</a>
							</div>
							<div class="btn-group">
								<a href="input_surat_pengantar.php" class="btn btn-lg btn-primary"><span class="badge badge-light">2.</span> Surat Pengantar</a>
							</div>
							<div class="btn-group">
								<a href="input_konversi.php" class="btn btn-lg btn-primary"><span class="badge badge-light">3.</span> Konversi NIP</a>
							</div>
						</div>
					</p>
				  </div>
				</div>
			 </div>
			 <div class="carousel-item">
				<img class="third-slide" src="images/3.jpg" alt="Third slide">
				<div class="container">
				  <div class="carousel-caption">
					 <h1 class="display-4" style="text-shadow: 0 0 2px #000, 0 0 10px #000;">Kantor Regional 1 BKN Yogyakarta</h1>
					 <p><div class="btn-group btn-group-lg btn-group-justified" style="justify-content: center;display: flex; align-items: center; opacity: 0.8">
							<div class="btn-group">
								<a href="input_surat_tamu.php" class="btn btn-lg btn-primary"><span class="badge badge-light">1.</span> Surat Tamu</a>
							</div>
							<div class="btn-group">
								<a href="input_surat_pengantar.php" class="btn btn-lg btn-primary"><span class="badge badge-light">2.</span> Surat Pengantar</a>
							</div>
							<div class="btn-group">
								<a href="input_konversi.php" class="btn btn-lg btn-primary"><span class="badge badge-light">3.</span> Konversi NIP</a>
							</div>
						</div>
					</p>
				  </div>
				</div>
			 </div>
		  </div>
		  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
			 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			 <span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
			 <span class="carousel-control-next-icon" aria-hidden="true"></span>
			 <span class="sr-only">Next</span>
		  </a>
		</div>

</body>
<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
function clock() {// We create a new Date object and assign it to a variable called "time".
var time = new Date(),
	 
	 // Access the "getHours" method on the Date object with the dot accessor.
	 hours = time.getHours(),
	 
	 // Access the "getMinutes" method with the dot accessor.
	 minutes = time.getMinutes(),
	 
	 
	 seconds = time.getSeconds();

document.querySelectorAll('.clock')[0].innerHTML = harold(hours) + ":" + harold(minutes) + ":" + harold(seconds);
  
  function harold(standIn) {
	 if (standIn < 10) {
		standIn = '0' + standIn
	 }
	 return standIn;
  }
}
setInterval(clock, 1000);
		  </script>
</body>
</html>