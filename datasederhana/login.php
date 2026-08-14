<?php
session_start();
include "koneksi.php";

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    $user  = mysqli_fetch_array($query);

    if ($user && $password === $user['password']) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role']     = $user['role'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<?php if ($error) { ?>
    <p style="color:red;"><?= $error; ?></p>
<?php } ?>

<form action="login.php" method="POST">
    Username <br>
    <input type="text" name="username"><br><br>

    Password <br>
    <input type="password" name="password"><br><br>

    <button type="submit">Login</button>
</form>

<p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>

</body>
</html>
