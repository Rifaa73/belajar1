<?php 

session_start();
if($_SESSION['status']!="login" || $_SESSION['level']!="admin" ){
    header("location:../index.php?pesan=belum_login");
}

//mennghubungkan file conn
include"../../conn.php";


$ambil_guru="SELECT * FROM jadwal_pelajaran";
$ambil_kelas="SELECT * FROM daftar_kelas";

//mengambil data dari database
$query= mysqli_query($conn,$ambil_guru);
$query_kelas= mysqli_query($conn,$ambil_kelas);

if (isset($_POST['kirim'])) {
$hasil = $_POST['pilih'];
$ambil_guru="SELECT * FROM jadwal_pelajaran where kelas Like '$hasil'";

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
<a href="index.php"><button class="btn btn-light"> Data Guru</button></a>
<a href="siswa.php"><button class="btn btn-light"> Data Siswa</button></a>
<a href="jadwal.php"><button class="btn btn-light active"> Data Jadwal</button></a>
<a href="atur_kelas.php"><button class="btn btn-light">Atur Kelas</button></a>
<a href="atur_pelajaran.php"><button class="btn btn-light">Atur Pelajaran</button></a>

<a href="logout.php"><button class="btn btn-light" style="margin-top: 20%;">Logout</button></a>

</div>

<div class="content">

    <h1>Data Pelajaran</h1>
<form action="" method="post">
    <button  class="btn btn-outline-success" name="kirim" style="width: 200px; float: right;">Pilih</button>
<select class="form-control" name="pilih" style="width: 400px; float: right; margin-right: 20px;">

<?php  while ($a=mysqli_fetch_assoc($query_kelas)) {?>
    <?php $b=$a['kelas'];?>
    <option value="<?php echo($b); ?>"><?php echo "$b"; ?></option>
<?php } ?>

</select>
</form>



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

<table class="table table-bordered" style="margin-top: 100px;">
  <thead style="background-color: #001f3f; color: white;">
    <tr>
      <th scope="col" width="50">No</th>
      <th scope="col">Kelas</th>
      <th scope="col">Hari</th>
      <th scope="col">Jadwal</th>
      <th scope="col" width="2%" class="text-center">Aksi</th>
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
        <td style="padding: 8% 0px;"><a href="crud_jadwal/edit.php?id=<?php echo($id); ?>"><button class="btn btn-info text-white" >EDIT</button></a></td>
    </tr>





<?php 
//end while 

}

?>
</tbody>
</table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="../../js/bootstrap.min.js"></script>
</body>
</html>



