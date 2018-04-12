<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
		header("location:warn.php");
}
$id_pengambilan = $_GET['id_pengambilan'];
$result = $connect->query("DELETE FROM pengambilan WHERE id_pengambilan=$id_pengambilan");
		print"
	<script>
		alert(\" Berhasil \");
		history.back(-1);
	</script>";
?>