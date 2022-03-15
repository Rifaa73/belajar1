<?php 

include"conn.php";
$ambil_guru="SELECT * FROM jadwal_pelajaran";

//mengambil data dari database
$query= mysqli_query($conn,$ambil_guru);

$ambil_kelas="SELECT * FROM daftar_kelas";
$querykelas= mysqli_query($conn,$ambil_kelas);

?>

<html>
<head>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <title>SIAS - Jadwal Pelajaran</title>
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
      <li class="nav-item ">
        <a class="nav-link" href="siswa.php">Daftar siswa</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="guru.php">Daftar guru</a>
      </li>
      <li class="nav-item active">
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

<?php 
if (isset($_POST['kirim'])) {

$pilih=$_POST['pilih'];
$ambil_guru="SELECT * FROM jadwal_pelajaran where kelas='$pilih'";

//mengambil data dari database
$query= mysqli_query($conn,$ambil_guru);
}
 ?>

<div class="container" style="padding: 50px 0;">
	<img src="img/s.png" width="300">
	<h3>Jadwal Pelajaran SMK INFORMATIKA SUMEDANG</h3>
	<form action="" method="post" style="margin: 50px 0px;">
		 	<button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="kirim" style="float: right; width: 200px;">Search</button>
 	  <div class="form-group" style="float: right;">
    <select class="form-control" id="exampleFormControlSelect1" name="pilih">

<?php  while ($a=mysqli_fetch_assoc($querykelas)) {?>
  <?php $b=$a['kelas'];?>
  <option value="<?php echo($b); ?>"><?php echo "$b"; ?></option>
<?php } ?>

    </select>
  </div>

 </form>
<table class="table table-bordered">
  <thead>
    <tr class="bg-info text-white">
      <th scope="col" width="15">No</th>
      <th scope="col">Kelas</th>
      <th scope="col" width="200">Hari</th>
      <th scope="col">Jadwal</th>
    </tr>
  </thead>
  <tbody>

<?php

// untuk perulangan seluruh data ramuan
$i=0;
while ($asosiasi=mysqli_fetch_assoc($query)) {
//id guru
$id=$asosiasi['id'];
//kelas
$kelas=$asosiasi['kelas'];
//hari
$hari=$asosiasi['hari'];
//jadwal
$jadwal=explode(",", $asosiasi['jadwal']);


++$i;

?>

	<tr>
		<td><?php echo "$i"; ?></td>
		<td><?php echo "$kelas"; ?></td>
		<td><?php echo "$hari"; ?></td>
		<td><?php 
$no_jadwal=1;
//perulangan array
foreach ($jadwal as $j) 
{
 echo "$no_jadwal".". "."$j<br/>";
 //ieu nambahkeun na
 $no_jadwal++;
}
	?></td>
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



