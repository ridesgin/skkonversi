<?php
include 'koneksi.php';
$id_instansi = $_POST['id_instansi'];
echo "asli " . $id_instansi;

$hasil = $connect->query("SELECT * FROM instansi WHERE nama_instansi = '$id_instansi'");
$res = $hasil->fetch_assoc();
echo $res['id_instansi'];
?>