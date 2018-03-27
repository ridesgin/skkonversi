<?php
	include 'koneksi.php';
	session_start();
	if($_SESSION['status'] !="login"){
	header("location:warn.php");
}
?>

<?php
	$sql = $connect->query("SELECT *,pns.nip FROM konversi INNER JOIN pns ON konversi.nip = pns.nip WHERE id_konversi=".$_GET['id_konversi']);
	$row = $sql->fetch_assoc();

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
	<form action="proses_update_konversi.php" method="post" class="needs-validation" novalidate> 
	<?php require 'head.php'; ?>
	<div class="container mar col-8">
		<center>
			<h1 class="display-4 text-warning">Update Data Konversi</h1>
		</center>
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-block container">
						<div class="row">
							<div class="col">
								<input type="text" name="id_konversi" class="form-control" hidden value="<?php echo $_GET['id_konversi'] ?>">
							</div>
						</div>
						<div class="row">
							<div class="col">
								<label>NIP</label>
								<input type="text" min="0" step="1" class="form-control form-control-sm col-md-5" onkeyup="isi_otomatis()" name="nip" id="nip" placeholder="NIP" value="<?php echo $row['nip'] ?>" pattern="^[0-9]{18,18}$" required title="Minimal 18 karakter" maxlength="18" >
							</div>
							<div class="col">
								<label>Nama</label>
								<input type="text" name="nama" id="nama" class="form-control form-control-sm col-md-7" required placeholder="Refresh Halaman Jika Nama tidak muncul otomatis" value="<?php echo $row['nama'] ?>" >
							</div>
						</div>
						<div class="garish"></div>
						<div class="row">
							<div class="col">
								<label>Ralat SK</label>
								<?php
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
							</div>
							<div class="garisv"></div>
							<div class="col">
								<label>Kelengkapan</label>
								<?php
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
							</div>
						</div>
						<div class="garish"></div>
						<div class="row">
							<div class="col">
								<label>Data Sebelum</label>
							</div>
							<div class="col">
								<input type="text" class="form-control form-control-sm" name="data_sebelum" value="<?php echo $row['data_sebelum'] ?>">
							</div>
						</div>
						<div class="row mt-2">
							<div class="col">
								<label>Data Sesudah</label>
							</div>
							<div class="col">
								<input type="text" class="form-control form-control-sm" name="data_sesudah" value="<?php echo $row['data_sesudah'] ?>">
							</div>
						</div>
						<div class="garish"></div>
						<div class="row mb-2">
							<div class="col-2">
								<label for="keterangan">Keterangan</label>
							</div>
							<div class="col">
								<textarea class="form-control form-control-sm" name="keterangan"><?php echo $row['keterangan'] ?></textarea>
							</div>
						</div>
						<!-- <div class="garish"></div>
						<div class="row">
							<div class="col-3">
								<label>Keterangan proses</label>
							</div>
							<div class="col">
								<?php
								$pisah=explode(":", $row['keterangan']);
								if (empty($pisah[1])){
									$pisah[1] = "";
								}
								if ($row['keterangan'] == 1) {
									$ket1 = "checked";
								} else {
									$ket1 = "";
								}
								if ($row['keterangan'] == 2) {
									$ket2 = "checked";
								} else {
									$ket2 = "";
								}
								if ($row['keterangan'] == 3) {
									$ket3 = "checked";
								} else {
									$ket3 = "";
								}
								if ($row['keterangan'] == 4) {
									$ket4 = "checked";
								} else {
									$ket4 = "";
								}
									?>
									<div class="custom-control custom-radio">
										<input class="custom-control-input" name="keterangan" type="radio" value="1" id="o31" <?php echo $ket1 ?>>
										<label class="custom-control-label" for="o31">Bahan tidak lengkap</label>
										<input type="text" class="col-md-7 form-control form-control-sm" id="ket2" name="keterangan2" value="<?php echo $pisah[1]; ?>"><br>
									</div>
									<div class="custom-control custom-radio">
										<input class="custom-control-input" name="keterangan" type="radio" value="2" id="o32" <?php echo $ket2 ?>>
										<label class="custom-control-label" for="o32">Ralat SAPK</label><br>
									</div>
									<div class="custom-control custom-radio">
										<input class="custom-control-input" name="keterangan" type="radio" value="3" id="o33" <?php echo $ket3 ?>>
										<label class="custom-control-label" for="o33">Ralat belum cetak</label><br>
									</div>
									<div class="custom-control custom-radio">
										<input class="custom-control-input" name="keterangan" type="radio" value="4" id="o34" <?php echo $ket4 ?>>
										<label class="custom-control-label" for="o34">Cetak</label><br>
									</div>
								</div>
							</div> -->
						</div>
						<div class="card-footer">
							<div class="btn-group btn-group-sm">
								<a onclick="window.history.go(-1)" class="btn btn-warning"><i class="fa fa-arrow-left"></i>Kembali</a>
								<input type="submit" name="submit" value="Update" class=" btn btn-success">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	</div>
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

		$('#o31').click(function() {
			if($('#o31').is(':checked')) { $("#ket2").focus(); }
		});
		$('#o32').click(function() {
			if($('#o32').is(':checked')) { $("#ket2").val(""); }
		});
		$('#o33').click(function() {
			if($('#o33').is(':checked')) { $("#ket2").val(""); }
		});
		$('#o34').click(function() {
			if($('#o34').is(':checked')) { $("#ket2").val(""); }
		});
	});
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