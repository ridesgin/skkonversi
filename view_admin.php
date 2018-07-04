<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
		header("location:warn.php");
}
?>

<html>
<head>
	<title>Admin | SK Konversi NIP</title>
	<meta charset=utf-8>
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="favicon.ico">
</head>
	<?php require 'head.php'; ?>
	<div class="container-fluid mar col-8">
		<center class="display-4 text-white">Admin</center>
		<div class="card">
			<div class="card-header">
				<center><a href="tambah_admin.php" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Admin</a></center>
			</div>
			<div class="card-block">
				<div class="table-responsive">
					<table style="width: 100%" class="table-striped table-sm">
						<tr class="bg-dark text-white">
							<th class="text-center">No</th>
							<th>Nama</th>
							<th style="width: 25%">Password</th>
							<th>NIP</th>
							<th>Status</th>
							<th style="width: 8rem;">Aksi</th>
						</tr>
						<?php 
							$no = 1;
							$sql = mysqli_query($connect, "SELECT * FROM pengguna");
							foreach ($sql as $row) {
						?>
						<tr>
							<td class="text-center"><?php echo $no++ ?></td>
							<td><?php echo $row['nama_lengkap'] ?></td>
							<td><?php echo $row['pass'] ?></td>
							<td><?php echo $row['nip'] ?></td>
							<td><?php

							if ($row['aktif'] == 1) {
							    echo "Aktif";
							} else {
							    echo "Tidak Aktif";
							}

							?></td>
							<td align="center">
								<div class="btn-group">
									<?php
									echo "<a href='edit_admin.php?uid=" . $row['uid']."'class='btn btn-outline-primary'><i class='fa fa-pencil'></i></a>";	
									echo "<a href='delete_admin.php?uid=" . $row['uid']."'onClick='return tanya()' class='btn btn-outline-danger'><i class='fa fa-trash'></i></a>";				
									?>
								</div>
							</td>
						</tr>
						<?php } ?>
					</table>
				</div>
			</div>
			<div class="card-footer" style="height: 7%">
				<?php
				$count = mysqli_num_rows($sql); 
				echo "Jumlah Pengguna : " . $count;
				?>
			</div>
		</div>
	</div>
	<script language="javascript">
	function tanya() {
	if (confirm("Apakah anda ingin hapus data ini ?")){
		return true;
	} else {
		return false;
	}
	}
	</script>
	<script src="js/jquery-2.2.4.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>