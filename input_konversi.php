<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
		header("location:warn.php");
}
$sql2 = $connect->prepare("SELECT * FROM pengantar WHERE id_pengantar = ".$_GET['id_pengantar']);
$sql2->execute();
$ambil = $sql2->get_result()->fetch_assoc();
$limit = $ambil['jml_usulan'];

//tampilkeun di table bawah konversi nip
$no = 1;
//$id_pengantar = $_GET['id_pengantar'];

$sql = mysqli_query($connect, "SELECT * FROM konversi where id_pengantar = ".$_GET['id_pengantar']);
$data = mysqli_num_rows($sql);
//jika data melebihi jumlah usulan ralat
if ($limit <= $data){
	$atr = "hidden";
	$show = "";
} else {
	$atr = "";
	$show = "hidden";
}
?>

<html>
<head>
	<title>Input Konversi | SK Konversi NIP</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="favicon.ico">
</head>

	<form action="proses_konversi.php" method="post">
	<?php require 'head.php'; ?>
	<div class="container mar">
		<div class="row">
			<div class="col">
				<center class="display-4 text-white" style="margin-bottom: 1rem;">Input Konversi</center>
				<button type="button" class="btn btn-light btn-sm align-content-lg-center" data-toggle="collapse" data-target="#demo1" style="z-index:20 ; position: absolute; top: 4rem; right: 15px;"><i class="fa fa-window-restore"></i></button>
				<div class="collapse show" id="demo1">
					<div class="card">
						<div class="card-block container">
							<table class="table-sm">
								<tr hidden>
									<th width="30%">ID pengantar</th>
									<td><input type="text" class="form-control form-control-sm col-4" name="id_pengantar" value="<?php if (isset($_GET['id_pengantar'])) {echo $_GET['id_pengantar'];} else {echo "Data salah";} ?>" readonly></td>
								</tr>
								<tr>
									<th width="30%">No Surat Pengantar</th>
									<td><input type="text" class="form-control form-control-sm col-4" name="no_surat" value="<?php if (isset($_GET['no_surat'])) {echo $_GET['no_surat'];} else {echo "Data salah";} ?>" readonly></td>
								</tr>
								<tr>
									<th width="30%">Kode Tamu</th>
									<td><input type="text" class="form-control form-control-sm col-4" name="kode_tamu" value="<?php if (isset($_GET['kode_tamu'])) {echo $_GET['kode_tamu'];} else {echo "Data salah";} ?>" readonly></td>
								</tr>
								<tr>
									<th>NIP</th>
									<td><input type="text" class="form-control form-control-sm col-md-5" onkeyup="isi_otomatis()" name="nip" id="nip" required autofocus placeholder="NIP"></td>
								</tr>
								<tr>

									<th>Nama</th>
									<td><input type="text" name="nama" id="nama" class="form-control form-control-sm col-md-7" required autofocus placeholder="Nama Tamu"></td>
								</tr>
								<tr style="border-top: 1px solid #ddd">
									<th>Ralat SK</th>
									<td>
										<div class="custom-control custom-radio">
											<input class="custom-control-input"  type="radio" name="jenis_ralat" value="1" id="option1" required>
											<label class="custom-control-label"  for="option1">Ralat nama(syarat 1,2,3,4)</label><br>
										</div>
										<div class="custom-control custom-radio">
											<input class="custom-control-input"  type="radio" name="jenis_ralat" value="2" id="option2">
											<label class="custom-control-label"  for="option2">TMT CPNS(syarat 1,2,4)</label><br>
										</div>
										<div class="custom-control custom-radio">
											<input class="custom-control-input"  type="radio" name="jenis_ralat" value="3" id="option3">
											<label class="custom-control-label"  for="option3">Ralat jenis Kelamin(syarat 1,2,3,4)</label><br>
										</div>
										<div class="custom-control custom-radio">
											<input class="custom-control-input"  type="radio" name="jenis_ralat" value="4" id="option4">
											<label class="custom-control-label"  for="option4">Ralat Tanggal lahir(syarat 1,2,3,4)</label><br>
										</div>
										<div class="custom-control custom-radio">
											<input class="custom-control-input"  type="radio" name="jenis_ralat" value="5" id="option5">
											<label class="custom-control-label"  for="option5">Cetak ulang / kehilangan konversi nip(syarat 1,2,3,5)</label><br>
										</div>
									</td>
								</tr>
								<tr style="border-top: solid 1px #ddd">
									<th>Kelengkapan</th>
									<td>
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" type="checkbox" name="sk_cpns" value="1" id="Check21">
											<label class="custom-control-label" for="Check21">Copy sah sk cpns</label><br>
										</div>
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" type="checkbox" name="sk_terakhir" value="1" id="Check22">
											<label class="custom-control-label" for="Check22">Copy sah sk terakhir</label><br>
										</div>
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" type="checkbox" name="ijazah" value="1" id="Check23">
											<label class="custom-control-label" for="Check23">Copy sah ijazah saat pengangkatan</label><br>
										</div>
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" type="checkbox" name="sk_konversi" value="1" id="Check24">
											<label class="custom-control-label" for="Check24">Sk konversi nip asli</label><br>
										</div>
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" type="checkbox" name="surat_kehilangan" value="1" id="Check25">
											<label class="custom-control-label" for="Check25">Surat kehilangan asli dari kepolisian</label><br>
										</div>
									</td>
								</tr>
								<tr style="border-top: solid 1px #ddd">
									<th>Keterangan</th>
									<td>
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" name="bahan_tidak_lengkap" type="checkbox" value="1" id="Check31">
											<label class="custom-control-label" for="Check31">Bahan tidak lengkap</label>
											<input type="text" class="form-control form-control-sm" name="keterangan" placeholder="Tuliskan bahan yang tidak lengkap"><br>
										</div>
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" name="ralat_sapk" type="checkbox" value="1" id="Check32">
											<label class="custom-control-label" for="Check32">Ralat SAPK</label><br>
										</div>
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" name="ralat_belum_cetak" type="checkbox" value="1" id="Check33">
											<label class="custom-control-label" for="Check33">Ralat belum cetak</label><br>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div class="card-footer">
							<div class="btn-group btn-group-sm">
								<a onclick="window.history.go(-1); return false;" class="btn btn-warning"><i class="fa fa-arrow-left"></i>Return</a>
								<input type="submit" name="submit" value="Input" class=" btn btn-primary" <?php echo $atr ?>>
							</div>
							<button type="button" class="btn btn-primary btn-sm align-content-lg-center" data-toggle="collapse" data-target="#demo2">Tabel</button>
							<strong class="float-right">Jumlah data konversi <?php echo $data ?> untuk No. Surat <?php echo $_GET['no_surat'] ?></strong>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="alert alert-info my-2" <?php echo $show ?>>
			<center>
				<strong>Konversi NIP Selesai</strong> <i class="fa fa-book"></i>
			</center>
		</div>
	</div>
  		<div id="demo2" class="collapse show">
			<div class="card" style="margin-top: 1rem;">
				<div class="card-block">
					<div class="table-responsive">
						<table class="table-sm table-striped">
							<tr class="bg-dark text-white">
								<th style="width: 4%" class="text-center">No</th>
								<th>NIP</th>
								<th>Jenis Ralat</th>
								<th>Kelengkapan</th>
								<th>Data Sebelum</th>
								<th>Data Sesudah</th>
								<th>Keterangan</th>
								<th width="7%">Tanggal Input</th>
								<th width="12%" class="text-center">Aksi</th>
							</tr>
							<?php
								foreach($sql as $row){
							?>
							<tr>
								<td class="text-center"><?php echo $no++ ?></td>
								<td><?php echo $row['nip']?></td>
								<td><?php if ($row['jenis_ralat'] == 1){
									echo "Ralat nama";
								} elseif ($row['jenis_ralat'] == 2) {
									echo "TMT CPNS";
								} elseif ($row['jenis_ralat'] == 3) {
									echo "Ralat jenis Kelamin";
								} elseif ($row['jenis_ralat'] == 4) {
									echo "Ralat Tanggal lahir";
								} else {
									echo "Cetak ulang / kehilangan konversi nip";
								}
								?>
									
								</td>
								<td>
									<?php
								if ($row['sk_cpns'] == 1){
									$sk_cpns = 'Copy Sah SK cpns';
								} elseif ($row['sk_cpns'] == 0){
									$sk_cpns = '';
								}
								if ($row['sk_terakhir'] == 1){
									$sk_terakhir = 'Copy Sah SK Terakhir';
								} elseif ($row['sk_terakhir'] == 0){
									$sk_terakhir = '';
								}
								if ($row['ijazah'] == 1){
									$ijazah = 'Copy sah ijazah saat pengangkatan';
								} elseif ($row['ijazah'] == 0){
									$ijazah = '';
								}
								if ($row['sk_konversi'] == 1){
									$sk_konversi = 'Sk konversi nip asli';
								} elseif ($row['sk_konversi'] == 0) {
									$sk_konversi = '';
								}
								if ($row['surat_kehilangan'] == 1){
									$surat_kehilangan = 'Surat kehilangan asli dari kepolisian';
								} elseif ($row['surat_kehilangan'] == 0) {
									$surat_kehilangan = '';
								};
									$arr = array($sk_cpns, $sk_terakhir, $ijazah, $sk_konversi, $surat_kehilangan);
									echo implode(", ",$arr);
								?>
								</td>

								<td><?php if ($row['data_sebelum'] == NULL){
									echo "-";
								} else {
									echo $row['data_sebelum'];
								}
								?></td>
								<td><?php if ($row['data_sesudah'] == NULL){
									echo "-";
								} else {
									echo $row['data_sebelum'];
								}
								?></td>
								<td>
									<?php if ($row['bahan_tidak_lengkap'] == 1){
										echo "Bahan tidak Lengkap : ";
									} else {
										echo "";
									};
										echo $row['keterangan'];

										if ($row['ralat_sapk'] == 1){
										echo "Ralat SAPK";
									} else {
										echo "";
									};

										if ($row['ralat_belum_cetak'] == 1){
										echo "Ralat Belum Cetak";
									} else {
										echo "";
									};

										if ($row['cetak'] == 1){
										echo "Cetak : ";
									} else {
										echo "";
									};

										if ($row['ambil'] == 1){
										echo "Ambil";
									} else {
										echo "";
									};
									?>
								</td>
								<td><?php echo $row['tgl_input']?></td>
								<td align="center">
									<a onclick="window.print();return false;" class="btn btn-sm btn-dark text-white">Cetak</a>
									<div class="btn-group justify-content-center">
										<?php
										echo "<a href='#' class='btn btn-outline-info'><i class='fa fa-info-circle'></i></a>";
										echo "<a href='update_konversi.php?id_konversi=" .$row['id_konversi']. "' class='btn btn-outline-primary'><i class='fa fa-pencil'></i></a>";
										echo "<a href='delete_konversi.php?id_konversi=" .$row['id_konversi']. "' onClick='return tanya()' class='btn btn-outline-danger'><i class='fa fa-trash'></i></a>";									
										?>
									</div>
								</td>
							</tr>	
							<?php
								}
							?>
						</table>
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
<script>
$(document).ready(function(){
    $('#option1').click(function() {
   		if($('#option1').is(':checked')) { $("#Check25").prop( "disabled", true ); }
    });
    $('#option2').click(function() {
   		if($('#option2').is(':checked')) { $("#Check23").prop( "disabled", true ); }
	});
});
</script>
</form>
</body>
</html>