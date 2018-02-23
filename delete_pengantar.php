<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
		header("location:warn.php");
}
$id_pengantar = $_GET['id_pengantar'];
$result = mysqli_query($connect, "DELETE FROM pengantar WHERE id_pengantar = $id_pengantar");
		print"
	<script>
		alert(\" Berhasil \");
		history.back(-1);
		document.location='welcome.php';
	</script>";
?>