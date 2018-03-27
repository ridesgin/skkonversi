<?php
include 'koneksi.php';
session_start();
if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
$id_pengambilan = $_GET['id_pengambilan'];
$sql = $connect->query("SELECT *, pns.nama FROM pengambilan INNER JOIN pns ON pengambilan.nip = pns.nip WHERE id_pengambilan = $id_pengambilan");
$res = $sql->FETCH_ASSOC();
?>
<html>
<head>
	<title>Input Surat Pengantar | SK Konversi NIP</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico">
	<?php include 'script-link.php'; ?>
	<link rel="icon" href="favicon.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/datepicker.min.css" rel="stylesheet" type="text/css">
	<link href="css/select2.min.css" rel="stylesheet" type="text/css">
</head>
<form action="proses_update_rincian_pengambilan.php" method="post">
	<?php require 'head.php'; ?>
	<div class="container col-6 mar">
		<h1 class="display-4 text-center text-warning">Update Pengambilan</h1>
		<div class="card">
			<div class="card-block">
				<div class="container">
					<div class="row mb-2 mt-5">
						<div class="col-3">
							<label class="form-control-label">ID pengambilan</label>
						</div>
						<div class="col-3">
							<input type="text" class="form-control form-control-sm" autocomplete="off" name="id_pengambilan" value="<?php echo $id_pengambilan ?>" required>
						</div>
					</div>
					<div class="row mb-2 mt-5">
						<div class="col-3">
							<label class="form-control-label">Tanggal</label>
						</div>
						<div class="col-3">
							<input type="text" class="form-control form-control-sm datepicker-here" data-position="right top" autocomplete="off" name="tanggal_pengambilan" value="<?php echo $res['tanggal_pengambilan'] ?>" required>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-3">
							<label class="form-control-label">NIP Pengambil</label>
						</div>
						<div class="col-4">
							<?php $hasil = mysqli_query($connect, "SELECT * FROM pengguna"); ?>
							<select type='text' id="nip" name='nip' class="form-control form-control-sm dropoi" onchange="isi_otomatis()" required>

								<option value="<?php echo $res['nip'];?>"> <?php echo $res['nip'];?></option> 
								<option disabled value>-- nip --</option>
								<?php while($row = mysqli_fetch_assoc($hasil)){ ?>
								<option value="<?php echo $row['nip'];?>"> <?php echo $row['nip'];?></option> 
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-3">
							<label class="form-control-label">Nama</label>
						</div>
						<div class="col-7">
							<input type="text" name="nama" id="nama" class="form-control form-control-sm" placeholder="nama akan muncul otomatis jika nip benar" value="<?php echo $res['nama'] ?>" readonly>
						</div>
					</div>
					<div class="row mb-5">
						<div class="col-3">
							<label class="form-control-label">Keterangan</label>
						</div>
						<div class="col">
							<textarea class="form-control" style="height: 100px" name="keterangan"><?php echo $res['keterangan'] ?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<a onclick="window.history.go(-1); return false;" class="btn btn-warning">Kembali <i class="fa fa-reply"></i></a>
				<button type="submit" name="input" class="btn btn-success">Update <i class="fa fa-cogs"></i></button>
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
</script>
</body>
</html>