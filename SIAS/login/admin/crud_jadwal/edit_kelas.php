<?php  
session_start();
if($_SESSION['status']!="login"){
	header("location:form_login.php?pesan=belum_login");
}
include 'conn.php';

	$id = $_GET['id'];
	$data = mysqli_fetch_array(mysqli_query($conn,"select * from daftar_kelas where id='$id'"));
	$data_kelas= $data['kelas'];
$coba=mysqli_fetch_array(mysqli_query($conn,"SELECT kelas FROM jadwal_pelajaran WHERE kelas='$data_kelas'"));

if (isset($_POST['simpan'])) {

$coba2=$coba['kelas'];

// menangkap data yang di kirim dari form
$id = $_POST['id'];
$kelas = $_POST['kelas'];


// update data ke database
mysqli_query($conn,"UPDATE daftar_kelas set kelas='$kelas' where id='$id'");

mysqli_query($conn,"UPDATE jadwal_pelajaran set kelas='$kelas' where kelas='$coba2'");

// mengalihkan halaman kembali ke index.php
header("location:../atur_kelas.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>edit data jadwal</title>
	<link rel="stylesheet" href="../../../css/bootstrap.min.css" >
</head>
<body>
<div class="container">

	<br/>
	<a href="../atur_kelas.php" class="btn btn-secondary">KEMBALI</a>
	<br/>
	<br/>
	<h3 align="center">EDIT DATA KELAS</h3>

	<?php
	include 'conn.php';
	$id = $_GET['id'];
	$data = mysqli_query($conn,"select * from daftar_kelas where id='$id'");
	while($d = mysqli_fetch_array($data)){
		?>
<form action="" method="post">
	<input type="hidden" name="id" value="<?php echo $d['id']; ?>">
	<div class="form-group">
		<label for="nama">kelas :</label>
    	<input type="text" class="form-control" id="nama" autocomplete="off" name="kelas" value="<?php echo $d['kelas']; ?>">
  	</div>

  	<button type="submit" class="btn btn-primary" name="simpan">simpan</button>
</form>
		<?php 
	}
	?>

</div>
</body>
</html>