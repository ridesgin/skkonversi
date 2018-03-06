<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
		header("location:warn.php");
}
	$sql = $connect->query("SELECT * FROM pengantar WHERE id_pengantar=".$_GET['id_pengantar']);
	$row = $sql->fetch_assoc();

?>
<html>
<head>
	<title>Input Surat Pengantar | SK Konversi NIP</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
	<form action="proses_update_surat_pengantar.php" method="post">
	<?php require 'head.php'; ?>
		<div class="container mar">
			<center class="display-4 text-warning" style="margin-bottom: 1rem">Update Surat Pengantar</center>
			<div class="card">
				<div class="card-block container">
					<table class="table-sm">
						<input type="text" name="id_pengantar" hidden class="form-control" value="<?php echo $row['id_pengantar'] ?>">
						<tr>
							<th width="35%">Kode Tamu</th>
							<th width="100%"><input type='text' name='kode_tamu' class="form-control form-control-sm col-md-4" value="<?php echo $row['kode_tamu'] ?>" placeholder="kode tamu" required></th>
						</tr>
						<tr>
							<td>Nomor Surat</td>
							<td width="100%"><input type="text" name="no_surat" class="form-control form-control-sm col-md-5" value="<?php echo $row['no_surat'] ?>" placeholder="Nomer Surat" required></td>
						</tr>
						<tr>
							<td>Tanggal Surat</td>
							<td><input type="date" name="tgl_surat" class="form-control form-control-sm col-md-3" value="<?php echo $row['tgl_surat'] ?>" placeholder="Tanggal Surat" required></td>
						</tr>
						<div class="form-inline right" style="position: absolute; top: 118px; left: 760px;">jumlah Lampiran : <input type="number" name="jumlah_lampiran" class="form-control form-control-sm col-3" required></div>
						<tr>
							<td>Instansi</td>
							<td>
								<?php $hasil = mysqli_query($connect, "SELECT id_instansi,  nama_instansi FROM instansi");
								$id_instansi = $row['id_instansi'];
								$hasil2 = $connect->query("SELECT * FROM instansi WHERE id_instansi = '$id_instansi'");
								$res = $hasil2->fetch_assoc();
								?>

								<input type='text' list='KodeInstansi' name='id_instansi'  placeholder="Instansi" class="form-control form-control-sm col-md-6" value="<?php echo $res['nama_instansi'] ?>" required>
								<datalist id='KodeInstansi'>

								<?php while($row2 = mysqli_fetch_assoc($hasil)){ ?>

									<option value="<?php echo $row2['nama_instansi']; ?>"> <?php echo $row2['nama_instansi'];?></option> 

								<?php } ?>
								</datalist>
							</td>
						</tr>
						<tr>
							<td>Jabatan Spesimen</td>
							<td><input type="text" name="jabatan_spesimen" class="form-control form-control-sm col-md-4" placeholder="Jabatan" value="<?php if(isset($row['jabatan_spesimen'])) echo $row['jabatan_spesimen']?>" required></td>
						</tr>
						<tr>
							<td>NIP Spesimen</td>
							<td><input value="<?php echo $row['nip_spesimen'] ?>" id="nip" type="text" name="nip_spesimen" class="form-control form-control-sm col-md-4" onkeyup="isi_otomatis()" placeholder="NIP" required></td>
						</tr>
						<tr>
							<td>Nama Spesimen</td>
							<td><input type="text" name="nama_spesimen" id="nama" class="form-control form-control-sm col-md-4" readonly></td>
						</tr>
						<tr>
							<td>Jumlah usulan ralat SK Konversi NIP</td>
							<td><input type="number" name="jml_usulan" class="form-control form-control-sm col-md-2" value="<?php echo $row['jml_usulan'] ?>" required></td>
						</tr>
					</table>
				</div>
				<div class="card-footer">
					<div class="btn-group btn-group-sm">
						<a onclick="window.location='surat_pengantar.php'" class="btn btn-warning">Kembali <i class="fa fa-reply"></i></a>
						<button type="submit" name="submit" class="btn btn-primary">Submit <i class="fa fa-cogs"></i></button>
					</div>
				</div>
			</div>
		</div>
	</form>
<script src="js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
	function isi_otomatis(){
		var nip = $("#nip").val();
		$.ajax({
			url: 'ajax.php',
			data:"nip="+nip ,
		}).success(function (data) {
			var json = data,
			obj = JSON.parse(json);
			$('#nama').val(obj.nama);
		});
	}
</script>
</body>
</html>