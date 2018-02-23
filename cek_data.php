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
<body>
	<div class="container mar">
		<div class="card">
			<div class="card-block">
				<div class="container" style="padding: 4rem;">
					<div class="row">
						<div class="col-sm-2"><label>Nip</label></div>
						<div class="col-md-4"><input maxlength="18" id="nip" name="nip" onkeyup="isi_otomatis()" type="text=" class="form-control form-control-sm" placeholder="Masukkan NIP"></div>
					</div>
					<div class="row">
						<div class="col-sm-2"><label>Nama Tamu</label></div>
						<div class="col-md-4"><input id="nama" name="nama" type="text" class="form-control form-control-sm" placeholder="Nama akan muncul otomatis jika NIP benar" > </div>
					</div>
					<div class="row">
						<div class="col-sm-2"><label>Tanggal Proses</label></div>
						<div class="col">: $Tanggal</div>
					</div>
					<div class="row">
						<div class="col-sm-3"><label>Jenis Ralat Konversi NIP</label></div>
						<div class="col">: $Jenis</div>
					</div>
					<div class="row">
						<div class="col-sm-3"><label>Keterangan Proses</label></div>
						<div class="col">: $keterangan</div>
					</div>
				</div>						
			</div>
		</div>
	</div>
</body>
<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
	function isi_otomatis(){
		var nip = $("#nip").val();
		$.ajax({
			url: 'ajax2.php',
			data:"nip="+nip ,
		}).success(function (data) {
			var json = data,
			obj = JSON.parse(json);
			$('#nama').val(obj.jenis_ralat);
		});
	}
</script>
</body>
</html>