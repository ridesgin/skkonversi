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
	<link rel="icon" href="favicon.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/datepicker.min.css" rel="stylesheet" type="text/css">
	<link href="css/select2.min.css" rel="stylesheet" type="text/css">
</head>
<?php require 'head.php'; ?>
<div class="container mar col-6">
	<h1 class="display-4 text-center my-2">Laporan Konversi NIP</h1>
	<div id="accordion">
		<div class="card">
			<div class="card-header bg-warning" id="headingOne">
				<h5 class="mb-0">
					<button class="btn btn-link btn-block text-white" style="text-decoration: none" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						<i class="fa fa-list"></i> Laporan Konversi Belum selesai
					</button>
				</h5>
			</div>

			<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
				<div class="card-body">
					<div class="row">
						<div class="col">
							<a href="laporan_konversi_ongoing.php" class="btn btn-warning btn-block">Ongoing</a>
						</div>
						<div class="col">
							<a href="laporan_konversi_kosong.php" class="btn btn-danger btn-block">Masih Kosong</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header bg-info" id="headingTwo">
				<h5 class="mb-0">
					<button class="btn btn-link btn-block collapsed text-white" style="text-decoration: none" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						<i class="fa fa-list"></i> Laporan Per Tanggal
					</button>
				</h5>
			</div>
			<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
				<div class="card-body">
					<form method="get" action="laporan_konversi_tanggal.php">
						<input type="text" class="form-control col-3 datepicker-here" data-position="right top" name="tanggal" value="<?php echo date("Y-m-d"); ?>" required>
						<hr>
						<button type="submit" class="btn btn-primary">Cek</button>
					</form>
				</div>
			</div>
		</div>
		<!-- <div class="card">
			<div class="card-header" id="headingThree">
				<h5 class="mb-0">
					<button class="btn btn-link collapsed" style="text-decoration: none" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						<i class="fa fa-list"></i> Per minggu
					</button>
				</h5>
			</div>
			<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
				<div class="card-body">
						<input type="text" class="form-control" pattern=".{3,}" required title="3 characters minimum" maxlength="5">
						<input type="submit" name="a" value="ngopilah">
				</div>
			</div>
		</div> -->
		<div class="card">
			<div class="card-header bg-info" id="headingFour">
				<h5 class="mb-0">
					<button class="btn btn-link btn-block collapsed text-white" style="text-decoration: none" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
						<i class="fa fa-list"></i> Per Bulan
					</button>
				</h5>
			</div>
			<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
				<div class="card-body">
					<form action="laporan_konversi_bulanan.php" action="GET">
						<font class="form-label" for="bulan">Pilih Bulan</font>
						<select class="form-control col-6" name="bulan" id="bulan" required>
							<option value="01" value="01">Januari</option>
							<option value="02">Februari</option>
							<option value="03">Maret</option>
							<option value="04">April</option>
							<option value="05">Mei</option>
							<option value="06">Juni</option>
							<option value="07">Juli</option>
							<option value="08">Agustus</option>
							<option value="09">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
						</select>
						<font class="form-label">Masukkan Tahun</font>
						<input type="number" min="2005" step="1" class="form-control col-2" name="tahun" required maxlength="4">
						<hr>
						<button type="submit" class="btn btn-primary">Cek</button>
					</form>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header bg-info" id="headingFive">
				<h5 class="mb-0">
					<button class="btn btn-link collapsed text-white btn-block" data-toggle="collapse" style="text-decoration: none" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
						<i class="fa fa-list"></i> Per Tahun
					</button>
				</h5>
			</div>
			<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
				<div class="card-body">
					<form action="laporan_konversi_tahunan.php" method="GET">
						<input type="number" min="2005" step="1" required name="tahun" class="form-control col-3">
						<hr>
						<button type="submit" class="btn btn-primary">Cek</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/datepicker.js"></script>
<script src="js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="js/select2.min.js" type="text/javascript"></script>
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