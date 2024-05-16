<?php
session_start(); // Memulai sesi di awal skrip

// Memeriksa apakah pengguna sudah login
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    // Lanjutkan dengan operasi lain yang menggunakan $email
} else {
    // Pengguna belum login, arahkan ke halaman login atau lakukan tindakan lain yang sesuai
}

// Sambungkan ke database
include('dbConnection.php');
include('sidebar.php');
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
        <h2><?php echo htmlspecialchars($courseTitle); ?> -  <?php echo htmlspecialchars($subCourse); ?></h2>
        <div class="video">
            <iframe width="560" height="315" src="<?php echo $courseDetails['link_video']; ?>" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="description">
            <p><?php echo $courseDetails['description']; ?></p>
        </div>
    </div>
</body>
</html>
