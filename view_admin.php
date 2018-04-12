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
	<link rel="icon" href="favicon.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/datepicker.min.css" rel="stylesheet" type="text/css">
	<link href="css/select2.min.css" rel="stylesheet" type="text/css">
</head>
	<?php require 'head.php'; ?>
	<div class="container-fluid mar col-8">
		<center class="display-4 text-center">Admin</center>
		<div class="card">
			<div class="card-header">
				<center><a href="input_admin.php" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Admin</a></center>
			</div>
			<div class="card-block">
				<div class="table-responsive">
					<table style="width: 100%" class="table-sm table-hover">
						<tr class="bg-dark text-white" style="height: 40px;">
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
							if ($row['aktif'] == 1) {
							    $att = "";
							} else {
							    $att = "table-danger";
							}	
						?>
						<tr class="<?php echo $att ?>">
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
									echo "<a href='update_admin.php?uid=" . $row['uid']."'class='btn btn-primary'><i class='fa fa-pencil'></i></a>";	
									echo "<a href='delete_admin.php?uid=" . $row['uid']."'onClick='return tanya()' class='btn btn-danger'><i class='fa fa-trash'></i></a>";				
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
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/datepicker.js"></script>
<script src="js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="js/select2.min.js" type="text/javascript"></script>
	<script language="javascript">
	function tanya() {
	if (confirm("Apakah anda ingin hapus data ini ?")){
		return true;
	} else {
		return false;
	}
	}
	</script>
</body>
</html>