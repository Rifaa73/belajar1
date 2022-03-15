<?php  
session_start();
if($_SESSION['status']!="login"){
	header("location:form_login.php?pesan=belum_login");
}
if (isset($_POST['simpan'])) {

include 'conn.php';

// menangkap data yang di kirim dari form
$id = $_POST['id'];
$kelas = $_POST['kelas'];
$hari = $_POST['hari'];
$jadwal =	$_POST['jadwal1'].",".
			$_POST['jadwal2'].",".
			$_POST['jadwal3'].",".
			$_POST['jadwal4'].",".
			$_POST['jadwal5'].",".
			$_POST['jadwal6'].",".
			$_POST['jadwal7'].",".
			$_POST['jadwal8'].",".
			$_POST['jadwal9'].",".
			$_POST['jadwal10'];


// update data ke database
mysqli_query($conn,"UPDATE jadwal_pelajaran set kelas='$kelas',hari='$hari',jadwal='$jadwal'where id='$id'");

// mengalihkan halaman kembali ke index.php
header("location:../jadwal.php");
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
	<a href="../jadwal.php" class="btn btn-secondary">KEMBALI</a>
	<br/>
	<br/>
	<h3 align="center">EDIT DATA JADWAL</h3>

	<?php
	include 'conn.php';
	$id = $_GET['id'];
	$data = mysqli_query($conn,"SELECT * from jadwal_pelajaran where id='$id'");
	while($d = mysqli_fetch_array($data)){
		?>

<form action="" method="post">
	<input type="hidden" name="id" value="<?php echo $d['id']; ?>">
	<!-- form kelas -->
	<div class="form-group">
		<label for="kelas">kelas</label>
    	<input type="text" class="form-control" id="kelas" autocomplete="off" name="kelas" value="<?php echo $d['kelas']; ?>" readonly>
  	</div>
  	<!-- form hari -->
  	<div class="form-group">
    	<label for="hari">hari</label>
    	<input type="text" class="form-control" id="hari" autocomplete="off" name="hari" value="<?php echo $d['hari'];?>" readonly>
  	</div>
  	<!-- explode untuk memecah data setiap ada koma di jadwal -->
  	<?php  $s=explode(",",$d['jadwal']);?>
  	<!-- form jam pelajaran pertama -->
  	<div class="form-group">
    	<label for="1">Jadwal jam 1</label>
    	<input type="text" class="form-control" id="1" autocomplete="off" name="jadwal1" value="<?php echo $s[0]; ?>">
  	</div>
  	<!-- form jam pelajaran kedua -->
  	<div class="form-group">
    	<label for="2">Jadwal jam 2</label>
    	<input type="text" class="form-control" id="2" autocomplete="off" name="jadwal2" value="<?php echo $s[1]; ?>">
  	</div>
  	<!-- form jam pelajaran ketiga -->
  	<div class="form-group">
    	<label for="3">Jadwal jam 3</label>
    	<input type="text" class="form-control" id="3" autocomplete="off" name="jadwal3" value="<?php echo $s[2]; ?>">
  	</div>
  	<!-- form jam pelajaran keempat -->
  	<div class="form-group">
    	<label for="4">Jadwal jam 4</label>
    	<input type="text" class="form-control" id="4" autocomplete="off" name="jadwal4" value="<?php echo $s[3]; ?>">
  	</div>
  	<!-- form jam pelajaran kelima -->
  	<div class="form-group">
    	<label for="5">Jadwal jam 5</label>
    	<input type="text" class="form-control" id="5" autocomplete="off" name="jadwal5" value="<?php echo $s[4]; ?>">
  	</div>
  	<!-- form jam pelajaran keenam -->
  	<div class="form-group">
    	<label for="6">Jadwal jam 6</label>
    	<input type="text" class="form-control" id="6" autocomplete="off" name="jadwal6" value="<?php echo $s[5]; ?>">
  	</div>
  	<!-- form jam pelajaran ketujuh -->
  	<div class="form-group">
    	<label for="7">Jadwal jam 7</label>
    	<input type="text" class="form-control" id="7" autocomplete="off" name="jadwal7" value="<?php echo $s[6]; ?>">
  	</div>
  	<!-- form jam pelajaran kedelapan -->
  	<div class="form-group">
    	<label for="8">Jadwal jam 8</label>
    	<input type="text" class="form-control" id="8" autocomplete="off" name="jadwal8" value="<?php echo $s[7]; ?>">
  	</div>
  	<!-- form jam pelajaran kesembilan -->
  	<div class="form-group">
    	<label for="9">Jadwal jam 9</label>
    	<input type="text" class="form-control" id="9" autocomplete="off" name="jadwal9" value="<?php echo $s[8]; ?>">
  	</div>
  	<!-- form jam pelajaran kesepuluh -->
  	<div class="form-group">
    	<label for="10">Jadwal jam 10</label>
    	<input type="text" class="form-control" id="10" autocomplete="off" name="jadwal10" value="<?php echo $s[9]; ?>">
  	</div>
  	<!-- tombol simpan -->
  	<button type="submit" class="btn btn-primary" name="simpan">simpan</button>
</form>

<?php 
// end while
	}
?>
</div>
</body>
</html>