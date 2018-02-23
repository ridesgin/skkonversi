<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
?>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="favicon.ico">
	<title>SK Konversi</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<style>
		body, html {height: 100%}
	</style>
</head>
<body class="text-center">
	<div class="bgimg">
		<div class="container-fluid">
			<div style="color: white;opacity: 0.8; padding-top: 15%;">
				<h1 class="display-4 animate">Website sedang dalam pengerjaan</h1>
				<hr style="color: white; width: 20%">
				<p class="lead">Mohon maaf atas ketidak nyamanannya</p>
				<a href="welcome.php" class="btn btn-lg btn-outline-warning zoom">Home</a>
			</div>
		</div>
	</div>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
