<?php
session_start(); // Memulai sesi di awal skrip

// Memeriksa apakah pengguna sudah login
if (isset($_SESSION['email'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Menghentikan eksekusi skrip lebih lanjut
}

include('sidebarAdmin.php'); 
?>
<link rel="stylesheet" href="css/success.css">
<div class="top-courses">
    <h2>Data Berhasil Disimpan</h2>
    <p>Sub Course telah berhasil ditambahkan ke course "<?php echo htmlspecialchars($_SESSION['course_title']); ?>"</p>
    <a href="courseAdmin.php"><button type="button">Kembali ke Course</button></a>
</div>
