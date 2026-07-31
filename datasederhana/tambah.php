<?php
include "koneksi.php";

$nisn  = $_POST['nisn'];
$nama  = $_POST['nama'];
$kelas = $_POST['kelas'];

mysqli_query($conn,"INSERT INTO siswa VALUES('$nisn','$nama','$kelas')");

header("Location:index.php");
?>