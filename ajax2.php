<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
?>

<?php
	$sql = $connect->query("SELECT * FROM konversi WHERE id_konversi=".$_GET['id_konversi']);
	$row = $sql->fetch_assoc();

	$sql2 = $connect->query("SELECT nama FROM pns WHERE nip=".$row['nip']);
	$row2 = $sql2->fetch_assoc();
?>

<html>
<head>
	<title>Update Konversi | SK Konversi NIP</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="favicon.ico">
</head>
	<form action="proses_update_konversi.php" method="post"> 
	<?php require 'head.php'; ?>
	<div class="container mar">
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-header">
						<div class="card-title">
							<h2>Update Konversi</h2>
						</div>
					</div>
					<div class="card-block container">
						<table class="table-sm">
							<tr>
								<th>NIP</th>
								<td><input type="text" class="form-control form-control-sm col-md-5" onkeyup="isi_otomatis()" name="nip" id="nip" required autofocus placeholder="NIP" value="<?php echo $row['nip'] ?>" maxlength="18" ></td>
							</tr>
							<tr>
								<th>Nama</th>
								<td><input type="text" name="nama" id="nama" class="form-control form-control-sm col-md-7" required autofocus placeholder="Refresh Halaman Jika Nama tidak muncul otomatis" value="<?php echo $row2['nama'] ?>" ></td>
							</tr>
							<tr style="border-top: solid 1px #ddd">
								<th>Ralat SK</th>
								<td><?php
								if ($row['jenis_ralat'] == 1) {
									$check1 = "checked";
								} else {
									$check1 = "";
								}
								if ($row['jenis_ralat'] == 2) {
									$check2 = "checked";
								} else {
									$check2 = "";
								}
								if ($row['jenis_ralat'] == 3) {
									$check3 = "checked";
								} else {
									$check3 = "";
								}
								if ($row['jenis_ralat'] == 4) {
									$check4 = "checked";
								} else {
									$check4 = "";
								}
								if ($row['jenis_ralat'] == 5) {
									$check5 = "checked";
								} else {
									$check5 = "";
								}
									?>
									<div class="custom-control custom-radio">
										<input class="custom-control-input" type="radio" name="jenis_ralat" value="1" id="option1" <?php echo $check1 ?>>
										<label class="custom-control-label" for="option1">Ralat nama(syarat 1,2,3,4)</label><br>
									</div>
									<div class="custom-control custom-radio">
										<input class="custom-control-input" type="radio" name="jenis_ralat" value="2" id="option2" <?php echo $check2 ?>>
										<label class="custom-control-label" for="option2">TMT CPNS(syarat 1,2,4)</label><br>
									</div>
									<div class="custom-control custom-radio">
										<input class="custom-control-input" type="radio" name="jenis_ralat" value="3" id="option3" <?php echo $check3 ?>>
										<label class="custom-control-label" for="option3">Ralat jenis Kelamin(syarat 1,2,3,4)</label><br>
									</div>
									<div class="custom-control custom-radio">
										<input class="custom-control-input" type="radio" name="jenis_ralat" value="4" id="option4" <?php echo $check4 ?>>
										<label class="custom-control-label" for="option4">Ralat Tanggal lahir(syarat 1,2,3,4)</label><br>
									</div>
									<div class="custom-control custom-radio">
										<input class="custom-control-input" type="radio" name="jenis_ralat" value="5" id="option5" <?php echo $check5 ?>>
										<label class="custom-control-label" for="option5">Cetak ulang / kehilangan konversi nip(syarat 1,2,3,5)</label><br>
									</div>
								</td>
							</tr>
							<tr style="border-top: solid 1px #ddd">
								<th>Kelengkapan</th>
								<td><?php
								if ($row['sk_cpns'] == 1) {
									$kel1 = "checked";
								} else {
									$kel1 = "";
								}
								if ($row['sk_terakhir'] == 1) {
									$kel2 = "checked";
								} else {
									$kel2 = "";
								}
								if ($row['ijazah'] == 1) {
									$kel3 = "checked";
								} else {
									$kel3 = "";
								}
								if ($row['sk_konversi'] == 1) {
									$kel4 = "checked";
								} else {
									$kel4 = "";
								}
								if ($row['surat_kehilangan'] == 1) {
									$kel5 = "checked";
								} else {
									$kel5 = "";
								}
									?>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" name="sk_cpns" value="1" id="Check21" <?php echo $kel1 ?>>
										<label class="custom-control-label" for="Check21">Copy sah sk cpns</label><br>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" name="sk_terakhir" value="1" id="Check22" <?php echo $kel2 ?>>
										<label class="custom-control-label" for="Check22">Copy sah sk terakhir</label><br>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" name="ijazah" value="1" id="Check23" <?php echo $kel3 ?>>
										<label class="custom-control-label" for="Check23">Copy sah ijazah saat pengangkatan</label><br>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" name="sk_konversi" value="1" id="Check24" <?php echo $kel4 ?>>
										<label class="custom-control-label" for="Check24">Sk konversi nip asli</label><br>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" name="surat_kehilangan" value="1" id="Check25" <?php echo $kel5 ?>>
										<label class="custom-control-label" for="Check25">Surat kehilangan asli dari kepolisian</label><br>
									</div>
								</td>
							</tr>
							<tr style="border-top: solid 1px #ddd">
								<th>Keterangan</th>
								<td><?php
								if ($row['bahan_tidak_lengkap'] == 1) {
									$ket1 = "checked";
								} else {
									$ket1 = "";
								}
								if ($row['ralat_sapk'] == 1) {
									$ket2 = "checked";
								} else {
									$ket2 = "";
								}
								if ($row['ralat_belum_cetak'] == 1) {
									$ket3 = "checked";
								} else {
									$ket3 = "";
								}
								if ($row['cetak'] == 1) {
									$ket4 = "checked";
								} else {
									$ket4 = "";
								}
								if ($row['ambil'] == 1) {
									$ket5 = "checked";
								} else {
									$ket5 = "";
								}
									?>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" name="bahan_tidak_lengkap" type="checkbox" value="1" id="Check31" <?php echo $ket1 ?>>
										<label class="custom-control-label" for="Check31">Bahan tidak lengkap</label>
										<input type="text" class="col-md-7 form-control form-control-sm" name="keterangan" value="<?php echo $row['keterangan']; ?>"><br>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" name="ralat_sapk" type="checkbox" value="1" id="Check32" <?php echo $ket2 ?>>
										<label class="custom-control-label" for="Check32">Ralat SAPK</label><br>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" name="ralat_belum_cetak" type="checkbox" value="1" id="Check33" <?php echo $ket3 ?>>
										<label class="custom-control-label" for="Check33">Ralat belum cetak</label><br>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" name="cetak" type="checkbox" value="1" id="Check34" <?php echo $ket4 ?>>
										<label class="custom-control-label" for="Check34">Cetak</label><br>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" name="ambil" type="checkbox" value="1" id="Check35" <?php echo $ket5 ?>>
										<label class="custom-control-label" for="Check35">Ambil</label><br>
									</div>
								</td>
							</tr>
						</table>
					</div>
						<div class="card-footer">
							<div class="btn-group btn-group-sm">
								<a href="welcome.php" class="btn btn-warning"><i class="fa fa-arrow-left"></i>Return</a>
								<input type="submit" name="submit" value="Update" class=" btn btn-success">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	</div>
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
<script>
$(document).ready(function(){
    $('#rad').click(function() {
   		if($('#rad').is(':checked')) { $("#check").prop( "disabled", true ); }
    });
});
</script>
</form>
</body>
</html>