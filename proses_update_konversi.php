<?php
session_start();
if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
include ("koneksi.php");
if (isset($_POST['submit'])) {
	try{
		$id_konversi			= $_POST['id_konversi'];
		$nip 					= $_POST['nip'];
		$jenis_ralat 			= $_POST['jenis_ralat'];
		$sk_cpns 				= (isset($_POST['sk_cpns'])) ? 1 : 0;
		$sk_terakhir 			= (isset($_POST['sk_terakhir'])) ? 1 : 0;
		$ijazah 				= (isset($_POST['ijazah'])) ? 1 : 0;
		$sk_konversi 			= (isset($_POST['sk_konversi'])) ? 1 : 0;
		$surat_kehilangan 		= (isset($_POST['surat_kehilangan'])) ? 1 : 0;
		$uid					= $_SESSION['uid'];
		if (empty($_POST['keterangan2'])) {
			$keterangan = $_POST['keterangan'];
		} else {
			$keterangan	= $_POST['keterangan'] . ":".  $_POST['keterangan2'];
		}
		
		$tgl_input 				= date("Y-m-d");

		$sql = $connect->prepare("UPDATE konversi SET nip = ?, jenis_ralat = ?, sk_cpns = ?, sk_terakhir = ?, ijazah = ?, sk_konversi = ?, surat_kehilangan = ?, keterangan = ?, uid = ? WHERE id_konversi = $id_konversi");
		$sql->bind_param('isssssssi', $nip, $jenis_ralat, $sk_cpns, $sk_terakhir, $ijazah, $sk_konversi, $surat_kehilangan, $keterangan, $uid);
		$sql->execute();
		$sql->close();
		print"<script>alert(\" Berhasil Update \");history.back(-3);</script>";
	}catch(Exception $e){
		echo $e->getMessage();
	}
}
?>