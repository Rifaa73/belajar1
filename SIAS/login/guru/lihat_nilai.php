<?php 


session_start();
if($_SESSION['status']!="login"){
	header("location:../index.php?pesan=belum_login");
}

//mennghubungkan file conn
include"../../conn.php";

$id=$_GET['id'];

$ambil_siswa="SELECT * FROM siswa WHERE id='$id'";
$ambil_pelajaran="SELECT * FROM daftar_pelajaran";


//mengambil data dari database
$query= mysqli_query($conn,$ambil_siswa);
$query_pelajaran= mysqli_query($conn,$ambil_pelajaran);




$data_siswa=mysqli_fetch_assoc($query);


$nama=$data_siswa['nama'];
$kelas=$data_siswa['kelas'];
$jk=$data_siswa['jenis_kelamin'];
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
    	.content{
    		margin: 70px 50px 50px 100px;
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


<div class="content">
	<h1>Data Siswa <?php echo "$nama"; ?></h1>
		<a href="siswa.php"><button  style="margin-top: 30px;" class="btn btn-info"> Kembali ke Data Siswa</button></a>
<img src="data.png" width="400" style="margin: 0px 250px; float: right; margin-top: 100px;">

<div class="card" style="width: 30rem; margin-top: 50px;">
  <div class="card-header">
    <h4>Data Siswa</h4>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Nama &nbsp; &nbsp; &nbsp; &emsp; &emsp; &emsp;= &emsp; <?php echo "$nama"; ?></li>
    <li class="list-group-item">Kelas &nbsp; &emsp; &nbsp; &nbsp; &emsp; &emsp; =  &emsp;<?php echo "$kelas"; ?></li>
    <li class="list-group-item">Jenis kelamin &nbsp; &emsp; = &emsp; <?php echo "$jk"; ?></li>
  </ul>
</div>


<br><br>
<table class="table table-bordered">
  <thead style="background-color: #001f3f; color: white;">
    <tr>
      <th scope="col" width="50">No</th>
      <th scope="col">nama pelajaran</th>
      <th scope="col">nilai</th>

    </tr>
  </thead>
  <tbody>
	<tr>
		<?php 
$i=0;
		while ($data_pelajaran=mysqli_fetch_assoc($query_pelajaran)) { 
			$a=$data_pelajaran['pelajaran'];
			++$i;
			
			$b=mysqli_fetch_array(mysqli_query($conn,"SELECT $a FROM siswa WHERE id='$id'"));
			?>
		<td><?php echo "$i"; ?></td>
		<td><?php echo "$a"; ?></td>
		<td><?php echo "$b[0]"; ?></td>
	</tr>
<?php } ?>
</tbody>

</table>



</body>
</html>