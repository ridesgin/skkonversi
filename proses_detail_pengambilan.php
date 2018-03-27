<?php
include 'koneksi.php';
session_start();
if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
var_dump($_POST);
try {
	$sql=$connect->prepare("INSERT INTO detil_pengambilan(id_pengambilan, id_konversi) VALUES (?,?)");
	$sql->bind_param('ii', $_POST['id_pengambilan'], $_POST['id_konversi']);
	
	$sql2=$connect->prepare("UPDATE konversi SET tgl_pengambilan = ? WHERE id_konversi =" . $_POST['id_konversi']);
	$sql2->bind_param('s', $_POST['tanggal_pengambilan']);
	$sql2->execute();
	$sql->execute();
	print"<script>alert(\" Berhasil Update \");history.back(-2);</script>";
	}catch(Exception $e){
		echo $e->getMessage();
	}
?>