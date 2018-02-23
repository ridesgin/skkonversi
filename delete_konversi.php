<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
		header("location:warn.php");
}
$id_konversi = $_GET['id_konversi'];
$result = mysqli_query($connect, "DELETE FROM konversi WHERE id_konversi=$id_konversi");
		print"
	<script>
		alert(\" Berhasil \");
		history.back(-1);
		document.location='welcome.php';
	</script>";
?>