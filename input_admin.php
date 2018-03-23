<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
		header("location:warn.php");
}
?>

<html>
<head>
	<title>Tambah User | SK Konversi NIP</title>
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
	<form action="proses_tambah_admin.php" method="post"  class="needs-validation" novalidate>
		<div class="container col-md-5 mar">
			<h1 class="display-4 text-center">Tambah Admin</h1>
			<div class="card">
				<div class="card-block container">
					<div class="row my-4">
						<div class="col-md-4">
							<label class="form-control-label">NIP</label>
						</div>
						<div class="col">
							<input type="text" name="nip" maxlength="18" pattern="^[0-9]{18,18}$" title="max 18 karakter dan berupa angka" class="form-control form-contrl-sm" placeholder="NIP" required autofocus>
						</div>
					</div>
					<div class="row my-4">
						<div class="col-md-4">
							<label class="form-control-label">Nama Lengkap</label>
						</div>
						<div class="col">
							<input type="text" name="nama_lengkap" class="form-control form-contrl-sm" placeholder="Nama Lengkap" required>
						</div>
					</div>
					<div class="row my-4" style="padding-bottom: 5rem;">
						<div class="col-md-4">
							<label class="form-control-label">Password</label>
						</div>
						<div class="col">
							<input type="text" name="pass" class="form-control form-contrl-sm" placeholder="Password" required>
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
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/datepicker.js"></script>
<script src="js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="js/select2.min.js" type="text/javascript"></script>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
</body>
</html>