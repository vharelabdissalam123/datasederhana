<?php
session_start();
include "koneksi.php";

$error   = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username   = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password   = mysqli_real_escape_string($conn, $_POST['password']);
    $konfirmasi = mysqli_real_escape_string($conn, $_POST['konfirmasi']);

    if ($username == "" || $password == "") {
        $error = "Username dan password wajib diisi!";
    } elseif ($password !== $konfirmasi) {
        $error = "Konfirmasi password tidak cocok!";
    } else {
        $cek = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

        if (mysqli_num_rows($cek) > 0) {
            $error = "Username sudah dipakai, coba yang lain!";
        } else {
            // Semua yang daftar sendiri otomatis role 'user', bukan admin
            mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'user')");
            $success = "Registrasi berhasil! Silakan login.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<?php if ($error) { ?>
    <p style="color:red;"><?= $error; ?></p>
<?php } ?>

<?php if ($success) { ?>
    <p style="color:green;"><?= $success; ?></p>
<?php } ?>

<form action="register.php" method="POST">
    Username <br>
    <input type="text" name="username"><br><br>

    Password <br>
    <input type="password" name="password"><br><br>

    Konfirmasi Password <br>
    <input type="password" name="konfirmasi"><br><br>

    <button type="submit">Daftar</button>
</form>

<p>Sudah punya akun? <a href="login.php">Login di sini</a></p>

</body>
</html>
