<?php
include 'koneksi.php';
session_start();
if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
?>
<html>
<head>
	<title>Input Konversi | SK Konversi NIP</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="favicon.ico">
</head>
<body>
	<?php include 'head.php' ?>
	<form method="POST" action="aksi-btl_proses.php">
		<h1 class="text-center mar text-white display-4">Bahan Tidak Lengkap</h1>
		<div class="container col-4">
			<div class="card">
				<div class="card-block">
					<input type="text" class="form-control" value="<?php echo $_GET['id_konversi'] ?>" name="id_konversi" hidden>
					<textarea name="keterangan" class="form-control" placeholder="tuliskan bahan tidak lengkap"></textarea>
				</div>
				<div class="card-footer">
					<a onclick="window.history.go(-1); return false;" class="btn btn-warning">Return <i class="fa fa-reply"></i></a>
					<input type="submit" name="submit" value="kirim" class="btn btn-success">
				</div>
			</div>
		</div>
	</form>
<script src="js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
</body>
</html>
\