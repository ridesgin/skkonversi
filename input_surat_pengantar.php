<?php
include 'koneksi.php';
session_start();
if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
?>
<html>
<head>
	<title>Input Surat Pengantar | SK Konversi NIP</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/datepicker.min.css" rel="stylesheet" type="text/css">
	<link href="css/select2.min.css" rel="stylesheet" type="text/css">
</head>
<form action="proses_surat_pengantar.php" method="post" class="needs-validation" novalidate>
	<?php require 'head.php'; ?>
	<div class="container mar col-8">
		<h1 class="display-4 mb-2 text-center">Input Surat Pengantar</h1>
		<div class="card">
			<div class="card-block container">
				<div class="row my-2">
					<div class="col-md-4">
						<label>Kode Tamu</label>
					</div>
					<div class="col">
						<input type='text' name='kode_tamu' class="form-control form-control-sm col-md-4" placeholder="kode tamu" required>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label>Nomor Surat</label>
					</div>
					<div class="col">
						<input type="text" name="no_surat" class="form-control form-control-sm col-md-5" placeholder="Nomer Surat" required>
					</div>
				</div>
				<div class="row my-2">
					<div class="col-md-4">
						<label>Tanggal Surat</label>
					</div>
					<div class="col">
						<input type="text" name="tgl_surat" class="form-control form-control-sm col-md-3 datepicker-here" data-position="right top" placeholder="Tanggal Surat" required>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label>Instansi</label>
					</div>
					<div class="col">
						<?php $hasil = mysqli_query($connect, "SELECT id_instansi,  nama_instansi FROM instansi"); ?>
						<select name='id_instansi'  placeholder="Instansi" class="form-control form-control-sm col-md-10 dropoi" required>
							<option disabled selected value> -- Pilih instansi -- </option>
							<?php while($row = mysqli_fetch_assoc($hasil)){ ?>
							<option value="<?php echo $row['nama_instansi'];?>"><?php echo $row['nama_instansi'];?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="row my-2">
					<div class="col-md-4">
						<label>Jabatan Spesimen</label>
					</div>
					<div class="col">
						<input type="text" name="jabatan_spesimen" class="form-control form-control-sm col-md-6" placeholder="Jabatan" required>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label>NIP Spesimen</label>
					</div>
					<div class="col">
						<input id="nip" type="text" name="nip_spesimen" class="form-control form-control-sm col-md-4" onkeyup="isi_otomatis()" placeholder="NIP" pattern="^[0-9]{18,18}$" required title="Minimal 18 karakter & brerupa angka" maxlength="18">
					</div>
				</div>
				<div class="row my-2">
					<div class="col-md-4">
						<label>Nama Spesimen</label>
					</div>
					<div class="col">
						<input type="text" name="nama_spesimen" id="nama" class="form-control form-control-sm col-md-8" readonly>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label>Jumlah usulan ralat SK Konversi NIP</label>
					</div>
					<div class="col">
						<input type="number" min="1" max="20" name="jml_usulan" class="form-control form-control-sm col-md-2" required>
					</div>
				</div>
				<div class="row my-2">
					<div class="col-md-4">
						<label>jumlah Lampiran :</label>
					</div>
					<div class="col">
						<input type="number" min="1" max="50" name="jumlah_lampiran" class="form-control form-control-sm col-2" required>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="btn-group btn-group-sm">
					<a onclick="window.location='surat_pengantar.php'" class="btn btn-warning">Kembali <i class="fa fa-reply"></i></a>
					<button type="submit" name="submit" class="btn btn-primary">Submit <i class="fa fa-cogs"></i></button>
				</div>
			</div>
		</div>
	</div>
</form>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/datepicker.js"></script>
<script src="js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="js/select2.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.dropoi').select2();
	});
	function isi_otomatis(){
		var nip = $("#nip").val();
		$.ajax({
			url: 'ajax.php',
			data:"nip="+nip ,
		}).success(function (data) {
			var json = data,
			obj = JSON.parse(json);
			$('#nama').val(obj.nama);
		});
	}
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