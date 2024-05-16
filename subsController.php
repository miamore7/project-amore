<?php
session_start();

// Memeriksa apakah email ada di session
if (!isset($_SESSION['email'])) {
    die("Error: Email tidak ditemukan dalam sesi.");
}

// Mengambil email dari session
$email = $_SESSION['email'];

// Menggunakan koneksi database dari dbConnection.php
$conn = require 'dbConnection.php';

// Mengupdate status pengguna menjadi 1 dengan prepared statement
$stmt = $conn->prepare("UPDATE user SET status = 1 WHERE email = ?");
$stmt->bind_param("s", $email);

if ($stmt->execute() === TRUE) {
    echo "Status telah diperbarui menjadi 1 untuk pengguna dengan email: $email";
} else {
    echo "Error: " . $stmt->error;
}

// Menutup statement dan koneksi
$stmt->close();
$conn->close();
?>