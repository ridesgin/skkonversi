<?php
include 'koneksi.php';
session_start();
if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
?>

<html>
<head>
	<title>Input Data Surat Tamu | SK konversi NIP</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="favicon.ico">
</head>
	<form method="post" action="input_surat_pengantar.php">
	<?php require 'head.php'; ?>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="card trans">
						<div class="card-header">
							<div class="card-title">
								<h2>Input Data surat Tamu</h2>
							</div>
						</div>
					  	<div class="card-block container">
							<table width="100%" class="table-sm">
								<tr>
									<td width="40%"><label>Kode Tamu</label></td>
									<th style="padding: 5px 0;"><input type="text" class="form-control form-control-sm col-md-5" name="kode_tamu" required autofocus placeholder="Kode Tamu"></th>
								</tr>
								<tr>
									<td><label>NIP</label></td>
									<td style="padding: 5px 0;"><input type="text" class="form-control form-control-sm col-md-5" onkeyup="isi_otomatis()" name="nip" id="nip" autofocus placeholder="NIP"></td>
								</tr>
								<tr>
									<td><label>Nama Tamu</label></td>
									<td style="padding: 5px 0;"><input type="text" name="nama" id="nama" class="form-control form-control-sm col-md-7" required autofocus placeholder="Nama Tamu"></td>
								</tr>
								<tr>
									<td><label>Instansi</label></td>
									<td style="padding: 5px 0;">
										<?php $hasil = mysqli_query($connect, "SELECT id_instansi,  nama_instansi FROM instansi"); ?>

										<input type='text' list='KodeInstansi' name='id_instansi' class="form-control form-control-sm col-6" required autofocus placeholder="Instansi">
										<datalist id='KodeInstansi'>

										<?php while($row = mysqli_fetch_assoc($hasil)){ ?>

											<option value="<?php echo $row['id_instansi']; ?>"> <?php echo $row['nama_instansi'];?></option> 

										<?php } ?>
										</datalist>
									</td>
								</tr>
								<tr>
									<td><label>Alamat</label></td>
									<td style="padding: 5px 0;"><input type="text" name="alamat" class="form-control form-control-sm col-md-8" required autofocus placeholder="Alamat"></td>
								</tr>
								<tr>
									<td><label>Jumlah usulan ralat SK konversi nip:</label></td>
									<td style="padding: 5px 0;"><input type="number" name="jml_usulan" class="col-md-2 form-control-sm form-control" required autofocus placeholder="Jumlah Usulan"></td>
								</tr>
							</table>
						</div>
						<div class="card-footer">
								<input type="submit" href="proses_surat_tamu.php" name="submit" class="btn btn-primary" value="Input Surat Pengantar">
								<a href="input_konversi.php" class="btn btn-primary">Input Konversi</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
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