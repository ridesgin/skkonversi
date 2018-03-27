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
$id_pengambilan = $_POST['id_pengambilan'];
$stmt = $connect->prepare("UPDATE pengambilan SET tanggal_pengambilan = ?, keterangan = ?, nip = ?, uid = ? WHERE id_pengambilan = $id_pengambilan");
$stmt->bind_param('ssii', $_POST['tanggal_pengambilan'], $_POST['keterangan'], $_POST['nip'], $result['uid']);
$stmt->execute();
$stmt->close();
$connect->close();
print"<script>alert(\" Berhasil mengambil \");history.go(-2);</script>";
?>