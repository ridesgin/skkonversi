<body id="bg" onload="startTime()">
	<nav class="navbar navbar-expand-lg fixed-top justify-content-end bg-oi navbar-light bg-light rounded">
		<div class="container-fluid">
			<a class="btn btn-raised btn-link bg-light" onclick="window.location='welcome.php'"><img src="images/head.png" style="width: 5rem;"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto justify-content-end">
					<li class="nav-item active">
						<a class="nav-link text-dark" href="welcome.php"><i class="fa fa-home"></i> Home<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-danger" href="view_admin.php"><i class="fa fa-user"></i> Admin<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-primary" href="surat_pengantar.php"><i class="fa fa-pencil"></i> Surat Pengantar<span class="sr-only">(current)</span></a>
					</li>
					<!--<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aplikasi Input Data</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="surat_pengantar.php">Surat Pengantar</a>
						<a class="dropdown-item" href="input_konversi.php"><span class="badge badge-secondary">2.</span> Konversi NIP</a>
					 </div>
					</li>-->
					<!-- <li class="mt-md-0">
						<a class="nav-link text-info" href="cek_data.php">Cek Data <i class="fa fa-search"></i></a>
					</li> -->
					<li class="mt-md-0">
						<a class="nav-link text-info" href="view_konversi.php">Laporan Konversi NIP <i class="fa fa-book"></i></a>
					</li>
					<!-- <li class="nav-item dropdown mx-2">
						<a class="nav-link dropdown-toggle text-info" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Laporan <i class="fa fa-book"></i></a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="view_pengantar.php">Laporan Surat Pengantar</a>
							<a class="dropdown-item" href="view_konversi.php">Laporan Konversi NIP</a>
						</div>
					</li> -->
					<li class="mt-md-0">
						<a class="nav-link text-success" href="view_pengambilan.php">Pengambilan <i class="fa fa-book"></i></a>
					</li>
				</ul>
				<ul class="navbar-nav">
					<li class="navbar-text"><?php
					echo "<div class='badge badge-pill badge-info mr-2 ' style='font-size:0.8em; font-style: italic;'> <i class='fa fa-user-circle-o fa-lg'></i> : <i>" . $_SESSION['nama_lengkap'] . "</i>";
					echo " <i class='fa fa-calendar fa-lg'></i> : ";
					$tgl=date('d-m-Y');
					date_default_timezone_set("Asia/Jakarta");
					echo "<i>". $tgl. "</i>";
					echo " <i class='fa fa-clock-o fa-lg'></i> : <i id='txt'></i></div>";
					?>	
					</li>
				</ul>
				<ul class="navbar-nav">
					<li class="nav-item text-nowrap">
						<a href="logout.php" class="btn btn-danger" data-toggle="modal" data-target="#sout">Keluar <i class="fa fa-sign-out"></i></a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="modal fade" id="sout" tabindex="-1" role="dialog" aria-labelledby="sout" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">Apakah Anda Ingin Logout ?</div>
				<div class="modal-footer">
					<a href="logout.php" class="btn btn-outline-danger">Ya</a>
					<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tidak</button>
				</div>
			</div>
		</div>
	</div>

<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script>
	function startTime() {
		var today = new Date();
		var h = today.getHours();
		var m = today.getMinutes();
		var s = today.getSeconds();
		m = checkTime(m);
		s = checkTime(s);
		document.getElementById('txt').innerHTML =
		h + ":" + m + ":" + s;
		var t = setTimeout(startTime, 500);
	}
	function checkTime(i) {
	if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
	return i;
}
</script>