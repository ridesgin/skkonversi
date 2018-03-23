<?php
include 'koneksi.php';
session_start();
if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
try{
	/*var_dump($_POST);*/

	$uid = $_SESSION['uid'];
	$uid1 = $_POST['uid1'];
	$user = $connect->query("SELECT * FROM pengguna WHERE nama_lengkap = '$uid1' ");
	$row = $user->fetch_assoc();
	echo $uid;
	echo $row['uid'];

	$sql = $connect->prepare("INSERT INTO proses_konversi(tgl_proses, jenis_proses, keterangan, id_konversi, uid, uid1) VALUES (?,?,?,?,?,?)");
	$sql->bind_param('sssiii', $_POST['tgl_proses'], $_POST['jenis_proses'], $_POST['keterangan'], $_POST['id_konversi'], $uid, $row['uid']);
	$sql->execute();
	$sql->close();
	print"<script>alert(\" Berhasil \");window.history.go(-1);</script>";
}catch(Exception $e){
	echo $e->getMessage();
}
?>