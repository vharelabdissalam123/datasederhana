
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa</title>
</head>
<body>

<p>Login sebagai: <b><?= htmlspecialchars($_SESSION['username']); ?></b> | <a href="logout.php">Logout</a></p>

<h2>Input Data Siswa</h2>

<form action="tambah.php" method="POST">
    NISN <br>
    <input type="text" name="nisn"><br><br>

    Nama <br>
    <input type="text" name="nama"><br><br>

    Kelas <br>
    <input type="text" name="kelas"><br><br>

    <button type="submit">Simpan</button>
</form>

<hr>

<h2>Data Siswa</h2>

<table border="1" cellpadding="10">
<tr>
    <th>NISN</th>
    <th>Nama</th>
    <th>Kelas</th>
</tr>

<?php

$data = mysqli_query($conn,"SELECT * FROM siswa");

while($d = mysqli_fetch_array($data)){
?>

<tr>
    <td><?= $d['nisn']; ?></td>
    <td><?= $d['nama']; ?></td>
    <td><?= $d['kelas']; ?></td>
</tr>

<?php } ?>

</table>

</body>
</html>
