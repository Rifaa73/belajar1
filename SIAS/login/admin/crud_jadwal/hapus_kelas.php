<?php 
// koneksi database
include 'conn.php';
session_start();
if($_SESSION['status']!="login"){
	header("location:form_login.php?pesan=belum_login");
}


	$id = $_GET['id'];
	$data = mysqli_fetch_array(mysqli_query($conn,"select * from daftar_kelas where id='$id'"));
	$data_kelas= $data['kelas'];
	$coba=mysqli_fetch_array(mysqli_query($conn,"SELECT kelas FROM jadwal_pelajaran WHERE kelas='$data_kelas'"));
	$coba2=$coba['kelas'];



// menghapus data dari database
mysqli_query($conn,"DELETE from jadwal_pelajaran where kelas='$coba2'");

mysqli_query($conn,"DELETE from daftar_kelas where id='$id'");


// mengalihkan halaman kembali ke index.php
header("location:../atur_kelas.php");

?>