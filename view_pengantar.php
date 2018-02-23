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
		<center class="display-4 text-white my-2">Laporan Surat Pengantar</center>
		<div class="card">
			<div class="card-header">
			<?php
			include 'pagination2.php';

	//      pagination config start
			$q = isset($_REQUEST['q']) ? urldecode($_REQUEST['q']) : ''; // untuk keyword pencarian
			$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // untuk nomor halaman
			$adjacents = isset($_GET['adjacents']) ? intval($_GET['adjacents']) : 3; // khusus style pagination 2 dan 3
			$rpp = 10; // jumlah record per halaman

			$db_link = mysqli_connect('localhost', 'root', '', 'mydb'); // sesuaikan username dan password mysqli anda
			$sql = "SELECT * FROM pengantar WHERE kode_tamu LIKE '%$q%' ORDER BY id_pengantar DESC"; // query pencarian silahkan disesuaikan
			$result = mysqli_query($db_link, $sql); // eksekusi query

			$tcount = mysqli_num_rows($result); // jumlah total baris
			$tpages = isset($tcount) ? ceil($tcount / $rpp) : 1; // jumlah total halaman
			$count = 0; // untuk paginasi
			$i = ($page - 1) * $rpp; // batas paginasi
			$no_urut = ($page - 1) * $rpp; // nomor urut
			$reload = $_SERVER['PHP_SELF'] . "?q=" . $q . "&amp;adjacents=" . $adjacents; // untuk link ke halaman lain
	//        pagination config end
			?>
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
				<div class="input-group col-3 float-right">
					<input type="text" class="form-control" placeholder="Cari kode tamu" name="q" value="<?php echo $q ?>">
					<div class="input-group-append">
						<?php
						if ($q <> '')
						{
							?>
							<a class="btn btn-warning" href="<?php echo $_SERVER['PHP_SELF'] ?>">Reset <i class="fa fa-times"></i></a>
							<?php
						}
						?>
						<button class="btn btn-primary" type="submit">Cari <i class="fa fa-search"></i></button>
					</div>
				</div>
			</form>
			</div>
			<div class="card-block">
			<div>
			<!--tabel-->
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table-sm table-striped">
							<thead class="bg-dark text-white">
								<tr>
									<th style="width:4%" class="text-center">No</th>
									<th>Kode Tamu</th>
									<th>No Surat</th>
									<th>Tanggal Surat</th>
									<th>Instansi</th>
									<th>NIP Spesimen</th>
									<th>Jumlah Usulan</th>
									<th>Aksi (konversi)</th>
								</tr>
							</thead>
							<tbody>
								<?php
								while (($count < $rpp) && ($i < $tcount)) {
									mysqli_data_seek($result, $i);
									$data = mysqli_fetch_array($result);
									?>
									<tr>
										<td class="text-center">
											<?php echo ++$no_urut; ?> 
										</td>

										<td>
											<?php echo $data ['kode_tamu']; ?> 
										</td>
										<td>
											<?php echo $data ['no_surat']; ?> 
										</td>
										<td>
											<?php echo $data ['tgl_surat']; ?> 
										</td>
										<td>
											<?php echo $data ['id_instansi']; ?> 
										</td>
										<td>
											<?php echo $data ['nip_spesimen']; ?> 
										</td>
										<td>
											<?php echo $data ['jml_usulan']; ?> 
										</td>
										<td width="120px" class="text-center">
											<div class="btn-group">
												<?php
												echo "<a href='#' class='btn btn-outline-info'><i class='fa fa-info-circle'></i></a>";
												echo "<a href='#' class='btn btn-outline-primary'><i class='fa fa-pencil'></i></a>";
												echo "<a href='delete_pengantar.php?id_pengantar=" .$data['id_pengantar']. "'onClick='return tanya()' class='btn btn-outline-danger'><i class='fa fa-trash'></i></a>";
												?>
											</div>
										</td>
									</tr>
									<?php
									$i++;
									$count++;
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<div class="row">
			<div class="col-md-12">
				<!--silahkan di komen atau di hapus saja baris yang tidak ingin digunakan-->
				<?php // paginate_one($reload, $page, $tpages); ?>
				<?php echo paginate_two($reload, $page, $tpages, $adjacents); ?>
				<?php //echo paginate_three($reload, $page, $tpages, $adjacents); ?>
				<?php //echo paginate_four($reload, $page, $tpages); ?>
				<?php //echo paginate_five($reload, $page, $tpages); ?>
			</div>
		</div>
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