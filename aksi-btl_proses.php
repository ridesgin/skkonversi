<?php
include 'koneksi.php';
if(isset($_POST['submit'])){
	$ket = "1:" . $_POST['keterangan'];
	$id_konversi = $_POST['id_konversi'];
	$stmt	= $connect->prepare("UPDATE konversi SET keterangan = ? WHERE id_konversi = $id_konversi");
	$stmt->bind_param("s", $ket);
	$stmt->execute();
	$stmt->close();
}	print "<script>alert('successfully update')
	window.history.go(-2)
	</script>";
?>