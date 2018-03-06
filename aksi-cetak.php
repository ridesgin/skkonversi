<?php
include 'koneksi.php';
$ket = "4";
$id_konversi = $_GET['id_konversi'];
$stmt	= $connect->prepare("UPDATE konversi SET keterangan = ? WHERE id_konversi = $id_konversi");
$stmt->bind_param("s", $ket);
$stmt->execute();
$stmt->close();
print "<script>alert('successfully update')
window.history.go(-1)
</script>";
?>