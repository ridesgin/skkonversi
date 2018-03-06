<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
		header("location:warn.php");
}
	var_dump($_POST);
	if (isset($_POST['submit'])) {
		try {
			$kode_tamu = $_POST['kode_tamu'];
			$id_instansi = 1;
			$jml_usulan = $_POST['jml_usulan'];
			//$sikil = $connect->prepare("INSERT INTO pengantar (kode_tamu, id_instansi, jml_usulan) VALUES (?,?,?)");
			//$sikil->bind_param('iii', $kode_tamu, $id_instansi, $jml_usulan);
			//$sikil->execute();
			//$sikil->close();

			/*
			$kode_tamu = $_POST['kode_tamu'];
			$sikil = "INSERT INTO pengantar (id_pengantar, kode_tamu, id_instansi) VALUES (3,$kode_tamu,1)";
			echo $sikil;
			$sql = $connect->prepare($sikil);


			$sql = $connect->prepare("INSERT INTO pengantar (id_pengantar, kode_tamu) VALUES (?, ?)");
			$kode_tamu = $_POST['kode_tamu'];
			$sql->bind_param("ii",$id_pengantar, $kode_tamu);*/

		}catch(Exception $e){
		    echo $e->getMessage();
		}
                    //header("location:");

    }
	$connect->close();
?>
