<?php
session_start(); // Memulai sesi di awal skrip

// Memeriksa apakah pengguna sudah login
if (isset($_SESSION['email'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Menghentikan eksekusi skrip lebih lanjut
}

// Sambungkan ke database
include('dbConnection.php');
include('sidebarAdmin.php');

// Tangkap data dari form
$courseId = isset($_POST['course_id']) ? $_POST['course_id'] : '';
$courseTitle = isset($_POST['course_title']) ? $_POST['course_title'] : '';
$subCourse = isset($_POST['sub_course']) ? $_POST['sub_course'] : '';
$newLinkVideo = isset($_POST['link_video']) ? $_POST['link_video'] : '';
$newDescription = isset($_POST['description']) ? $_POST['description'] : '';

// Jika form update dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Kueri untuk mengupdate video dan deskripsi sub course
    $updateStmt = $conn->prepare("UPDATE course SET link_video = :link_video, description = :description WHERE id = :id");
    $updateStmt->bindValue(':link_video', $newLinkVideo);
    $updateStmt->bindValue(':description', $newDescription);
    $updateStmt->bindValue(':id', $courseId);
    $updateStmt->execute();

    // Redirect ke halaman courseDetails.php untuk melihat perubahan
    header("Location: courseDetails.php?title=" . urlencode($courseTitle) . "&sub_course=" . urlencode($subCourse));
    exit();
}

$conn = null; // Tutup koneksi
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Course</title>
    <link rel="stylesheet" href="css/courseDetails.css">
</head>
<body>
    <div class="course-details">
        <h2>Update <?php echo htmlspecialchars($courseTitle); ?> - <?php echo htmlspecialchars($subCourse); ?></h2>
        <form method="POST">
            <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($courseId); ?>">
            <input type="hidden" name="course_title" value="<?php echo htmlspecialchars($courseTitle); ?>">
            <input type="hidden" name="sub_course" value="<?php echo htmlspecialchars($subCourse); ?>">
            <div class="form-group">
                <label for="link_video">Link Video:</label>
                <input type="text" id="link_video" name="link_video" value="<?php echo htmlspecialchars($newLinkVideo); ?>">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description"><?php echo htmlspecialchars($newDescription); ?></textarea>
            </div>
            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>
</html>
