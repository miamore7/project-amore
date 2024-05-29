<?php
// session_start(); // Memulai sesi di awal skrip

// Memeriksa apakah pengguna sudah login
if (isset($_SESSION['email'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Menghentikan eksekusi skrip lebih lanjut
}

include('dbConnection.php'); // Menghubungkan ke database
include('sidebarAdmin.php');
// Tangkap judul dari URL query string
$courseTitle = isset($_GET['title']) ? $_GET['title'] : '';

// Set nilai 'course_title' di sesi
$_SESSION['course_title'] = $courseTitle;
?>
<link rel="stylesheet" href="css/tambahCourse.css">
<div class="top-courses">
    <h2>Tambah Sub Course untuk "<?php echo htmlspecialchars($courseTitle); ?>"</h2>
    <form class="tambahCourse" method="post" action="courseController.php">
        <input type="hidden" name="course_title" value="<?php echo htmlspecialchars($courseTitle); ?>">
        <h4>Sub Course Name: </h4>
        <input type="text" name="sub_course_name">
        <br>
        <h4>Video Link: </h4>
        <input type="text" name="video_link">
        <br>
        <h4>Deskripsi: </h4>
        <input type="text" name="description">
        <br>
        <button type="submit">Send</button>
    </form>
</div>
