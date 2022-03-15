<?php 

session_start();
if($_SESSION['status']!="login" || $_SESSION['level']!="admin" ){
	header("location:../index.php?pesan=belum_login");
}

//mennghubungkan file conn
include"../../conn.php";

$ambil_guru="SELECT * FROM guru";




//mengambil data dari database
$query= mysqli_query($conn,$ambil_guru);


if (isset($_POST['cari'])) {
$hasil = $_POST['search'];
$ambil_guru="SELECT * FROM guru where nama Like '%".$hasil."%'";

$query= mysqli_query($conn,$ambil_guru);



$num=mysqli_num_rows($query);
if ($num<1) {
	$peringatan="data tidak ada";
}
}


?>


<html>
<head>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css" >
    <title>SIAS - HOME</title>
    <style type="text/css">
    	body{
    		max-width: 100%;
    		text-align: justify;
    	}
    	.sidebar{
    		min-height: 100%;
    		width: 250px;
    		padding: 50px 25px;
    		position: fixed;
    	}
    	.content{
    		margin: 70px 50px 50px 300px;
    		padding: 100px 10px;
    	}
    	.btn-light{
    		margin: 15px 0px;
    		width: 100%;
    		color: white;
    		background-color: transparent;
    	}
    	.active{
    		background-color: #001f3f;
    	}

    	a{
    		text-decoration: none;
    		color: black;
    	}
    	a::hover{
    		text-decoration: none;
    		color: black;
    	}
    	footer{
    		margin-top: 50px;
    		height: 100px;
    		width: 100%
    		padding:200px;
    		font-size: 25px;
    	}
      .full{
        width: 100%;
      }
    </style>
</head>
<body>

<nav class="navbar navbar-light bg-light fixed-top" style="box-shadow: 0px 3px grey; z-index: 1;">
  <a class="navbar-brand" href="#">
    <img src="logo1.png" width="70" height="60"  alt="" loading="lazy">
    SIAS (Sistem Informasi Akademik Sekolah)
  </a>
</nav>

<div class="sidebar" style="background-color: #001f3f;">
<a href="index.php"><button class="btn btn-light active"> Data Guru</button></a>
<a href="siswa.php"><button class="btn btn-light "> Data Siswa</button></a>
<a href="jadwal.php"><button class="btn btn-light"> Data Jadwal</button></a>
<a href="atur_kelas.php"><button class="btn btn-light">Atur Kelas</button></a>
<a href="atur_pelajaran.php"><button class="btn btn-light">Atur Pelajaran</button></a>

<a href="logout.php"><button class="btn btn-light" style="margin-top: 20%;">Logout</button></a>

</div>

<div class="content">
	<h1>Data Guru</h1>
<div class="full">
<img src="data.png" width="340" style="margin: 0px 250px;">
</div>
 <form action="" method="post" class="form-inline"  style="float: right; margin-top:0px;">
 	<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
	<button class="btn btn-outline-success my-2 my-sm-0" name="cari">Search</button>
 </form>

<button class="btn text-white" data-toggle="modal" data-target="#exampleModal" style="background:#001f3f; margin-top: 0px; float: left;">+ Tambah Data Guru</button>


<h1>
<?php 
if (isset($peringatan)) {
	echo "$peringatan";
}
?>
</h1>

<table class="table table-bordered">
  <thead style="background-color: #001f3f; color: white;">
    <tr>
      <th scope="col" width="50">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Jenis Kelamin</th>
      <th scope="col">Jabatan</th>
      <th scope="col">No HP</th>
      <th scope="col" width="200">Aksi</th>
    </tr>
  </thead>
  <tbody>





<?php

// untuk perulangan seluruh data ramuan
$i=0;
while ($asosiasi=mysqli_fetch_assoc($query)) {
//id guru
$id=$asosiasi['id'];
//nama
$data_nama=$asosiasi['nama'];
//kelamin
$data_kelamin=$asosiasi['jenis_kelamin'];
//jabatan
$jabatan=$asosiasi['jabatan'];
//no hape
$no_hp=$asosiasi['no_hp'];

++$i;

?>

	<tr>
		<td><?php echo "$i"; ?></td>
		<td><?php echo "$data_nama"; ?></td>
		<td><?php echo "$data_kelamin"; ?></td>
		<td><?php echo "$jabatan"; ?></td>
		<td><?php echo "$no_hp"; ?></td>
		<td><a href="crud_guru/edit.php?id=<?php echo($id); ?>"><button class="btn btn-info text-white">EDIT</button></a>
			<a href="crud_guru/hapus.php?id=<?php echo($id); ?>"><button class="btn btn-danger text-white">HAPUS</button></a></td>
	</tr>





<?php 
//end while 

}

?>
  </tbody>
</table>
</div>


<?php 

if (isset($_POST['simpan'])) {

//mengambil data yang dikirim dari form tambah
$a=$_POST['nama'];
$b=$_POST['jk'];
$c=$_POST['jabatan'];
$d=$_POST['no_hp'];
$e=$_POST['password'];

//memasukan data ke dalam database setelah di convert ke string
$tambah="INSERT into guru values('','$a','$b','$c','$d','$e')";

mysqli_query($conn,$tambah);


//redirect ke halaman ramuan
header("location:index.php");

}



 ?>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Guru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" action="">
          <div class="form-group">
            <label class="col-form-label">Nama Guru:</label>
            <input type="text" class="form-control" name="nama">
          </div>
          <div class="form-group">
            <label class="col-form-label">Jenis Kelamin:</label>
            <input type="text" class="form-control" name="jk">
          </div>
          <div class="form-group">
            <label class="col-form-label">Jabatan:</label>
            <input type="text" class="form-control" name="jabatan">
          </div>
           <div class="form-group">
            <label class="col-form-label">No HP:</label>
            <input type="text" class="form-control" name="no_hp">
          </div>
                    <div class="form-group">
            <label class="col-form-label">Password:</label>
            <input type="password" class="form-control" name="password">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="simpan">Tambah Data</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="../../js/bootstrap.min.js"></script>
</body>
</html>



