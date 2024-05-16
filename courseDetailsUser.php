<?php
session_start(); // Memulai sesi di awal skrip

// Memeriksa apakah pengguna belum login
if (isset($_SESSION['email'])) {
    // Jika belum, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Menghentikan eksekusi skrip lebih lanjut
}

// Sambungkan ke database
include('dbConnection.php');

// Dapatkan email dari sesi
$email = $_SESSION['email'];

// Kueri untuk memeriksa status pengguna
$stmt = $conn->prepare("SELECT status FROM user WHERE email = :email");
$stmt->bindValue(':email', $email);
$stmt->execute();
$userStatus = $stmt->fetchColumn();

// Memeriksa apakah status pengguna tidak sama dengan 0
if ($userStatus == 0) {
    // Jika status pengguna sama dengan 0, arahkan kembali ke halaman coursemenu.php
    header("Location: coursemenu.php");
    exit();
}

// Tangkap nama dan sub course dari URL query string
$courseTitle = isset($_GET['title']) ? $_GET['title'] : '';
$subCourse = isset($_GET['sub_course']) ? $_GET['sub_course'] : '';

// Kueri untuk mengambil video dan deskripsi sub course dari tabel course berdasarkan nama dan sub course
$stmt = $conn->prepare("SELECT link_video, description FROM course WHERE nama_course = :courseTitle AND sub_course = :subCourse");
$stmt->bindValue(':courseTitle', $courseTitle);
$stmt->bindValue(':subCourse', $subCourse);
$stmt->execute();
$courseDetails = $stmt->fetch(PDO::FETCH_ASSOC);

$conn = null; // Tutup koneksi
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <link rel="stylesheet" href="css/courseDetails.css">
</head>
<body>
    <div class="course-details">
        <h2><?php echo htmlspecialchars($courseTitle); ?> - <?php echo htmlspecialchars($subCourse); ?></h2>
        <div class="video">
            <iframe width="560" height="315" src="<?php echo $courseDetails['link_video']; ?>" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="description">
            <p><?php echo $courseDetails['description']; ?></p>
        </div>
    </div>
</body>
</html>
