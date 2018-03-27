<?php
include 'koneksi.php';
session_start();
if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
$id_konversi = $_GET['id_konversi'];
$sql = $connect->query("SELECT *, pns.nama FROM konversi INNER JOIN pns ON konversi.nip = pns.nip WHERE id_konversi = $id_konversi");
$result = $sql->fetch_assoc();
//---------//
/*$sql2 = $connect->query("SELECT nama FROM pns WHERE nip=".$result['nip']);
$row2 = $sql2->fetch_assoc();*/
//----//
if ($result['jenis_ralat'] == 1){
	$jenis_ralat = "Ralat nama";
} elseif ($result['jenis_ralat'] == 2) {
	$jenis_ralat = "TMT CPNS";
} elseif ($result['jenis_ralat'] == 3) {
	$jenis_ralat = "Ralat jenis Kelamin";
} elseif ($result['jenis_ralat'] == 4) {
	$jenis_ralat = "Ralat Tanggal lahir";
} else {
	$jenis_ralat = "Cetak ulang / kehilangan konversi nip";
}
?>
<html>
<head>
	<title>Input Konversi Akhir | SK Konversi NIP</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico">
	<link rel="icon" href="favicon.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/datepicker.min.css" rel="stylesheet" type="text/css">
	<link href="css/select2.min.css" rel="stylesheet" type="text/css">
</head>
	<?php include 'head.php'; ?>
	<form action="proses_konversi_akhir.php" method="POST">
		<div class="container mar col-7">
			<h1 class="display-4 text-center mt-2">Konversi Akhir</h1>
			<div class="card">
				<div class="card-block">
					<div class="container">
						<div class="row my-2" hidden>
							<div class="col-md-3">
								<label class="form-control-label">Id konversi</label>
							</div>
							<div class="col-md-5">
								<input type="text" class="form-control form-control-sm" name="id_konversi" value="<?php echo $_GET['id_konversi'] ?>">
							</div>
						</div>
						<div class="row my-2">
							<div class="col-md-3">
								<label class="form-control-label">Nama</label>
							</div>
							<div class="col-md-5">
								<input type="text" class="form-control form-control-sm" name="nama" value="<?php echo $result['nama'] ?>" readonly>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<label class="form-control-label">NIP</label>
							</div>
							<div class="col-3">
								<input type="text" maxlength="18" pattern="^[0-9]{18,18}$" title="max 18 karakter dan berupa angka" class="form-control form-control-sm" name="nip" value="<?php echo $result['nip'] ?>" readonly>
							</div>
						</div>
						<div class="row my-2">
							<div class="col-md-3">
								<label class="form-control-label">Jenis Ralat</label>
							</div>
							<div class="col-md-3">
								<input type="text" class="form-control form-control-sm" name="jenis_proses" value="<?php echo $jenis_ralat ?>" readonly>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<label class="form-control-label">Tanggal</label>
							</div>
							<div class="col-md-3">
								<input type="text" class="form-control form-control-sm datepicker-here" data-position="right top" name="tgl_proses" required value="<?php echo date("Y-m-d") ?>">
							</div>
						</div>
						<div class="row my-2">
							<div class="col-md-3">
								<label class="form-control-label">Aksi</label>
							</div>
							<div class="col-md-4">
								<select class="form-control form-control-sm" name="jenis_proses" required>
									<option  disabled selected value>-- pilih Aksi --</option>
									<option value="0">Bahan Tidak lengkap</option>
									<option value="1">Ralat SAPK saja</option>
									<option value="2">Ralat belum cetak</option>
									<option value="3">cetak</option>
								</select>
							</div>
						</div>
						<div class="row my-2">
							<div class="col-md-3">
								<label class="form-control-label" for="keterangan">Keterangan</label>
							</div>
							<div class="col">
								<textarea class="form-control" id="keterangan" name="keterangan"></textarea>
							</div>
						</div>
						<div class="row mb-2">
							<div class="col-md-3">
								<label class="form-control-label">Petugas</label>
							</div>
							<div class="col-9">
								<?php $hasil = mysqli_query($connect, "SELECT * FROM pengguna"); ?>
								<select type='text' name='uid1' class="form-control form-control-sm col-md-6 dropoi" required>
									<option disabled selected value>-- pilih petugas --</option>
									<?php while($row = mysqli_fetch_assoc($hasil)){ ?>
									<option value="<?php echo $row['nama_lengkap'];?>"> <?php echo $row['nama_lengkap'];?></option> 
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<a onclick="window.history.go(-1); return false;" class="btn btn-warning">Kembali <i class="fa fa-reply"></i></a>
					<button type="submit" class="btn btn-primary" name="input">Submit</button>
				</div>
			</div>
		</div>
	</form>
	
	<div class="container-fluid">
		<div class="card">
			<div class="card-block">
				<div class="table-responsive">
					<table class="table-sm">
						<tr class="bg-dark text-white" style="height: 30px;">
							<td>NO</td>
							<td>Tanggal</td>
							<td>Aksi</td>
							<td>Keterangan</td>
							<td>Petugas</td>
							<td width="5%">Aksi</td>
						</tr>
						<?php
						$query = $connect->query("SELECT *,pengguna.uid, pns.nama FROM proses_konversi INNER JOIN pengguna ON pengguna.uid = proses_konversi.uid1 INNER JOIN pns ON pns.nip = pengguna.nip WHERE proses_konversi.id_konversi = $id_konversi");
						$no = 1;
						/*$query2 = $connect->query("SELECT *, pns.nama FROM pengguna INNER JOIN pns ON pengguna.nip = pengguna.nip WHERE pengguna.uid =" . $row2['uid1']);
						$res2 = $query2->fetch_assoc();*/
						foreach ($query as $row2) {

							
						?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $row2['tgl_proses'] ?></td>
							<td><?php $row2['jenis_proses'];
								if (is_null($row2['jenis_proses'])){
									echo "";
								} elseif ($row2['jenis_proses'] == 0){
									echo "Bahan tidak Lengkap : " . $res2['keterangan'];
								} elseif ($row2['jenis_proses'] == 1){
									echo "Ralat SAPK";
								} elseif ($row2['jenis_proses'] == 2){
									echo "Ralat Belum Cetak";
								} else {
									echo "Cetak";
								};
								?></td>
							<td><?php echo $row2['keterangan'] ?></td>
							<td><?php echo $row2['nama'] ?></td>
							<td>
								<?php
									echo "<a href='hapus_konversi.php?id_proses=" .$row2['id_proses']. "' onClick='return tanya()' class='btn btn-danger'>Hapus <i class='fa fa-trash'></i></a>";									
								?>
							</td>
						</tr>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/datepicker.js"></script>
<script src="js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="js/select2.min.js" type="text/javascript"></script>
	<script type="text/javascript">
	$(document).ready(function() {
    $('.dropoi').select2();
	});
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