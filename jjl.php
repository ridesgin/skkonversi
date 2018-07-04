<!DOCTYPE html>
<html>
<head>
	<title>w</title>
</head>
<body>
	<form action="jjl2.php" method="POST">
		<?php
		$connect = new mysqli ('localhost', 'root', '', 'mydb');
		$hasil = mysqli_query($connect, "SELECT id_instansi,  nama_instansi FROM instansi");
		?>
		<input type='text' list='KodeInstansi' name='id_instansi'  placeholder="Instansi" " required>
		<datalist id='KodeInstansi'>
			<?php while($row2 = mysqli_fetch_assoc($hasil)){ ?>
			<option value="<?php echo $row2['nama_instansi'];?>"> <?php echo $row2['nama_instansi'];?></option> 
			<?php } ?>
		</datalist>
		<input type="submit" value="submit">
	</form>
</body>
</html>