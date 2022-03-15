<?php 
// koneksi database
include 'conn.php';
session_start();
if($_SESSION['status']!="login" || $_SESSION['level']!="admin"){
	header("location:form_login.php?pesan=belum_login");
}


	$id = $_GET['id'];
	$data = mysqli_fetch_array(mysqli_query($conn,"select * from daftar_pelajaran where id='$id'"));
	$data_pelajaran= $data['pelajaran'];



// menghapus data dari database
mysqli_query($conn,"ALTER TABLE `siswa` DROP `$data_pelajaran`;");

mysqli_query($conn,"DELETE from daftar_pelajaran where id='$id'");


// mengalihkan halaman kembali ke index.php
header("location:../atur_pelajaran.php");

?>