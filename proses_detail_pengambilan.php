<?php
include 'koneksi.php';
session_start();
if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
/*var_dump($_POST);*/
try {
	$sql=$connect->prepare("INSERT INTO detil_pengambilan(id_pengambilan, id_konversi) VALUES (?,?)");
	$sql->bind_param('ii', $_POST['id_pengambilan'], $_POST['id_konversi']);
	$sql->execute();
	print"<script>alert(\" Berhasil Update \");history.back(-2);</script>";
	}catch(Exception $e){
		echo $e->getMessage();
	}
?>