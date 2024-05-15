<?php
session_start();

// Memeriksa apakah pengguna sudah login
if (isset($_SESSION['email'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Menghentikan eksekusi skrip lebih lanjut
}

// Mengambil email dari session
$email = $_SESSION['email'];

// Melakukan koneksi ke database (ganti dengan detail koneksi sesuai dengan konfigurasi Anda)
$servername = "localhost";
$username = "root";
$password = "";
$database = "amoredb";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Mengupdate status pengguna menjadi 1
$sql = "UPDATE user SET status = 1 WHERE email = '$email'";

if ($conn->query($sql) === TRUE) {
    echo "Status telah diperbarui menjadi 1 untuk pengguna dengan email: $email";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
