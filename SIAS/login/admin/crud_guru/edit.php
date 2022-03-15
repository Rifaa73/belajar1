<?php  
session_start();
if($_SESSION['status']!="login"){
	header("location:form_login.php?pesan=belum_login");
}
if (isset($_POST['simpan'])) {

include 'conn.php';

// menangkap data yang di kirim dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$jk = $_POST['jk'];
$jabatan = $_POST['jabatan'];
$no_hp = $_POST['no_hp'];
$password=$_POST['password'];

// update data ke database
mysqli_query($conn,"UPDATE guru set nama='$nama',jenis_kelamin='$jk',jabatan='$jabatan',no_hp='$no_hp',password='$password' where id='$id'");

// mengalihkan halaman kembali ke index.php
header("location:../index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>edit data guru</title>
	<link rel="stylesheet" href="../../../css/bootstrap.min.css" >

</head>
<body>
<div class="container">

	<br/>
	<a href="../index.php" class="btn btn-secondary">Kembali</a>
	<br/>
	<br/>
	<h3 align="center">EDIT DATA GURU</h3>

	<?php
	include'conn.php';
	$id = $_GET['id'];
	$data = mysqli_query($conn,"select * from guru where id='$id'");
	while($d = mysqli_fetch_array($data)){
		?>
<form action="" method="post">
	<input type="hidden" name="id" value="<?php echo $d['id']; ?>">
	<div class="form-group">
		<label for="nama">Nama :</label>
    	<input type="text" class="form-control" id="nama" autocomplete="off" name="nama" value="<?php echo $d['nama']; ?>">
  	</div>

	<div class="form-group">
		<label class="col-form-label">Jenis Kelamin:</label>
			<select class="form-control" name="jk" required>
		    	<option value="" selected disabled>Pilih Jenis Kelamin</option>
		      	<option value="L">Laki-laki</option>
		      	<option value="P">Perempuan</option>
		    </select>
	</div>

  	<div class="form-group">
    	<label for="jabatan">jabatan</label>
    	<input type="text" class="form-control" id="jabatan" autocomplete="off" name="jabatan" value="<?php echo $d['jabatan']; ?>">
  	</div>

  	<div class="form-group">
    	<label for="no">no hp</label>
    	<input type="text" class="form-control" id="no" autocomplete="off" name="no_hp" value="<?php echo $d['no_hp']; ?>">
  	</div>

  	<div class="form-group">
    	<label for="password">password</label>
    	<input type="password" class="form-control" id="password" autocomplete="off" name="password" value="<?php echo $d['password']; ?>">
  	</div>

  	<button type="submit" class="btn btn-primary" name="simpan">simpan</button>
</form>
		<?php 
	}
	?>

</div>
</body>
</html>