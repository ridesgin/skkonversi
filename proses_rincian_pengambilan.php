<?php
include 'koneksi.php';
session_start();
if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
/*var_dump($_POST);*/
$nama = $_POST['nama'];
$sql = $connect->query("SELECT * FROM pengguna WHERE nama_lengkap = '$nama'");
$result = $sql->fetch_assoc();
/*echo $result['uid'];*/
$stmt = $connect->prepare("INSERT INTO pengambilan (tanggal_pengambilan, keterangan, nip, uid) VALUES (?,?,?,?)");
$stmt->bind_param('ssii', $_POST['tanggal_pengambilan'], $_POST['keterangan'], $_POST['nip'], $result['uid']);
$stmt->execute();
$stmt->close();
$connect->close();
print"<script>alert(\" Berhasil mengambil \");history.go(-1);</script>";
?>