<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
?>
<html>
<head>
	<title>Input Konversi | SK Konversi NIP</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="favicon.ico">
</head>
<body style="background-color: #2F2545;">
	<center style="margin-top: 15rem;">
		<i class="fa fa-spinner fa-spin" style="font-size: 20rem; color: white;"></i>
	</center>
<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>
<?php
$res = mysqli_query($connect, "SELECT * FROM pengguna");
$hasil = mysqli_num_rows($res);
if(isset($_POST['submit']))
{
	try{
		$uid			= $hasil + 1;
		$nama_lengkap	= $_POST['nama_lengkap'];
		$pass 			= mysqli_real_escape_string($connect, $_POST['pass']);
		$nip 			= $_POST['nip'];
		$aktif 			= 1;
		
		$sql = $connect->prepare("INSERT INTO pengguna (uid, nama_lengkap, pass, nip, aktif) VALUES (?,?,?,?,?)");
		$sql->bind_param('issis', $uid, $nama_lengkap, $pass, $nip, $aktif);
		$sql->execute();
		$sql->close();
		print "<script>alert('successfully registered ')
		window.location = 'view_admin.php';
		</script>";
	}catch(Exception $e){
		echo $e->getMessage();
	}
}
?>