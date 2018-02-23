<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try{
	$connect = new mysqli("localhost", "root", "", "mydb");
	$connect->set_charset("utf8");
	//$connect = new mysqli("192.168.12.250", "conversion", "conversion17", "conversion"); //Server Test
} catch(Exception $e){
	error_log($e->getMessage());
	exit('Error saat mengkoneksi ke database');
}
?>
