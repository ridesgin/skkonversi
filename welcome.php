<?php
include 'koneksi.php';
session_start();
if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
?>
<html>
<head>
	<title>SK Konversi NIP</title>
	<meta charset=utf-8>
	<meta name=description content="">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="favicon.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/datepicker.min.css" rel="stylesheet" type="text/css">
	<link href="css/select2.min.css" rel="stylesheet" type="text/css">
</head>
	<body style="overflow: hidden;">
	<?php include 'head.php';?>
	<div class="container">
		<div style="margin-top: 8%;">
			<h2 class="display-4 typewriter" style="text-align: center;">SELAMAT DATANG DI APLIKASI SK KONVERSI NIP</h2>
			<img src="images/logo.png" class="logo animate" alt="logo">
			<hr class="col-md-6">
			<h2 class="lead" style="text-align: center;">Kantor Regional 1 Badan Kepagawaian Negara</h2>
			<h2 class="lead" style="text-align: center;">YOGYAKARTA</h2>
			<div class="row">
				<div class="col">
					<a href="surat_pengantar.php" class="btn btn-secondary btn-block btn-lg">Surat Pengantar</a>
				</div>
			</div>
		</div>
	</div>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/datepicker.js"></script>
<script src="js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="js/select2.min.js" type="text/javascript"></script>
</body>
</html>