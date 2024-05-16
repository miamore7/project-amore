<?php
session_start(); // Memulai sesi di awal skrip

// Memeriksa apakah pengguna belum login
if (isset($_SESSION['email'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Menghentikan eksekusi skrip lebih lanjut
}

// Sambungkan ke database
include('dbConnection.php');
include('sidebarAdmin.php');

// Tangkap nama dan sub course dari URL query string
$courseTitle = isset($_GET['title']) ? $_GET['title'] : '';
$subCourse = isset($_GET['sub_course']) ? $_GET['sub_course'] : '';

// Kueri untuk mengambil video dan deskripsi sub course dari tabel course berdasarkan nama dan sub course
$stmt = $conn->prepare("SELECT id, link_video, description FROM course WHERE nama_course = :courseTitle AND sub_course = :subCourse");
$stmt->bindValue(':courseTitle', $courseTitle);
$stmt->bindValue(':subCourse', $subCourse);
$stmt->execute();
$courseDetails = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle update course
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $linkVideo = $_POST['link_video'];
    $description = $_POST['description'];

    $updateStmt = $conn->prepare("UPDATE course SET link_video = :link_video, description = :description WHERE id = :id");
    $updateStmt->bindValue(':link_video', $linkVideo);
    $updateStmt->bindValue(':description', $description);
    $updateStmt->bindValue(':id', $courseDetails['id']);
    $updateStmt->execute();

    header("Location: courseAdmin.php?title=$courseTitle&sub_course=$subCourse");
    exit();
}

// Handle delete course
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $deleteStmt = $conn->prepare("DELETE FROM course WHERE id = :id");
    $deleteStmt->bindValue(':id', $courseDetails['id']);
    $deleteStmt->execute();

    header("Location: courseAdmin.php");
    exit();
}

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
            <iframe width="560" height="315" src="<?php echo htmlspecialchars($courseDetails['link_video']); ?>" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="description">
            <p><?php echo htmlspecialchars($courseDetails['description']); ?></p>
        </div>
        <div class="actions">
            <form method="post">
                <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this course?');">Delete</button>
            </form>
            <button onclick="document.getElementById('update-form').style.display='block'">Update</button>
        </div>
        <div id="update-form" style="display:none;">
            <h3>Update Course</h3>
            <form method="post">
                <label for="link_video">Video Link:</label>
                <input type="text" id="link_video" name="link_video" value="<?php echo htmlspecialchars($courseDetails['link_video']); ?>" required><br>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($courseDetails['description']); ?></textarea><br>
                <button type="submit" name="update">Update</button>
            </form>
        </div>
    </div>
</body>
</html>
