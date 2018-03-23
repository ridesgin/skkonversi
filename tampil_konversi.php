<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
		header("location:warn.php");
}
$sql = $connect->query("SELECT *, pns.nip FROM konversi INNER JOIN pns ON konversi.nip = pns.nip WHERE konversi.id_konversi = " . $_GET['id_konversi']);
$res = $sql->fetch_assoc();

$sql2 = $connect->query("SELECT * FROM proses_konversi INNER JOIN konversi ON proses_konversi.id_konversi = konversi.id_konversi WHERE proses_konversi.id_konversi = " . $_GET['id_konversi']);
$res2 = $sql2->fetch_assoc();

if ($res['jenis_ralat'] == 1){
	$jenis_ralat = "Ralat nama";
} elseif ($res['jenis_ralat'] == 2) {
	$jenis_ralat = "TMT CPNS";
} elseif ($res['jenis_ralat'] == 3) {
	$jenis_ralat = "Ralat jenis Kelamin";
} elseif ($res['jenis_ralat'] == 4) {
	$jenis_ralat = "Ralat Tanggal lahir";
} elseif ($res['jenis_ralat'] == 5) {
	$jenis_ralat = "Cetak ulang / kehilangan konversi nip";
} else {
	$jenis_ralat = "";
}

if ($res['sk_cpns'] == 1){
	$sk_cpns = 'Copy Sah SK cpns';
} elseif ($res['sk_cpns'] == 0){
	$sk_cpns = '';
}
if ($res['sk_terakhir'] == 1){
	$sk_terakhir = 'Copy Sah SK Terakhir';
} elseif ($res['sk_terakhir'] == 0){
	$sk_terakhir = '';
}
if ($res['ijazah'] == 1){
	$ijazah = 'Copy sah ijazah saat pengangkatan';
} elseif ($res['ijazah'] == 0){
	$ijazah = '';
}
if ($res['sk_konversi'] == 1){
	$sk_konversi = 'Sk konversi nip asli';
} elseif ($res['sk_konversi'] == 0) {
	$sk_konversi = '';
}
if ($res['surat_kehilangan'] == 1){
	$surat_kehilangan = 'Surat kehilangan asli dari kepolisian';
} elseif ($res['surat_kehilangan'] == 0) {
	$surat_kehilangan = '';
};
	/*$arr = array($sk_cpns, $sk_terakhir, $ijazah, $sk_konversi, $surat_kehilangan);
	echo implode(", ",$arr);*/
if (is_null($res['nip'])){
	$atr = "";
} else {
	$atr = "hidden";
};
?>
<html>
<head>
	<title>Input Surat Pengantar | SK Konversi NIP</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/datepicker.min.css" rel="stylesheet" type="text/css">
	<link href="css/select2.min.css" rel="stylesheet" type="text/css">
	<style type="text/css">
		label, li{
			font-size: 1.3em;
		}
	</style>
</head>
	<?php require 'head.php'; ?>
	<div class="container mar col-9">
		<h1 class="text-center display-4 mt-2">Tampil Konversi</h1>
		<div class="alert alert-danger text-center" role="alert" <?php echo $atr ?>>
			<i class="fa fa-exclamation-triangle"></i> Tidak ada data yang terkait / ada kesalahan <i class="fa fa-exclamation-triangle"></i>
		</div>
		<div class="card">
			<div class="card-block">
				<div class="container">
					<div class="row">
						<div class="col">
							<label >NIP :</label>
						</div>
						<div class="col">
							<label><?php echo $res['nip'] ?></label>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label>Nama :</label>
						</div>
						<div class="col">
							<label><?php echo $res['nama'] ?></label>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label>Jenis Ralat</label>
						</div>
						<div class="col">
							<label><?php echo $jenis_ralat ?></label>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label>Kelengkapan</label>
						</div>
						<div class="col">
							<div>
								<ul>
								    <li><?php echo $sk_cpns ?></li>
								    <li><?php echo $sk_terakhir ?></li>
								    <li><?php echo $ijazah ?></li>
								    <li><?php echo $sk_konversi ?></li>
								    <li><?php echo $surat_kehilangan ?></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label>Jenis Proses</label>
						</div>
						<div class="col">
							<label><?php $res2['jenis_proses'];
								if (is_null($res2['jenis_proses'])){
									echo "";
								} elseif ($res2['jenis_proses'] == 0){
									echo "Bahan tidak Lengkap : " . $res2['keterangan'];
								} elseif ($res2['jenis_proses'] == 1){
									echo "Ralat SAPK";
								} elseif ($res2['jenis_proses'] == 2){
									echo "Ralat SAPK";
								} elseif ($res2['jenis_proses'] == 3){
									echo "Ralat Belum Cetak";
								} else {
									echo "Cetak";
								};
								?>
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label>Data Sebelum</label>
						</div>
						<div class="col">
							<label><?php echo $res['data_sebelum'] ?></label>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label>Data sesudah</label>
						</div>
						<div class="col">
							<label><?php echo $res['data_sesudah'] ?></label>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label>Tanggal Input</label>
						</div>
						<div class="col">
							<label><?php echo $res['tgl_input'] ?></label>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label>Keterangan</label>
						</div>
						<div class="col">
							<label><?php echo $res['keterangan'] ?></label>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<a onclick="window.history.go(-1); return false;" class="btn btn-warning">Kembali <i class="fa fa-reply"></i></a>
			</div>
		</div>
	</div>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/datepicker.js"></script>
<script src="js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="js/select2.min.js" type="text/javascript"></script>
</body>
</html>