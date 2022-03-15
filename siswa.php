<?php 
//mennghubungkan file conn
include"conn.php";

$sql = "SELECT * FROM `siswa`  \n"

    . "ORDER BY `siswa`.`kelas`  DESC";



$ambil_kelas="SELECT * FROM daftar_kelas";
$query_kelas= mysqli_query($conn,$ambil_kelas);
//mengambil data dari database
$query= mysqli_query($conn,$sql);

//proses saat mencari berdasarkan nama 
if (isset($_POST['cari'])) {
$hasil = $_POST['search'];
$ambil_guru="SELECT * FROM siswa where nama Like '%".$hasil."%'" . "ORDER BY `siswa`.`kelas`  DESC";

$query= mysqli_query($conn,$ambil_guru);


}
$num=mysqli_num_rows($query);
if ($num<1) {
	$peringatan="data tidak ada";
}



//proses saat mencari berdasarkan kelas
if (isset($_POST['kirim'])) {
$hasil = $_POST['pilih'];
$ambil_guru="SELECT * FROM siswa where kelas Like '$hasil'";

$query= mysqli_query($conn,$ambil_guru);

$num=mysqli_num_rows($query);
if ($num<1) {
  $peringatan="data tidak ada";
}
}

?>

<html>
<head>
 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <title>SIAS - Daftar Siswa</title>
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

<nav class="navbar navbar-expand-lg navbar-dark bg-info" style="font-size: 22px;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="siswa.php">Daftar siswa</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="guru.php">Daftar guru</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="jadwal.php">Jadwal Pelajaran</a>
      </li>
    </ul>
  </div>
</nav>

<h1>
<?php 
if (isset($peringatan)) {
	echo "$peringatan";
}
?>
</h1>

<div class="container" style="padding: 50px 0;">
	<img src="img/sp.png" width="300">
	<h3>Daftar Siswa SMK INFORMATIKA SUMEDANG</h3>
	<form action="" method="post" style="margin: 50px 0px;">
 	<button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="cari" style="float: right; width: 200px;">Search</button>
 	<input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" autocomplete="off" style="width: 400px; float: right;"> 
 </form>

 <form action="" method="post"  style="margin: 85px">
  <button  class="btn btn-outline-success mb-2" name="kirim" style="width: 200px; float: right; margin-right: -608px; margin-top: 10px; ">Pilih</button>
<select class="form-control" name="pilih" style="width: 400px; float: right; margin-right: -399px;  margin-top: 10px; ">

<?php  while ($a=mysqli_fetch_assoc($query_kelas)) {?>
  <?php $b=$a['kelas'];?>
  <option value="<?php echo($b); ?>"><?php echo "$b"; ?></option>
<?php } ?>

</select>
</form>

<table class="table table-bordered text-center" style="margin-top: 140px;">
  <thead>
    <tr class="bg-info text-white">
      <th scope="col" width="15">No</th>
      <th scope="col">Nama</th>
      <th scope="col" width="200">Jenis Kelamin</th>
      <th scope="col">Kelas</th>
      <th scope="col">Lihat Nilai</th>
    </tr>
  </thead>
  <tbody>

<?php

// untuk perulangan seluruh data ramuan
$i=0;
while ($asosiasi=mysqli_fetch_assoc($query)) {
	
$id=$asosiasi['id'];
//nama
$data_nama=$asosiasi['nama'];
//kelamin
$data_kelamin=$asosiasi['jenis_kelamin'];
//kelas
$kelas=$asosiasi['kelas'];


++$i;

?>

	<tr>
		<td><?php echo "$i"; ?></td>
		<td><?php echo "$data_nama"; ?></td>
		<td><?php echo "$data_kelamin"; ?></td>
		<td><?php echo "$kelas"; ?></td>
    <td><a href="lihat_nilai.php?id=<?php echo($id); ?>"><button class="btn btn-primary text-white">SELENGKAPNYA</button></a></td>
	</tr>





<?php 
//end while 

}

?>
</tbody>
</table>
</div>

</body>
</html>



