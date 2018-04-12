<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
		header("location:warn.php");
}
$query = $connect->query("SELECT *,pns.nama FROM pengambilan INNER JOIN pns ON pengambilan.nip = pns.nip");
$tampil = $query->fetch_assoc();
?>
<html>
<head>
	<title>Input Detail Pengambilan | SK Konversi NIP</title>
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
	<form action="proses_detail_pengambilan.php" method="post">
	<?php require 'head.php'; ?>
		<div class="container mar col-7">
			<h1 class="text-center display-4">Ambil</h1>
			<div class="card">
				<div class="card-block">
					<div class="container">
						<div class="row mt-5">
							<div class="col-4">
								<label class="form-control-label">ID Pengambilan</label>
							</div>
							<div class="col-3">
								<input type="text" class="form-control form-control-sm" name="id_pengambilan" value="<?php echo $_GET['id_pengambilan'] ?>" required>
							</div>
						</div>
						<div class="row mt-5">
							<div class="col-4">
								<label class="form-control-label">Tanggal Pengambilan</label>
							</div>
							<div class="col-3">
								<input type="text" class="form-control form-control-sm datepicker-here" data-position="right top" name="tanggal_pengambilan" value="<?php echo date("Y-m-d"); ?>" required>
							</div>
						</div>
						<div class="row my-2">
							<div class="col-4">
								<label class="form-control-label">Nama pengambil</label>
							</div>
							<div class="col-5">
								<input type="text" class="form-control form-control-sm" name="nama" value="<?php echo $tampil['nama'] ?>" required>
							</div>
						</div>
						<hr>
						<div class="row mb-4">
							<div class="col">
								<?php $hasil = $connect->query("SELECT *, pns.nip FROM konversi INNER JOIN pns ON konversi.nip = pns.nip"); ?>
								<select type='text' name='id_konversi' class="form-control form-control-sm dropoi" id="nip" required onchange="isi_otomatis()">
									<option disabled selected value>-- NIP | Nama | Jenis Ralat | ID Konversi --</option>
									<?php
									foreach ($hasil as $row) {
										if ($row['jenis_ralat'] == 1){
											$jenis_ralat = "Ralat nama";
										} elseif ($row['jenis_ralat'] == 2) {
											$jenis_ralat = "TMT CPNS";
										} elseif ($row['jenis_ralat'] == 3) {
											$jenis_ralat = "Ralat jenis Kelamin";
										} elseif ($row['jenis_ralat'] == 4) {
											$jenis_ralat = "Ralat Tanggal lahir";
										} else {
											$jenis_ralat = "Cetak ulang / kehilangan konversi nip";
										}
										/*
										$sql3 = $connect->query("SELECT jenis_ralat FROM konversi WHERE nip=".$row['nip']);
										$row3 = $sql3->fetch_asoc();
										echo " | " . $row2['nama']; echo " | " . $row3['jenis_ralat']; 
										*/
									?>
									<option value="<?php echo $row['id_konversi'];?>"> <?php echo $row['nip']; echo " | " . $row['nama']; echo " | " . $jenis_ralat; echo " | " . $row['id_konversi'];?></option>
									<?php

									} 
									?>
								</select>
							</div>
							<!-- <div class="col">
								<select class="form-control" name="jenis_proses" required>
									<option  disabled selected value>-- Jenis Ralat --</option>
									<option value="0">Bahan Tidak lengkap</option>
									<option value="1">Ralat SAPK saja</option>
									<option value="2">Ralat belum cetak</option>
									<option value="3">cetak</option>
								</select>
							</div> -->
						</div>
					</div>
				</div>
				<div class="card-footer">
					<a onclick="window.history.go(-1); return false;" class="btn btn-warning">Kembali <i class="fa fa-reply"></i></a>
					<button type="submit" class="btn btn-success" name="input">Kirim</button>
				</div>
			</div>
		</div>
	</form>
	<div class="container">
		<div class="card">
			<div class="card-block">
				<table class="table-hover table-sm">
					<tr class="bg-dark text-white" style="height: 2.5rem;">
						<th>NO</th>
						<th>Id Pengambilan</th>
						<th>id Konversi</th>
					</tr>
					<tr>
						<?php
						$no = 1;
						$query2 = $connect->query("SELECT * FROM detil_pengambilan where id_pengambilan = " . $_GET['id_pengambilan']);
						printf($query2->num_rows);
						foreach ($query2 as $res) {
						/*$res = $query2->fetch_assoc();*/
						?>
						<td><?php echo $no++ ?></td>
						<td><?php echo $res['id_pengambilan'] ?></td>
						<td><?php echo $res['id_konversi'] ?> </td>
						<?php } ?>
					</tr>
				</table>
			</div>
		</div>
	</div>
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
</script>
</body>
</html>