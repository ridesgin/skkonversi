<?php
/*$sql=$connect->prepare("SELECT * FROM konversi ORDER BY id_konversi DESC");
$sql->execute();
$result = $sql->get_result();
while($ro = $result->fetch_assoc()) {
}*/

?>
<?php ob_start(); ?>
<html>
<head>
	<title>Cetak PDF</title>

	<style>
		table {border-collapse:collapse; table-layout:fixed;width: 630px;}
	</style>
</head>
<body>

	<h1 style="text-align: center;">LAPORAN PENERIMAAN BERKAS RALAT SK KONVERSI NIP</h1>
	<table border="1">
		<col width="25">
		<tr>
			<th style="20px">NO</th>
			<th>Tanggal Masuk</th>
			<th>Nomor Tamu</th>
			<th>No Surat Pengantar</th>
			<th>Instansi/Kabupaten</th>
			<th>jumlah Berkas</th>
			<th>Pemroses</th>
			<th>Keterangan</th>
		</tr>
		<?php
// Load file koneksi.php
		include "koneksi.php";
		$no = 1;

		$sql = mysqli_query($connect, "SELECT * FROM konversi");

		foreach ($sql as $row) {
			$ins = $connect->query("SELECT * FROM instansi WHERE id_instansi = 9999");
			$in = $ins->fetch_assoc();
			?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $row['tgl_input']; ?></td>
				<td><?php echo $row['id_pengantar']; ?></td>
				<td><?php echo "#"; ?></td>
				<td><?php echo $in['nama_instansi']; ?> </td>
				<td><?php echo "mbuh";?></td>
				<td><?php echo $row['uid'];?></td>
				<td><?php
					if(empty($row['keterangan'])){
						echo "<strong style='color:red'>Keterangan tidak ada</strong>";
					}
					$pisah=explode(":", $row['keterangan']);

					if ($pisah[0] == 1){
						echo "Bahan tidak Lengkap : ";
					} else {
						echo "";
					};
					if (empty($pisah[1])){
						$pisah[1] = "";
					} echo $pisah[1];
					if ($pisah[0] == 2){
						echo "Ralat SAPK";
					} else {
						echo "";
					};

					if ($pisah[0] == 3){
						echo "Ralat Belum Cetak";
					} else {
						echo "";
					};

					if ($pisah[0] == 4){
						echo "Cetak";
					} else {
						echo "";
					};
					?>	
				</td>
			</tr>
			<?php } ?>
		</table>
	</body>
	</html>
	<?php
	$html = ob_get_contents();
	ob_end_clean();

	require __DIR__.'/vendor/autoload.php';

	use Spipu\Html2Pdf\Html2Pdf;

	$pdf = new HTML2PDF('L','A4','en');
	$pdf->WriteHTML($html);
	$pdfContent = $pdf->output("my_doc.pdf", 'D');
	?>