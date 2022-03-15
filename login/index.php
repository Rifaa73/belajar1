<?php  

session_start();
include"../conn.php";
	if(isset($_GET['pesan'])){
		if($_GET['pesan'] == "gagal"){
			echo "<script>alert('Login gagal! username dan password salah!');</script>";
		}else if($_GET['pesan'] == "logout"){
			echo "<script>alert('Anda telah berhasil logout');</script>";
		}else if($_GET['pesan'] == "belum_login"){
			echo "<script>alert('Anda harus login untuk mengakses halaman admin');</script>";
		}
	}


if (isset($_POST['login'])) {


// menghubungkan dengan koneksi

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];

// menyeleksi data admin dengan username dan password yang sesuai
$data1 = mysqli_query($conn,"SELECT * from admin where username='$username' and password='$password'");
$data2 = mysqli_query($conn,"SELECT * from guru where nama='$username' and password='$password'");

// menghitung jumlah data yang ditemukan
$cek_admin = mysqli_num_rows($data1);
$cek_guru = mysqli_num_rows($data2);

if($cek_admin > 0){
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	$_SESSION['level'] ="admin";
	header("location:admin/index.php");
}else if($cek_guru > 0){
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	$_SESSION['level'] ="guru";
	header("location:guru/index.php");
}else{
header("location:index.php?pesan=gagal");
}
}


?>



<!DOCTYPE html>
<html>
<head>
	 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" >
    <title>SIAS - HOME</title>
<style>
body, html {
  height: 100%;
  margin: 0;

  /* The image used */
 background:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url("../img/bg5.jpg");

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
</head>
<body>
<div class="container"  style="padding: 200px 20%;">
<div class="card" style="width: 25rem; padding: 20px; background-color: ghostwhite;">
	 <h3 class="card-title text-center">Login</h3>
  <div class="card-body">
	<form method="post" action="">
		<div class="form-group">
		    <label for="exampleInputEmail1">Username</label>
		    <input type="text" class="form-control"  name="username" autocomplete="off">
		 </div>
		 <div class="form-group">
		    <label for="exampleInputPassword1">Password</label>
		    <input type="password" class="form-control"  name="password">
		 </div>
			<a href="../index.php" class="btn btn-secondary">Kembali</a>
		 <button type="submit" class="btn btn-primary" name="login" style="width: 150px; float: right;" >Submit</button>	
	</form>
  </div>
</div>
</div>
</body>
</html>