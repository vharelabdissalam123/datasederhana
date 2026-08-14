<?php
session_start();
include "koneksi.php";

// hanya admin yang boleh menambah data
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$nisn  = $_POST['nisn'];
$nama  = $_POST['nama'];
$kelas = $_POST['kelas'];

mysqli_query($conn,"INSERT INTO siswa VALUES('$nisn','$nama','$kelas')");

header("Location:index.php");
?>
