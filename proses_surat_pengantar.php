<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
if (isset ($_POST['submit'])) {
	try{
		$kode_tamu		= $_POST['kode_tamu'];
		$no_surat 		= mysqli_real_escape_string($connect, $_POST['no_surat']);
		$tgl_surat		= $_POST['tgl_surat'];
		$id_instansi	= $_POST['id_instansi'];
		$nip_spesimen	= $_POST['nip_spesimen'];
		$jml_usulan		= $_POST['jml_usulan'];

		//$tgl_input 		= date("Y-m-d");

		$sql = $connect->prepare("INSERT INTO pengantar (kode_tamu, no_surat, tgl_surat, id_instansi, nip_spesimen, jml_usulan) VALUES (?,?,?,?,?,?)");
		$sql->bind_param('issiii', $kode_tamu, $no_surat, $tgl_surat, $id_instansi, $nip_spesimen, $jml_usulan);
		$sql->execute();
		$sql->close();
		print"
		<script>
		window.location='surat_pengantar.php';
		alert(\" Berhasil \");
		</script>";
		}catch(Exception $e){
			echo $e->getMessage();
		}
    }
?>