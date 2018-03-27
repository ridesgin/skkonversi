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

$sql = $connect->query("SELECT *, pns.nama FROM konversi INNER JOIN pns ON pns.nip = konversi.nip WHERE id_pengantar = ".$_GET['id_pengantar']);
/*$sql5 = $connect->query("SELECT pns.nama FROM konversi INNER JOIN pns ON pns.nip = " .$row['nip']);*/


/* SELECT konversi.nip, pns.nama
    -> FROM konversi
    -> INNER JOIN pns ON konversi.nip = pns.nip;*/


$data = mysqli_num_rows($sql);
//jika data melebihi jumlah usulan ralat
if ($limit <= $data){
	$atr = "disabled";
	$show = "";
	$atr2 = "badge-success";
} else {
	$atr = "";
	$show = "hidden";
	$bdg1 = "badge-primary";
	$bdg2 = "badge-danger";
}

//-----------------------//

if (isset($ambil['kode_tamu'])) {
	$kode_tamu =  $ambil['kode_tamu'];
	$vali2 = "is-valid";
} else {
	$kode_tamu = "Data salah";
	$vali2 = "is-invalid";
}
//-----------------------//
if (isset($ambil['no_surat'])) {
	$no_surat =  $ambil['no_surat'];
	$vali1 = "is-valid";
} else {
	$no_surat = "Data salah";
	$vali1 = "is-invalid";
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
	<link href="css/datepicker.min.css" rel="stylesheet" type="text/css">
	<link href="css/select2.min.css" rel="stylesheet" type="text/css">
	<style type="text/css">
		.garisv{
			border-left: 1px solid rgba(0, 0, 0, 0.1);
   			height: 18%;
		}
		.garish{
			margin: 0.5rem 0;
			border: 0;
  			border-top: 1px solid rgba(0, 0, 0, 0.1);
		}
	</style>
</head>

<form action="proses_konversi.php" method="post" class="needs-validation" novalidate>
	<?php require 'head.php'; ?>
	<div class="container mar col-8">
		<div class="row">
			<div class="col">
				<h1 class="display-4 mb-2 text-center">Input Konversi</h1>
				<button type="button" class="btn btn-light btn-sm align-content-lg-center" data-toggle="collapse" data-target="#demo1" style="z-index:20 ; position: absolute; top: 3.1rem; right: 15px;"><i class="fa fa-window-restore"></i></button>
				<div class="collapse show" id="demo1">
					<div class="card">
						<div class="card-block container">
							<div class="row">
								<div class="col" hidden>
									<label>ID pengantar</label>
									<input type="text" class="form-control form-control-sm col-4" name="id_pengantar" value="<?php if (isset($_GET['id_pengantar'])) {echo $_GET['id_pengantar'];} else {echo "Data salah";} ?>" readonly>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<label>No Surat Pengantar</label>
									<input type="text" class="form-control form-control-sm <?php echo $vali1 ?>" name="no_surat" value="<?php echo $no_surat ?>" readonly>
								</div>
								<div class="col">
									<label>Kode Tamu</label>
									<input type="text" class="form-control form-control-sm <?php echo $vali2; ?>" name="kode_tamu" value="<?php echo $kode_tamu ?>" readonly>
								</div>
							</div>
							<div class="garish"></div>
							<div class="row">
								<div class="col">
									<label>NIP</label>
									<input type="text" maxlength="18" pattern="^[0-9]{18,18}$" class="form-control form-control-sm col-md-6" onkeyup="isi_otomatis()" name="nip" id="nip" autofocus placeholder="NIP" required>
								</div>
								<div class="col">
									<label>Nama</label>
									<input type="text" name="nama" id="nama" class="form-control form-control-sm " required autofocus placeholder="Nama akan muncul otomatis jika NIP benar">
								</div>
							</div>
							<div class="garish"></div>
							<div class="row">
								<div class="col">
									<label>Ralat SK</label>
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
								</div>
								<div class="garisv"></div>
								<div class="col">
									<label>Kelengkapan</label>
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
								</div>
							</div>
							<div class="garish"></div>
							<div class="row">
								<div class="col-3">
									<label>Data Sebelum</label>
								</div>
								<div class="col">
									<input class="form-control form-control-sm" name="data_sebelum">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-3">
									<label>Data Sesudah</label>
								</div>
								<div class="col">
									<input class="form-control form-control-sm" name="data_sesudah">
								</div>
							</div>
							<div class="garish"></div>
							<div class="row mb-2">
								<div class="col-2">
									<label for="keterangan">Keterangan</label>
								</div>
								<div class="col">
									<textarea class="form-control form-control-sm" name="keterangan"></textarea>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="btn-group btn-group-sm">
								<a onclick="window.history.go(-1); return false;" class="btn btn-warning">Kembali <i class="fa fa-reply"></i></a>
								<button type="Reset" class="btn btn-warning">Reset <i class="fa fa-times"></i></button>
								<button type="submit" name="submit" class=" btn btn-primary" <?php echo $atr ?>>Input <i class="fa fa-cogs"></i></button>
							</div>
							<button type="button" class="btn btn-primary btn-sm align-content-lg-center" data-toggle="collapse" data-target="#demo2"><i class="fa fa-table"></i> Tabel</button>
							<div class="float-right" style="font-size: 1.2em">Jumlah data konversi <div class="badge badge-pill <?php echo $atr2 . $bdg1 ?>"><?php echo $data ?></div> dari <div class="badge badge-pill <?php echo $atr2 . $bdg2 ?>"><?php echo $limit ?></div> usulan untuk No. Surat <?php echo $ambil['no_surat'] ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="alert alert-success fade show my-2" role="alert" <?php echo $show ?>>
			<center>
				<strong>Input Konversi NIP Sudah penuh</strong> <i class="fa fa-book"></i>
			</center>
		</div>
	</div>
	<div id="demo2" class="collapse show">
		<div class="card" style="margin-top: 1rem;">
			<div class="card-block">
				<div class="table-responsive">
					<table class="table-sm table-striped">
						<tr class="bg-dark text-white" style="height: 30px;">
							<th style="width: 3%" class="text-center">No</th>
							<th style="width: 5%">NIP</th>
							<th>Nama</th>
							<th>Jenis Ralat</th>
							<th>Keterangan</th>
							<th width="7%">Tanggal Input</th>
							<th width="12%" class="text-center" hidden>Aksi</th>
							<th class="text-center">Status</th>
							<th style="width: 9%" class="text-center">Proses Konversi</th>
							<th style="width: 3%" class="text-center">CRUD</th>
						</tr>
						<?php
						if (mysqli_num_rows($sql) > 0){
								foreach($sql as $row){
								/*$sql5 = $connect->query("SELECT nama FROM pns WHERE nip=".$row['nip']);
								$row5 = $sql5->fetch_assoc();*/

								/*$sql5 = $connect->query("SELECT pns.nama FROM konversi INNER JOIN pns ON pns.nip = " .$row['nip']);
								$row5 = $sql5->fetch_assoc();*/

								/* SELECT konversi.nip, pns.nama
							    -> FROM konversi
							    -> INNER JOIN pns ON konversi.nip = pns.nip;*/
							    $sql5 = $connect->query("SELECT * FROM proses_konversi WHERE id_konversi = " . $row['id_konversi']);
								$res = $sql5->fetch_assoc();

								$sql6 = $connect->query("SELECT * FROM detil_pengambilan WHERE id_konversi = " . $row['id_konversi']);
								$res2 = $sql6->fetch_assoc();

								if ($res2['id_konversi'] == $row['id_konversi']) {
									$sts = "<i class='text-success'>Ambil</i>";
								} elseif ($res['id_konversi'] == $row['id_konversi']) {
									$sts = "<b class='text-info'>Proses</b>";
								} else {
									$sts = "<strong class='text-danger'>---</strong>";
								}
						?>
						<tr>
							<td class="text-center"><?php echo $no++ ?></td>
							<td><?php echo $row['nip']?></td>
							<td>
								<?php echo $row['nama'] ?>
							</td>
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
								echo $row['keterangan'];
								?>
							</td>
							<td><?php echo $row['tgl_input']?></td>
							<td class="text-center"><?php echo $sts ?></td>
							<td align="center" hidden>
								<button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Pilih Aksi
								</button>
								<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
									<?php echo "<a href='aksi-btl.php?id_konversi=" . $row['id_konversi']."' class='dropdown-item'>Bahan Tidak Lengkap <i class='fa fa-pencil'></i></a>";?>
									<?php echo "<a href='aksi-rss.php?id_konversi=" . $row['id_konversi']."' class='dropdown-item'>Ralat SAPK saja</a>";?>
									<?php echo "<a href='aksi-rbc.php?id_konversi=" . $row['id_konversi']."' class='dropdown-item'>Ralat Belum cetak</a>";?>
									<?php echo "<a href='aksi-cetak.php?id_konversi=" . $row['id_konversi']."' class='dropdown-item'>Cetak</a>";?>
								</div>
							</td>
							<td align="center">
								<?php
								echo "<a data-toggle='tooltip' data-placement='left' title='Konversi' href='input_konversi_akhir.php?id_konversi=" .$row['id_konversi']. "' class='btn btn-primary'>Konversi <i class='fa fa-pencil'></i></a>";
								?>
							</td>
							<td align="center">
								<div class="btn-group justify-content-center">
									<?php
									echo "<a data-toggle='tooltip' data-placement='left' title='View data' href='tampil_konversi.php?id_konversi=" .$row['id_konversi']. "' class='btn btn-outline-info'><i class='fa fa-info-circle'></i></a>";
									echo "<a data-toggle='tooltip' data-placement='left' title='Edit data' href='update_konversi.php?id_konversi=" .$row['id_konversi']. "' class='btn btn-outline-primary'><i class='fa fa-pencil'></i></a>";
									echo "<a data-toggle='tooltip' data-placement='bottom' title='Hapus data' href='delete_konversi.php?id_konversi=" .$row['id_konversi']. "' onClick='return tanya()' class='btn btn-outline-danger'><i class='fa fa-trash'></i></a>";
									?>
								</div>
							</td>
						</tr>	
						<?php
						}
							$kosong = "hidden";
						} else {
							$kosong = "";
						}
						?>
					</table>
					<div class="alert alert-danger alert-dismissible fade show my-2" role="alert" <?php echo $kosong ?>>
						<center>
							<strong>Tidak ada data</strong> <i class="fa fa-ban"></i>
						</center>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/datepicker.js"></script>
<script src="js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="js/select2.min.js" type="text/javascript"></script>
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
	$(document).ready(function(){
		event.preventDefault();
		$('#option1').click(function() {
			if($('#option1').is(':checked')) { $("#Check23").prop( "disabled", false ) && $("#Check25").prop( "disabled", true ) && $("#Check24").prop( "disabled", false ) && $("#Check25").prop( "checked", false ) ; }
		});
		$('#option2').click(function() {
			if($('#option2').is(':checked')) { $("#Check23").prop( "disabled", true ) && $("#Check25").prop( "disabled", true ) && $("#Check23").prop( "checked", false ) && $("#Check25").prop( "checked", false ) ; }
		});
		$('#option3').click(function() {
			if($('#option3').is(':checked')) { $("#Check23").prop( "disabled", false ) && $("#Check25").prop( "disabled", true ) && $("#Check24").prop( "disabled", false ) && $("#Check25").prop( "checked", false ); }
		});
		$('#option4').click(function() {
			if($('#option4').is(':checked')) { $("#Check23").prop( "disabled", false ) && $("#Check25").prop( "disabled", true ) && $("#Check24").prop( "disabled", false ) && $("#Check25").prop( "checked", false ); }
		});
		$('#option5').click(function() {
			if($('#option5').is(':checked')) { $("#Check24").prop( "disabled", true ) && $("#Check25").prop( "disabled", false ) && $("#Check23").prop( "disabled", false ) && $("#Check24").prop( "checked", false ) ; }
		});
	});
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
</form>
</body>
</html>