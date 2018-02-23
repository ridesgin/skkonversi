
<html>
<head>
	<title>- MASUK -</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="favicon.ico">
</head>
<body id="bg" class="text-center cent" onclick>
	<form action="proses_login.php" method="post" class="form-signin">
		<h1 class="animate text-white" style="margin-top:5rem;">SK konversi NIP</h1>
		<i class="fa fa-user-circle-o f-fading text-white" style="font-size: 10em"></i>
		<h1 class="h3 mb-3 font-weight-normal f-opacity text-white">Masuk</h1>
		<input id="nama_lengkap" type="username" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap" required autofocus>
		<input id="pass" type="password" class="form-control" name="pass" placeholder="Password" required autofocus>
		<input type="checkbox" onclick="myFunction()" id="passw">
		<label for="passw" class="text-white"> Tampilkan Password</label>
		<input type="submit" class="btn btn-block btn-primary" value="Masuk" onclick="validate()">
	</form>

<script type="text/javascript">
function myFunction() {
	var x = document.getElementById("pass");
	if (x.type === "password") {
		x.type = "text";
	} else {
		x.type = "password";
	}
}
</script>
<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
</body>
</html>