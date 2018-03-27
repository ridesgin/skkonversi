<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
		header("location:warn.php");
}
$id_proses = $_GET['id_proses'];
$result = $connect->query("DELETE FROM proses_konversi WHERE id_proses=$id_proses");
		print"
	<script>
		alert(\" Berhasil \");
		history.back(-1);
	</script>";
?>