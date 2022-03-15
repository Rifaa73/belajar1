<?php
include"../../conn.php";


if (isset($_POST['upload'])) {

include "excel_reader2.php";



// upload file xls
$target = basename($_FILES['filepegawai']['name']) ;
move_uploaded_file($_FILES['filepegawai']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['filepegawai']['name'],0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['filepegawai']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);

// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i=2; $i<=$jumlah_baris; $i++){

	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$nama     = $data->val($i, 1);
	$alamat   = $data->val($i, 2);
	$telepon  = $data->val($i, 3);

	if($nama != "" && $alamat != "" && $telepon != ""){
		// input data ke database (table data_pegawai)
		mysqli_query($conn,"INSERT into siswa (nama,jenis_kelamin,kelas)values('$nama','$alamat','$telepon')");
		$berhasil++;
	}
}

// hapus kembali file .xls yang di upload tadi
unlink($_FILES['filepegawai']['name']);
header("location:siswa.php");
}
?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<link rel="stylesheet" href="../../css/bootstrap.min.css" >
 </head>
 <body>
<br>
<div class="container">
<a href="siswa.php" class="btn btn-secondary mb-2">Kembali</a>

 <form method="post" enctype="multipart/form-data" action="">

<div class="custom-file mb-2">
  <input type="file" class="custom-file-input" id="customFile">
  <label class="custom-file-label" for="customFile">pilih file</label>
</div>

<button type="submit" class="btn btn-primary" name="upload">import</button>

</form>
</div>
 </body>
 </html>