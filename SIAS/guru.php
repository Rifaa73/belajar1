<?php 
//mennghubungkan file conn
include"conn.php";

$ambil_guru="SELECT * FROM guru";


//mengambil data dari database
$query= mysqli_query($conn,$ambil_guru);

//mengecek apakah tombol cari sudah dipencet atau belum
if (isset($_POST['cari'])) {
$hasil = $_POST['search'];
$ambil_guru="SELECT * FROM guru where nama  Like '%".$hasil."%'";

$query= mysqli_query($conn,$ambil_guru);


}
$num=mysqli_num_rows($query);
//mengecek apakah data tersedia di database atau tidak
if ($num<1) {
	$peringatan="data tidak ada";
}


?>

<html>
<head>
 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <title>SIAS - Daftar Guru</title>
    <style type="text/css">
    	body{
    		max-width: 100%;
    		text-align: justify;
    	}
    	.jumbo{
    		background:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),url(img/bg5.jpg); 
 			background-position: top-center;
 			background-size: cover;
 			min-height: 1000px;
 			color: white;
    	}
    	a{
    		margin-left: 30px;
    	}
    	footer{
    		margin-top: 50px;
    		height: 100px;
    		width: 100%
    		padding:200px;
    		font-size: 25px;
    	}
    </style>
</head>
<body>

<div class="container" style="height: 80px; margin: 30px 50px; margin-bottom: 90px;">
  	<div class="row"> 
  		<div class="col-xl-3 col-md-3 col-sm-12">
		  	<img src="img/logo1.png" width="200" height="150">
		  </div>
		  <div class="col-xl-9 col-md-9 col-sm-12">
		    <h1 class="display-2">SIAS</h1>
		    <h3>Sistem Informasi Akademik Sekolah</h3>
		</div>
    </div>
  </div>

<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-info" style="font-size: 22px;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="siswa.php">Daftar siswa</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="guru.php">Daftar guru</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="jadwal.php">Jadwal Pelajaran</a>
      </li>
    </ul>
  </div>
</nav>
<!-- end navbar -->

<!-- pemberitahuan yang muncul apabila data tidak ada -->
<h1>
<?php 
if (isset($peringatan)) {
	echo "$peringatan";
}
?>
</h1>

<!-- content -->
<div class="container" style="padding: 50px 0;">
	<img src="img/sp.png" width="300">
	<h3>Daftar Guru SMK INFORMATIKA SUMEDANG</h3>

<!-- form cari -->
<form action="" method="post" style="margin: 50px 0px;">
 	<button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="cari" style="float: right; width: 200px;">Search</button>
 	<input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" autocomplete="off" style="width: 400px; float: right;"> 
</form>

<!-- tabel guru -->
<table class="table table-bordered text-center">
  <thead>
    <tr class="bg-info text-white">
      <th scope="col" width="15">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Jabatan</th>
      <th scope="col" width="200">Jenis Kelamin</th>
    </tr>
  </thead>
  <tbody>


<?php

// untuk perulangan seluruh data guru
$i=0;
while ($asosiasi=mysqli_fetch_assoc($query)) {
	

//nama
$data_nama=$asosiasi['nama'];
//jabatan
$jabatan=$asosiasi['jabatan'];
//jenis kelamin
$data_kelamin=$asosiasi['jenis_kelamin'];



++$i;

?>

	<tr>
		<td><?php echo "$i"; ?></td>
		<td><?php echo "$data_nama"; ?></td>
		<td><?php echo "$jabatan"; ?></td>
		<td><?php echo "$data_kelamin"; ?></td>
	</tr>





<?php 
//end while 

}

?>
</tbody>
</table>
</div>
<!-- end content -->
</body>
</html>



