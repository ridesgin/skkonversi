<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
		header("location:warn.php");
}
$nip = $_GET['nip'];
$query = mysqli_query($connect, "select * from pns where nip='$nip'");
$pegawai = mysqli_fetch_array($query);
if (!$query) {
	printf("Error: %s\n", mysqli_error($connect));
	exit();
}
$data = array(
	'nama'	=>	$pegawai['nama'],);
 echo json_encode($data);
?>