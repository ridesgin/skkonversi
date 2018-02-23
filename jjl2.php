<?php
include 'koneksi.php';
session_start();
if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
?>

<html>
<head>
	<title>Laporan Surat Pengantar | SK Konversi NIP</title>
	<meta charset=utf-8>
	<meta name=description content="">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="favicon.ico">
</head>
	<?php require 'head.php'; ?>
	<div class="container-fluid mar">
		<div class="card">
			<div class="card-header">
				<h3 class="font-weight-normal">Laporan Surat Pengantar</h3>
				<input type="text" class="form-control form-control-sm col-sm-3" placeholder="Cari">
			</div>
			<div class="card-block">
				<div style="overflow-x:auto;">
					<table class=" table table-bordered table-sm table-hover">
						<tr class="bg-dark" style="color: white">
							<th style="width: 4%">No</th>
							<th>kode tamu</th>
							<th>no surat</th>
							<th>tanggal surat</th>
							<th>kode instansi</th>
							<th>nip spesimen</th>
							<th>jumlah usulan</th>
							<th style="width: 8rem;">Aksi</th>
						</tr>
						<?php
						$no = 1;
							$sql = mysqli_query($connect, "SELECT * FROM pengantar");
							foreach ($sql as $row){
						?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $row['kode_tamu'] ?></td>
							<td><?php echo $row['no_surat'] ?></td>
							<td><?php echo $row['tgl_surat'] ?></td>
							<td><?php echo $row['id_instansi'] ?></td>
							<td><?php echo $row['nip_spesimen'] ?></td>
							<td><?php echo $row['jml_usulan'] ?></td>
							<td>
								<div class="btn-group justify-content-center">
								<?php
								echo "<a href='#' class='btn btn-outline-info'><i class='fa fa-info-circle'></i></a>";
								echo "<a href='#' class='btn btn-outline-primary'><i class='fa fa-pencil'></i></a>";
								echo "<a href='delete_pengantar.php?id_pengantar=" .$row['id_pengantar']. "'onClick='return tanya()' class='btn btn-outline-danger'><i class='fa fa-trash'></i></a>";
								?>
								</div>
							</td>
						<?php } ?>
						</tr>
					</table>
				</div>
			</div>
			<div class="card-footer" style="height: 3rem;">
				<label>Total :</label><span class="badge badge-info"><?php echo mysqli_num_rows($sql) ?></span>
			</div>
		</div>
	</div>
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
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