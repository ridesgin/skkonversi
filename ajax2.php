<?php
$connect = new mysqli('localhost', 'root', '', 'mydb');
$hasil = mysqli_query($connect, "SELECT id_instansi,  nama_instansi FROM instansi");
//<?php echo $row['id_instansi'];
?>
<form action="" method="post">
	<input type='text' list='KodeInstansi' name='id_instansi'  placeholder="Instansi" class="form-control form-control-sm col-md-6" >
	<datalist id='KodeInstansi'>

	<?php while($row = mysqli_fetch_assoc($hasil)){ ?>

		<option value="<?php echo $row['nama_instansi'];?>">asw</option> 

	<?php } ?>
	</datalist>
	<input type="submit" name="input" value="submit">
</form>

<?php
if (isset($_POST['submit'])) {
	$id_instansi	= $_POST['id_instansi'];
	echo "oi ". $id_instansi;
}
?>
