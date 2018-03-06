<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
<?php
include 'koneksi.php';
$nama_lengkap	= $_POST['nama_lengkap'];
$pass			= mysqli_real_escape_string($connect, $_POST['pass']);
//$nama_lengkap = mysqli_real_escape_string($nama_lengkap);
//$pass         = mysqli_real_escape_string($pass);
$login    	= mysqli_query($connect, "SELECT * FROM pengguna where nama_lengkap='$nama_lengkap' and pass='$pass'");
$row		= mysqli_fetch_array($login);
if($row['nama_lengkap'] == $nama_lengkap AND $row['pass'] == $pass AND $row['aktif'] == 1){
		session_start();
		$_SESSION['nama_lengkap']	= $row['nama_lengkap'];
		$_SESSION['status']			= "login";
		$_SESSION['uid']			= $row['uid'];
		$_SESSION['aktif']			= $row['aktif'];
		print"
	<script>
	alert(\" Berhasil \");
		document.location='welcome.php';
	</script>";
	header("location:welcome.php");
} elseif ($row['nama_lengkap'] == $nama_lengkap AND $row['pass'] == $pass AND $row['aktif'] == 0) {
	print"
	<script>
	alert(\" Status Pengguna Tidak Aktif \");
	history.back(-1);
	</script>";
} else {
	print"
	<script>
	alert(\" Periksa Username atau Password Anda \");
	history.back(-1);
	</script>";
}
?>

