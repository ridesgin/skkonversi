<?php
include 'koneksi.php';
session_start();
if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
?>
<html>
<head>
	<title>SK Konversi NIP</title>
	<meta charset=utf-8>
	<meta name=description content="">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="favicon.ico">
	<link rel=stylesheet href="css/coba-style.css">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/datepicker.min.css" rel="stylesheet" type="text/css">
	<link href="css/select2.min.css" rel="stylesheet" type="text/css">

</head>
	<body style="overflow: hidden;">
	<?php include 'head.php';?>
	<div class="container">
	  	<h1 class="linear-wipe display-4">SELAMAT DATANG DI APLIKASI SK KONVERSI NIP</h1>
		<img src="images/logo.png" class="logo animate" alt="logo">
		<hr class="col-md-6">
		<h2 class="lead" style="text-align: center;">Kantor Regional 1 Badan Kepagawaian Negara</h2>
		<h2 class="lead" style="text-align: center;">YOGYAKARTA</h2>
		<div class="row">
			<div class="col">
				<a href="surat_pengantar.php" class="btn btn-secondary btn-block btn-lg">Surat Pengantar</a>
			</div>
		</div>
	</div>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/datepicker.js"></script>
<script src="js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="js/select2.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery(".titleWrapper").addClass("ready");
    
jQuery(".titleWrapper h1").each(function(){
    var fullString;
    var characters = jQuery(this).text().split("");
    
    $this = jQuery(this);
    $this.empty();
    $.each(characters, function (i, el) {
        if(el == " "){el = "&nbsp;"};
    $this.append("<span>" + el + "</span");
    });
        
});
    
});
</script>
</body>
</html>