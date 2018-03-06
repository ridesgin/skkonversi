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
	<div class="container-fluid mar">
		<?php $hasil=mysqli_query($connect, "SELECT * FROM pengantar  WHERE tgl_transaksi between '$tanggal' AND '$sampai_tanggal' ORDER BY id_dana DESC");
		?>
		<div class="card">
			<div class="card-header">
				<h3 class="font-weight-normal">Laporan Konversi NIP</h3>
				<input type="text" onclick="cari" class="form-control form-control-sm col-sm-3" placeholder="Cari">
			</div>
			<div class="card-block">
				<div class="table-responsive-xl">
					<table class="table table-bordered table-sm table-hover" style="overflow-x:auto;">
						<tr class="thead-dark">
							<th style="width: 4%" class="text-center">No</th>
							<th>NIP</th>
							<th>Jenis Ralat</th>
							<th>Kelengkapan</th>
							<th>Data Sebelum</th>
							<th>Data Sesudah</th>
							<th>Keterangan</th>
							<th style="width: 10%">Tanggal Input</th>
							<th style="width: 8rem;">Aksi</th>
						</tr>
						<?php
							$no = 1;
							$sql = mysqli_query($connect, "SELECT * from konversi");
							foreach ($sql as $row) {
						?>
						<tr>
							<td class="text-center"><?php echo $no++ ?></td>
							<td><?php echo $row['nip']?></td>
							<td><?php if ($row['jenis_ralat'] == 1){
								echo "Ralat nama";
							} elseif ($row['jenis_ralat'] == 2) {
								echo "TMT CPNS";
							} elseif ($row['jenis_ralat'] == 3) {
								echo "Ralat jenis Kelamin";
							} elseif ($row['jenis_ralat'] == 4) {
								echo "Ralat Tanggal lahir";
							} else {
								echo "Cetak ulang / kehilangan konversi nip";
							}
							?>
								
							</td>
							<td><?php echo $row['sk_cpns']?></td>

							<td><?php if ($row['data_sebelum'] == NULL){
								echo "-";
							} else {
								echo $row['data_sebelum'];
							}
							?></td>
							<td><?php if ($row['data_sesudah'] == NULL){
								echo "-";
							} else {
								echo $row['data_sebelum'];
							}
							?></td>
							<td>
								<?php if ($row['bahan_tidak_lengkap'] == 1){
									echo "Bahan tidak Lengkap : ";
								} else {
									echo "";
								};
									echo $row['keterangan'];

									if ($row['ralat_sapk'] == 1){
									echo "Ralat SAPK";
								} else {
									echo "";
								};

									if ($row['ralat_belum_cetak'] == 1){
									echo "Ralat Belum Cetak";
								} else {
									echo "";
								};

									if ($row['cetak'] == 1){
									echo "Cetak : ";
								} else {
									echo "";
								};

									if ($row['ambil'] == 1){
									echo "Ambil";
								} else {
									echo "";
								};
								?>
							</td>
							<td><?php echo $row['tgl_input']?></td>
							<td>
								<div class="btn-group justify-content-center">
									<?php
									echo "<a href='#' class='btn btn-outline-info'><i class='fa fa-info-circle'></i></a>";
									echo "<a href='update_konversi.php?id_konversi=" .$row['id_konversi']. "' class='btn btn-outline-primary'><i class='fa fa-pencil'></i></a>";
									echo "<a href='hapus_konversi.php?id_konversi=" .$row['id_konversi']. "' onClick='return tanya()' class='btn btn-outline-danger'><i class='fa fa-trash'></i></a>";									
									?>
								</div>
							</td>
						</tr>	
						<?php
							}
						?>
					</table>
				</div>
			</div>
			<div class="card-footer" style="height: 3rem;">
				<label>Total :</label><span class="badge badge-info"><?php echo mysqli_num_rows($sql) ?></span>
			</div>
		</div>
	</div>

<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
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