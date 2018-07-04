<?php
include 'koneksi.php';
session_start();
if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
?>

<html>
<head>
	<title>Laporan Konversi NIP | SK konversi NIP</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="favicon.ico">
</head>
<?php require 'head.php'; ?>
<div class="container mar col-6">
	<center class="display-4 text-white my-2">Laporan Konversi NIP</center>
	<div id="accordion">
		<div class="card">
			<div class="card-header" id="headingOne">
				<h5 class="mb-0">
					<button class="btn btn-link text-danger" style="text-decoration: none" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						<i class="fa fa-list"></i> Laporan Konversi Belum selesai
					</button>
				</h5>
			</div>

			<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
				<div class="card-body">
					Belum selesai
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingTwo">
				<h5 class="mb-0">
					<button class="btn btn-link collapsed" style="text-decoration: none" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						<i class="fa fa-list"></i> Laporan Per Tanggal
					</button>
				</h5>
			</div>
			<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
				<div class="card-body">
					<input type="date" class="form-control col-5">
					<hr>
					<button type="submit" class="btn btn-primary">Cek</button>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingThree">
				<h5 class="mb-0">
					<button class="btn btn-link collapsed" style="text-decoration: none" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						<i class="fa fa-list"></i> Per minggu
					</button>
				</h5>
			</div>
			<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
				<div class="card-body">
					<input ty
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingFour">
				<h5 class="mb-0">
					<button class="btn btn-link collapsed" style="text-decoration: none" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
						<i class="fa fa-list"></i> Per Bulan
					</button>
				</h5>
			</div>
			<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
				<div class="card-body">
					<select class="form-control col-6">
						<option>Januari</option>
						<option>Februari</option>
						<option>Maret</option>
						<option>April</option>
						<option>Mei</option>
						<option>Juni</option>
						<option>Juli</option>
						<option>Agustus</option>
						<option>September</option>
						<option>Oktober</option>
						<option>November</option>
						<option>Desember</option>
					</select>
					<hr>
					<button type="submit" class="btn btn-primary">Cek</button>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingFive">
				<h5 class="mb-0">
					<button class="btn btn-link collapsed" data-toggle="collapse" style="text-decoration: none" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
						<i class="fa fa-list"></i> Per Tahun
					</button>
				</h5>
			</div>
			<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
				<div class="card-body">
					<select class="form-control col-6">
						<option>2010</option>
						<option>2011</option>
						<option>2012</option>
						<option>2013</option>
						<option>2014</option>
						<option>2015</option>
						<option>2016</option>
						<option>2017</option>
						<option>2018</option>
						<option>2019</option>
						<option>2020</option>
					</select>
					<hr>
					<button type="submit" class="btn btn-primary">Cek</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
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

	function tanya() {
		if (confirm("Apakah anda ingin hapus data ini ?")){
			return true;
		} else {
			return false;
		}
	}
</script>
</body>
</html>