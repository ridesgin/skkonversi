<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
		header("location:warn.php");
}
?>

<html>
<head>
	<title>Admin | SK Konversi NIP</title>
	<meta charset=utf-8>
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="favicon.ico">
</head>
	<?php include 'head.php'; ?>
	<form action="proses_tambah_admin.php" method="post">
		<div class="container col-md-5 mar">
			<center class="display-4 text-white">Tambah Admin</center>
			<div class="card">
				<div class="card-block container">
					<div class="row my-4">
						<div class="col-md-4">
							<label class="form-control-label">NIP</label>
						</div>
						<div class="col">
							<input type="text" name="nip" class="form-control form-contrl-sm" placeholder="NIP">
						</div>
					</div>
					<div class="row my-4">
						<div class="col-md-4">
							<label class="form-control-label">Nama Lengkap</label>
						</div>
						<div class="col">
							<input type="text" name="nama_lengkap" class="form-control form-contrl-sm" placeholder="Nama Lengkap">
						</div>
					</div>
					<div class="row my-4" style="padding-bottom: 5rem;">
						<div class="col-md-4">
							<label class="form-control-label">Password</label>
						</div>
						<div class="col">
							<input type="text" name="pass" class="form-control form-contrl-sm" placeholder="Password">
						</div>
					</div>
				</div>
				<div class="card-footer">
					<a onclick="window.location='view_admin.php'" class="btn btn-warning">Kembali <i class="fa fa-reply"></i></a>
					<input type="submit" name="submit" value="input" class="btn  btn-success">
				</div>
			</div>
		</div>
	</form>
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>