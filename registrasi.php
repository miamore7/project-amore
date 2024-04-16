<?php
include('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body background="img/Lilin Aromaterapi 150 gr Scented Candle Lilin Aromatherapy Lilin Wangi - rose, 150 gram di Blummy D.jpeg.jpg">
    <div class="container">
        <h1>Welcome!</h1>
        <form action="#">
            <div class="form-group">
                <label for="fullName">Nama Lengkap</label>
                <input type="text" id="fullName" name="fullName" placeholder="Masukkan nama lengkap Anda" required>
            </div>
            <div class="form-group">
                <label for="phoneNumber">Nomor Telepon</label>
                <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Masukkan nomor telepon Anda" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan alamat email Anda" required>
            </div>
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="Masukkan kata sandi Anda" required>
            </div>
            <!-- <div class="form-group">
                <label for="confirmPassword">Konfirmasi Kata Sandi</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Masukkan kembali kata sandi Anda" required>
            </div> -->
            <br>
            <div class="form-group">
                <input type="submit" id="submitRegister" name="password" placeholder="Masukkan kata sandi Anda" required>
            </div>
        </form>
        <br>
        <p style="text-align: center;">Sudah memiliki akun? <a href="login,php">Masuk di sini!</a></p>
    </div>
</body>
</html>
