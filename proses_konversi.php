<?php

session_start();
if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
?>


<?php
//var_dump($_POST);
include ("koneksi.php");
if (isset($_POST['submit'])) {
	try{
		$id_pengantar			= $_POST['id_pengantar'];
		$nip 					= $_POST['nip'];
		$jenis_ralat 			= $_POST['jenis_ralat'];
		$sk_cpns 				= (isset($_POST['sk_cpns'])) ? 1 : 0;
		$sk_terakhir 			= (isset($_POST['sk_terakhir'])) ? 1 : 0;
		$ijazah 				= (isset($_POST['ijazah'])) ? 1 : 0;
		$sk_konversi 			= (isset($_POST['sk_konversi'])) ? 1 : 0;
		$surat_kehilangan 		= (isset($_POST['surat_kehilangan'])) ? 1 : 0;
		$uid					= $_SESSION['uid'];
		$tgl_input 				= date("Y-m-d");

		//$data_sebelum		= $_POST['data_sebelum'];
		//$data_sesudah		= $_POST['data_sesudah'];
		//$keterangan			= $_POST['keterangan'];
		//$uid				= $_POST['uid'];
		//$tgl_input			= $_POST['tgl_input'];
									//INSERT INTO konversi(id_pengantar, nip, jenis_ralat, sk_cpns, sk_terakhir, ijazah, sk_konversi, uid) VALUES (5,1234,1,1,1,1,1,2)
		$sql = $connect->prepare("INSERT INTO konversi(id_pengantar, nip, jenis_ralat, sk_cpns, sk_terakhir, ijazah, sk_konversi, surat_kehilangan, uid, tgl_input) VALUES (?,?,?,?,?,?,?,?,?,?)");
		$sql->bind_param('iissssssis', $id_pengantar, $nip, $jenis_ralat, $sk_cpns, $sk_terakhir, $ijazah, $sk_konversi, $surat_kehilangan, $uid, $tgl_input);
		$sql->execute();
		$sql->close();
		print"<script>alert(\" Berhasil \");window.history.go(-1);</script>";
	}catch(Exception $e){
		echo $e->getMessage();
	}
}
?>