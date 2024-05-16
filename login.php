<?php
session_start(); // Memulai sesi
include('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="loginRegis" style="background-image: url('img/Lilin\ Aromaterapi\ 150\ gr\ Scented\ Candle\ Lilin\ Aromatherapy\ Lilin\ Wangi\ -\ rose\,\ 150\ gram\ di\ Blummy\ D.jpeg');">
    <div class="container">
        <h1>Welcome!</h1>
        <div>
            <span><?= @$_GET['pesan']; ?></span>
        </div>
        <form action="loginController.php" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan alamat email Anda" required>
            </div>
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="Masukkan kata sandi Anda" required>
            </div>
            <br>
            <div class="form-group">
                <input type="submit" id="submitLogin" name="submitLogin" value="Login">
            </div>
        </form>
        <br>
        <p style="text-align: center;">Belum memiliki akun? <a href="registrasi.php">Masuk di sini!</a></p>
    </div>
</body>
</html>
