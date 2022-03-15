<?php 
//mengecek apakah admin login atau belum
session_start();
if($_SESSION['status']!="login"){
	header("location:../index.php?pesan=belum_login");
}

//mennghubungkan file conn
include"../../conn.php";


//mengambil data dari table daftar kelas di database
$ambil_kelas="SELECT * FROM daftar_kelas";
$query_kelas= mysqli_query($conn,$ambil_kelas);

//mengambil data siswa dan mengurutkan berdasarkan kelasnya
$sql = "SELECT * FROM `siswa`  \n"

    . "ORDER BY `siswa`.`kelas`  DESC";


//mengambil data siswa dari database
$query= mysqli_query($conn,$sql);

//proses mencari data siswa berdasarkan nama yang dimasukan
if (isset($_POST['cari'])) {
$hasil = $_POST['search'];
$ambil_guru="SELECT * FROM siswa where nama Like '%".$hasil."%'" . "ORDER BY `siswa`.`kelas`  DESC";


$query= mysqli_query($conn,$ambil_guru);



$num=mysqli_num_rows($query);


if ($num<1) {
$peringatan="data tidak ada";
}

}

//proses mencari data siswa berdasarkan kelas yang di pilih
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

<!-- navbar -->
<nav class="navbar navbar-light bg-light fixed-top" style="box-shadow: 0px 3px grey; z-index: 1;">
  <a class="navbar-brand" href="#">
    <img src="logo1.png" width="70" height="60"  alt="" loading="lazy">
    SIAS (Sistem Informasi Akademik Sekolah)
  </a>
</nav>
<!-- end navbar -->

<!-- side bar -->
<div class="sidebar" style="background-color: #001f3f;">
<a href="index.php"><button class="btn btn-light "> Data Guru</button></a>
<a href="siswa.php"><button class="btn btn-light active"> Data Siswa</button></a>
<a href="jadwal.php"><button class="btn btn-light"> Data Jadwal</button></a>

<a href="logout.php"><button class="btn btn-light" style="margin-top: 20%;">Logout</button></a>

</div>
<!-- end side bar -->

<!-- content -->
<div class="content">
	<h1>Data Siswa</h1>
<div class="full">
<img src="data.png" width="340" style="margin: 0px 250px;">
</div>
<!-- form cari nama -->
 <form action="" method="post" class="form-inline"  style="float: right; margin-top: 0px;">
 	<input class="form-control mr-sm-2" type="search" placeholder="cari nama" aria-label="Search" name="search" autocomplete="off">
	<button class="btn btn-outline-success my-2 my-sm-0" name="cari">Search</button>
 </form>
<!-- end form cari nama -->


<!-- form pilih kelas -->
<form action="" method="post">
  <button  class="btn btn-outline-success mb-2" name="kirim" style="width: 70px; float: right; margin-right: -283px; margin-top: 40px; ">Pilih</button>
<select class="form-control" name="pilih" style="width: 400px; float: right; margin-right: -203px; margin-top: 40px; ">
<!-- perulangan data kelas -->
<?php  while ($a=mysqli_fetch_assoc($query_kelas)) {?>
  <?php $b=$a['kelas'];?>
  <option value="<?php echo($b); ?>"><?php echo "$b"; ?></option>
<?php } ?>

</select>
</form>
<!-- end form pilih kelas -->

<!-- pesan apabila data tidak ada -->
<h1 align="center">
<?php 
if (isset($peringatan)) {
	echo "$peringatan";
}
?>
</h1>
<!-- tabel daftar siswa -->
<table class="table table-bordered" style="margin-top: 83px; ">
  <thead style="background-color: #001f3f; color: white;">
    <tr>
      <th scope="col" width="50">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Jenis Kelamin</th>
      <th scope="col">Kelas</th>
      <th scope="col">Lihat Nilai</th>
      <th scope="col" width="100" class="text-center">Isi Nilai</th>
    </tr>
  </thead>
  <tbody>

<?php

// untuk perulangan seluruh data siswa
$i=0;
while ($asosiasi=mysqli_fetch_assoc($query)) {
//id siswa
$id=$asosiasi['id'];
//nama siswa
$data_nama=$asosiasi['nama'];
//kelamin
$data_kelamin=strtoupper($asosiasi['jenis_kelamin']);
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

		<td><button class="btn btn-success text-white" data-toggle="modal" data-target="#atur" style="width: 100%;">ATUR</button></td>
	</tr>





<?php 
//end while 

}

?>
</tbody>
</table>
<!-- end content -->
</div>

<?php

$ambil="SELECT * FROM daftar_pelajaran";

$query_pelajaran=mysqli_query($conn,$ambil);


if (isset($_POST['simpan1'])) {


//mengambil data yang dikirim dari form tambah

$nama=$_POST['nama'];
$pilih=$_POST['pilih'];


//memasukan data ke dalam database
$tambah="UPDATE siswa SET $pilih='$nama'";

mysqli_query($conn,$tambah);


}
?>
<!-- form untuk mengubah nilai siswa, form ini menggunakan modal -->
<div class="modal fade" id="atur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Atur Nilai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" action="">
      <div class="form-group">
        <label class="col-form-label">Pelajaran:</label>
        <select class="form-control" name="pilih" required>
        <option value="" selected disabled>Pilih Pelajaran</option>
<!-- while untuk menampilkan seluruh pelajaran dalam dropdown -->
<?php  while ($a=mysqli_fetch_assoc($query_pelajaran)) {?>
  <?php $b=$a['pelajaran'];?>
  <option value="<?php echo($b); ?>"><?php echo "$b"; ?></option>
<?php } ?>
<!-- end while -->
        </select>
      </div>
          <div class="form-group">
            <label class="col-form-label">Nilai:</label>
            <input type="text" class="form-control" name="nama" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" name="simpan1">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end form ubah nilai siswa -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="../../js/bootstrap.min.js"></script>
</body>
</html>