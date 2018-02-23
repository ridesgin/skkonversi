<?php

session_start();
if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
?>

<html>
<head>
	<title>Input Konversi | SK Konversi NIP</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="favicon.ico">
</head>
<body style="background-color: #2F2545;">
	<center style="margin-top: 15rem;">
		<i class="fa fa-spinner fa-spin" style="font-size: 20rem; color: white;"></i>
	</center>
<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>

<?php
//var_dump($_POST);
include ("koneksi.php");
if (isset($_POST['submit'])) {
	try{
		$id_pengantar		= $_POST['id_pengantar'];
		$nip 				= $_POST['nip'];
		$jenis_ralat 		= $_POST['jenis_ralat'];
		$sk_cpns 			= (isset($_POST['sk_cpns'])) ? 1 : 0;
		$sk_terakhir 		= (isset($_POST['sk_terakhir'])) ? 1 : 0;
		$ijazah 			= (isset($_POST['ijazah'])) ? 1 : 0;
		$sk_konversi 		= (isset($_POST['sk_konversi'])) ? 1 : 0;
		$surat_kehilangan 	= (isset($_POST['surat_kehilangan'])) ? 1 : 0;
		$uid				= $_SESSION['uid'];
		$keterangan 		= $_POST['keterangan'];
		$bahan_tidak_lengkap	= (isset($_POST['bahan_tidak_lengkap'])) ? 1 : 0;
		$ralat_sapk				= (isset($_POST['ralat_sapk'])) ? 1 : 0;
		$ralat_belum_cetak		= (isset($_POST['ralat_belum_cetak'])) ? 1 : 0;
		$cetak					= (isset($_POST['cetak'])) ? 1 : 0;
		$ambil					= (isset($_POST['ambil'])) ? 1 : 0;
		$tgl_input 				= date("Y-m-d");
		
		//$data_sebelum		= $_POST['data_sebelum'];
		//$data_sesudah		= $_POST['data_sesudah'];
		//$keterangan			= $_POST['keterangan'];
		//$uid				= $_POST['uid'];
		//$tgl_input			= $_POST['tgl_input'];
									//INSERT INTO konversi(id_pengantar, nip, jenis_ralat, sk_cpns, sk_terakhir, ijazah, sk_konversi, uid) VALUES (5,1234,1,1,1,1,1,2)
		$sql = $connect->prepare("INSERT INTO konversi(id_pengantar, nip, jenis_ralat, sk_cpns, sk_terakhir, ijazah, sk_konversi, surat_kehilangan, bahan_tidak_lengkap, keterangan, ralat_sapk, ralat_belum_cetak, cetak, ambil, uid, tgl_input) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$sql->bind_param('iissssssssssssis', $id_pengantar, $nip, $jenis_ralat, $sk_cpns, $sk_terakhir, $ijazah, $sk_konversi, $surat_kehilangan, $bahan_tidak_lengkap, $keterangan, $ralat_sapk, $ralat_belum_cetak, $cetak, $ambil, $uid, $tgl_input);
		$sql->execute();
		$sql->close();
		print"
		<script>
		alert(\" Berhasil \");
			history.back(-2);
		</script>";
	}catch(Exception $e){
		echo $e->getMessage();
	}
}
?>