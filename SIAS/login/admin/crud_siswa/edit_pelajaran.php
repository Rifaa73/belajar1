<?php  
session_start();
if($_SESSION['status']!="login"){
	header("location:form_login.php?pesan=belum_login");
}
include 'conn.php';

	$id = $_GET['id'];
	$data = mysqli_fetch_array(mysqli_query($conn,"SELECT * from daftar_pelajaran where id='$id'"));
	$data_pelajaran= $data['pelajaran'];

if (isset($_POST['simpan'])) {


// menangkap data yang di kirim dari form
$id = $_POST['id'];
$pelajaran = $_POST['pelajaran'];


// update data ke database
mysqli_query($conn,"UPDATE daftar_pelajaran set pelajaran='$pelajaran' where id='$id'");

mysqli_query($conn,"ALTER TABLE `siswa` CHANGE `$data_pelajaran` `$pelajaran` INT NULL DEFAULT NULL");

// mengalihkan halaman kembali ke index.php
header("location:../atur_pelajaran.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>edit data pelajaran</title>
<link rel="stylesheet" href="../../../css/bootstrap.min.css" >
</head>
<body>
<div class="container">

	<br/>
	<a href="../atur_pelajaran.php" class="btn btn-secondary">KEMBALI</a>
	<br/>
	<br/>
	<h3 align="center">EDIT DATA PELAJARAN</h3>

	<?php
	include 'conn.php';
	$id = $_GET['id'];
	$data = mysqli_query($conn,"SELECT * from daftar_pelajaran where id='$id'");
	while($d = mysqli_fetch_array($data)){
		?>
<form action="" method="post">
	<input type="hidden" name="id" value="<?php echo $d['id']; ?>">
	<div class="form-group">
		<label for="nama">pelajaran :</label>
    	<input type="text" class="form-control" id="nama" autocomplete="off" name="pelajaran" value="<?php echo $d['pelajaran']; ?>">
  	</div>

  	<button type="submit" class="btn btn-primary" name="simpan">simpan</button>
</form>
		<?php 
	}
	?>
</div>
</body>
</html>