<?php
include 'koneksi.php';
session_start();
if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
?>

<html>
<head>
	<title>Laporan Konversi NIP Pertanggal NIP | SK konversi NIP</title>
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


<div class="container-fluid mar">
	<h1 class="display-4 text-center my-2">Laporan Konversi NIP</h1>

	<div class="card">
		<div class="card-header">
			<?php
			include 'pagination_tanggal.php';

	//      pagination config start
			$q = isset($_REQUEST['q']) ? urldecode($_REQUEST['q']) : ''; // untuk keyword pencarian
			$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // untuk nomor halaman
			$adjacents = isset($_GET['adjacents']) ? intval($_GET['adjacents']) : 3; // khusus style pagination 2 dan 3
			$rpp = 10; // jumlah record per halaman

			$db_link = mysqli_connect('localhost', 'root', '', 'mydb'); // sesuaikan username dan password mysqli anda
			$tanggal= $_GET['tanggal'];
			$sql = "SELECT * FROM konversi WHERE nip LIKE '%$q%' AND tgl_input='$tanggal' ORDER BY id_konversi DESC"; // query pencarian silahkan disesuaikan
			$result = mysqli_query($db_link, $sql); // eksekusi query

			$tcount = mysqli_num_rows($result); // jumlah total baris
			$tpages = isset($tcount) ? ceil($tcount / $rpp) : 1; // jumlah total halaman
			$count = 0; // untuk paginasi
			$i = ($page - 1) * $rpp; // batas paginasi
			$no_urut = ($page - 1) * $rpp; // nomor urut
			$reload = $_SERVER['PHP_SELF'] . "?q=" . $q . "&amp;adjacents=" . $adjacents; // untuk link ke halaman lain
	//        pagination config end
			//tanggal :v
			/*if (isset($_GET['tanggal_awal'])) {
				$tanggal_awal	= $_GET['tanggal_awal'];
				$tanggal_akhir	= $_GET['tanggal_akhir'];
				$hasil = mysqli_query($db_link, "SELECT * FROM konversi  WHERE tgl_input between '$tanggal_awal' AND '$tanggal_akhir' ORDER BY id_konversi DESC");
			}*/
			?>
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
				<div class="row">
					<div class="col-4">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Cari berdasarkan NIP" name="q" value="<?php echo $q ?>">
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
					</div><div class="col">
						<strong class="float-right">Laporan per tanggal <?php echo $tanggal;?></strong>
					</div>
				</div>
			</form>

		</div>
		<div class="card-block">
			
			<div class="table-responsive-xl">
				<table class="table-sm table-striped" style="overflow-x:auto;">
					<tr class="bg-dark text-white">
						<th style="width: 4%" class="text-center">No</th>
						<th>NIP</th>
						<th>Jenis Ralat</th>
						<th>Kelengkapan</th>
						<th hidden>Data Sebelum</th>
						<th hidden>Data Sesudah</th>
						<th>Keterangan</th>
						<th style="width: 8%">Tanggal Input</th>
						<th style="width: 8rem;" class="text-center">Aksi</th>
					</tr>
					<?php
					if (mysqli_num_rows($result) > 0){
						while (($count < $rpp) && ($i < $tcount)) {
							mysqli_data_seek($result, $i);
							$data = mysqli_fetch_array($result);
							?>
							<tr>
								<td class="text-center"><?php echo ++$no_urut; ?></td>
								<td><?php echo $data['nip'];?></td>
								<td><?php if ($data['jenis_ralat'] == 1){
									echo "Ralat nama";
								} elseif ($data['jenis_ralat'] == 2) {
									echo "TMT CPNS";
								} elseif ($data['jenis_ralat'] == 3) {
									echo "Ralat jenis Kelamin";
								} elseif ($data['jenis_ralat'] == 4) {
									echo "Ralat Tanggal lahir";
								} else {
									echo "Cetak ulang / kehilangan konversi nip";
								}
								?>
								
							</td>
							<td>
								<?php
								if ($data['sk_cpns'] == 1){
									$sk_cpns = 'Copy Sah SK cpns';
								} elseif ($data['sk_cpns'] == 0){
									$sk_cpns = '';
								}
								if ($data['sk_terakhir'] == 1){
									$sk_terakhir = 'Copy Sah SK Terakhir';
								} elseif ($data['sk_terakhir'] == 0){
									$sk_terakhir = '';
								}
								if ($data['ijazah'] == 1){
									$ijazah = 'Copy sah ijazah saat pengangkatan';
								} elseif ($data['ijazah'] == 0){
									$ijazah = '';
								}
								if ($data['sk_konversi'] == 1){
									$sk_konversi = 'Sk konversi nip asli';
								} elseif ($data['sk_konversi'] == 0) {
									$sk_konversi = '';
								}
								if ($data['surat_kehilangan'] == 1){
									$surat_kehilangan = 'Surat kehilangan asli dari kepolisian';
								} elseif ($data['surat_kehilangan'] == 0) {
									$surat_kehilangan = '';
								};
								$arr = array($sk_cpns, $sk_terakhir, $ijazah, $sk_konversi, $surat_kehilangan);
								echo implode(", ",$arr);
								?>
							</td>

							<td hidden>
								<?php if ($data['data_sebelum'] == NULL){
									echo "-";
								} else {
									echo $data['data_sebelum'];
								}
								?>
							</td>
							<td hidden>
								<?php if ($data['data_sesudah'] == NULL){
									echo "-";
								} else {
									echo $data['data_sebelum'];
								}
								?>
							</td>
							<td>
								<?php
								echo $data['keterangan'];
								?>
							</td>
							<td><?php echo $data['tgl_input']?></td>
							<td align="center">
								<div class="btn-group justify-content-center">
									<?php
									echo "<a href='tampil_konversi.php?id_konversi=" .$data['id_konversi']. "' class='btn btn-outline-info'><i class='fa fa-info-circle'></i></a>";
									echo "<a href='update_konversi.php?id_konversi=" .$data['id_konversi']. "' class='btn btn-outline-primary'><i class='fa fa-pencil'></i></a>";
									echo "<a href='hapus_konversi.php?id_konversi=" .$data['id_konversi']. "' onClick='return tanya()' class='btn btn-outline-danger'><i class='fa fa-trash'></i></a>";									
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
</body>
</html>