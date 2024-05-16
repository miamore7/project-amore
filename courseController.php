<?php
session_start(); // Memulai sesi di awal skrip

// Memeriksa apakah pengguna sudah login
if (isset($_SESSION['email'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Menghentikan eksekusi skrip lebih lanjut
}

include('dbConnection.php'); // Menghubungkan ke database

// Tangkap data dari form
$courseTitle = isset($_SESSION['course_title']) ? $_SESSION['course_title'] : '';
$subCourseName = isset($_POST['sub_course_name']) ? $_POST['sub_course_name'] : '';
$videoLink = isset($_POST['video_link']) ? $_POST['video_link'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';

// Lakukan validasi sederhana
if (empty($courseTitle) || empty($subCourseName) || empty($videoLink) || empty($description)) {
    echo "All fields are required!";
    exit();
}

// Siapkan dan jalankan pernyataan SQL untuk menyimpan data
$sql = "INSERT INTO course (nama_course, sub_course, link_video, description) VALUES (:courseTitle, :subCourseName, :videoLink, :description)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':courseTitle', $courseTitle);
$stmt->bindParam(':subCourseName', $subCourseName);
$stmt->bindParam(':videoLink', $videoLink);
$stmt->bindParam(':description', $description);

if ($stmt->execute()) {
    // Berhasil menyimpan data
    header("Location: success.php"); // Redirect ke halaman sukses atau halaman yang Anda inginkan
} else {
    // Gagal menyimpan data
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn = null; // Tutup koneksi
?>
