<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
		header("location:warn.php");
}
if (isset($_POST['submit'])){
	$uid	=	$_POST['uid'];
	$stmt	= $connect->prepare("UPDATE pengguna SET nip = ?, nama_lengkap = ?, pass = ?, aktif = ? WHERE uid = $uid");
	$stmt->bind_param("isss", $_POST['nip'], $_POST['nama_lengkap'], $_POST['pass'], $_POST['aktif']);
	$stmt->execute();
	$stmt->close();
	print "<script>alert('successfully update')
	window.location = 'view_admin.php';
	</script>";
}
?>