<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
		header("location:warn.php");
}
$sql = $connect->query("SELECT * FROM pengguna WHERE uid=".$_GET['uid']);
$row = $sql->fetch_assoc();
?>

<html>
<head>
	<title>Edit Admin | SK Konversi NIP</title>
	<meta charset=utf-8>
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="favicon.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/datepicker.min.css" rel="stylesheet" type="text/css">
	<link href="css/select2.min.css" rel="stylesheet" type="text/css">
</head>
	<?php include 'head.php'; ?>
	<form action="proses_update_admin.php" method="post">
		<div class="container col-md-5 mar">
			<h1 class="display-4 text-center my-3 text-warning">Update Admin</h1>
			<div class="card">
				<div class="card-block container">
					<div class="row my-4">
						<div class="col-md-4">
							<label class="form-control-label">NIP</label>
						</div>
						<div class="col">
							<input type="text" name="nip" class="form-control form-contrl-sm" placeholder="NIP" maxlength="18" pattern="^[0-9]{18,18}$" title="max 18 karakter dan berupa angka" value="<?php echo $row['nip']; ?>">
						</div>
					</div>
					<div class="row my-4">
						<div class="col-md-4">
							<label class="form-control-label">Nama Lengkap</label>
						</div>
						<div class="col">
							<input type="text" name="nama_lengkap" class="form-control form-contrl-sm" placeholder="Nama Lengkap" value="<?php echo $row['nama_lengkap']; ?>">
						</div>
					</div>
					<div class="row my-4">
						<div class="col-md-4">
							<label class="form-control-label">Password</label>
						</div>
						<div class="col">
							<input type="text" name="pass" class="form-control form-contrl-sm" placeholder="Password" value="<?php echo $row['pass']; ?>">
						</div>
					</div>
					<div class="row my-4" style="padding-bottom: 5rem;">
						<div class="col-md-4">
							<label class="form-control-label">Status pengguna</label>
						</div>
						<div class="col">
							<?php
							if ($row['aktif'] == 1) {
									$status1 = "checked";
							} else {
									$status1 = "";
							}
							if ($row['aktif'] == 0) {
									$status2 = "checked";
							} else {
									$status2 = "";
							}
							?>
							<div class="custom-control custom-radio">
								<input class="custom-control-input"  type="radio" name="aktif" value="1" id="option1" <?php echo $status1 ?>>
								<label class="custom-control-label"  for="option1">Aktif</label><br>
							</div>
							<div class="custom-control custom-radio">
								<input class="custom-control-input"  type="radio" name="aktif" value="0" id="option2" <?php echo $status2 ?>>
								<label class="custom-control-label"  for="option2">Tidak Aktif</label><br>
							</div>
							<input type="hidden" name="uid" value=<?php echo $_GET['uid'];?>>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="row">
						<div class="col">
							<a onclick="window.location='view_admin.php'" class="btn btn-warning btn-block">Kembali <i class="fa fa-reply"></i></a>
						</div>
						<div class="col">
							<input type="submit" name="submit" value="update" class="btn btn-success btn-block">
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/datepicker.js"></script>
<script src="js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="js/select2.min.js" type="text/javascript"></script>
</body>
</html>