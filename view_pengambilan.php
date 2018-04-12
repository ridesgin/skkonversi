<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
		header("location:warn.php");
}
?>
<html>
<head>
	<title>Pengambilan | SK Konversi NIP</title>
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
<?php include 'head.php'; ?>
	<div class="container mar">
		<h1 class="text-center display-4 mb-2">Pengambilan</h1>
		<div class="card">
			<div class="card-header">
				<a href="input_rincian_pengambilan.php" class="btn btn-primary float-right">Tambah <i class="fa fa-plus"></i></a>
			</div>
			<?php
			include 'pagination2.php';

			//pagination config start
			$q = isset($_REQUEST['q']) ? urldecode($_REQUEST['q']) : ''; // untuk keyword pencarian
			$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // untuk nomor halaman
			$adjacents = isset($_GET['adjacents']) ? intval($_GET['adjacents']) : 3; // khusus style pagination 2 dan 3
			$rpp = 10; // jumlah record per halaman

			$db_link = mysqli_connect('localhost', 'root', '', 'mydb'); // sesuaikan username dan password mysqli anda

			$sql = "SELECT *, pns.nama FROM pengambilan INNER JOIN pns ON pns.nip = pengambilan.nip WHERE pengambilan.nip LIKE '%$q%' ORDER BY id_pengambilan DESC"; // query pencarian silahkan disesuaikan
			$result = mysqli_query($db_link, $sql); // eksekusi query

			$tcount = mysqli_num_rows($result); // jumlah total baris
			$tpages = isset($tcount) ? ceil($tcount / $rpp) : 1; // jumlah total halaman
			$count = 0; // untuk paginasi
			$i = ($page - 1) * $rpp; // batas paginasi
			$no_urut = ($page - 1) * $rpp; // nomor urut
			$reload = $_SERVER['PHP_SELF'] . "?q=" . $q . "&amp;adjacents=" . $adjacents; // untuk link ke halaman lain
			//pagination config end
			?>
			<div class="card-block">
				<div class="table-responsive">
					<table class="table-sm table-hover table-striped">
						<tr class="bg-dark text-white" style="height: 40px;">
							<th class="text-center">No</th>
							<th>Tanggal Pengambilan</th>
							<th>NIP</th>
							<th>Nama Pengambil</th>
							<th>Keterangan</th>
							<th class="text-center">Aksi</th>
							<th class="text-center">crud</th>
						</tr>
						<?php
						if (mysqli_num_rows($result) > 0){
						while (($count < $rpp) && ($i < $tcount)) {
							
							mysqli_data_seek($result, $i);
							$data = mysqli_fetch_array($result);
							/*$sql5 = $connect->query("SELECT nama FROM pns WHERE nip=".$data['nip']);
							$row5 = $sql5->fetch_assoc();*/
							?>
							<tr>
								<td class="text-center"><?php echo ++$no_urut; ?></td>
								<td><?php echo $data['tanggal_pengambilan'];?></td>
								<td><?php echo $data['nip']?>	
							</td>
							<td>
								<?php echo $data['nama'] ?>
							</td>
							<td>
								<?php echo $data['keterangan'] ?>
							</td>
							<td align="center">
								<?php
								echo "<a href='input_detail_pengambilan.php?id_pengambilan=" .$data['id_pengambilan']. "'class='btn btn-primary'><i class='fa fa-plus'></i></a>";									
								?>
							</td>
							<td align="center">
								<div class="btn-group justify-content-center">
									<?php
									echo "<a href='#' class='btn btn-info'><i class='fa fa-info-circle'></i></a>";
									echo "<a href='update_rincian_pengambilan.php?id_pengambilan=" .$data['id_pengambilan']. "' class='btn btn-primary'><i class='fa fa-pencil'></i></a>";
									echo "<a href='delete_pengambilan.php?id_pengambilan=" .$data['id_pengambilan']. "' onClick='return tanya()' class='btn btn-danger'><i class='fa fa-trash'></i></a>";									
									?>
								</div>
							</td>
						</tr>	
						<?php
						$i++;
						$count++;
							}
						
						$kosong = "hidden";
						} else {
						$kosong = "";
						}
						?>
					</table>
					<div class="alert alert-danger alert-dismissible fade show my-2" role="alert" <?php echo $kosong ?>>
						<center>
							<strong>Tidak ada data</strong> <i class="fa fa-ban"></i>
						</center>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
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
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/datepicker.js"></script>
<script src="js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="js/select2.min.js" type="text/javascript"></script>
<script type="text/javascript">
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