<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
		header("location:warn.php");
}
$uid = $_GET['uid'];
$result = mysqli_query($connect, "DELETE FROM pengguna WHERE uid=$uid");
		print"
	<script>
		alert(\" Berhasil \");
		history.back(-1);
		document.location='welcome.php';
	</script>";
?>