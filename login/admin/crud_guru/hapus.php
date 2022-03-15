<?php 
// koneksi database
include 'conn.php';
session_start();
if($_SESSION['status']!="login"){
	header("location:form_login.php?pesan=belum_login");
}




// menangkap data id yang di kirim dari url
$id = $_GET['id'];

// menghapus data dari database
mysqli_query($conn,"DELETE from guru where id='$id'");

// mengalihkan halaman kembali ke index.php
header("location:../index.php");

?>