<?php
include('dbConnection.php'); // File untuk koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseId = isset($_POST['course_id']) ? intval($_POST['course_id']) : 0;
    $courseTitle = isset($_POST['course_title']) ? $_POST['course_title'] : '';
    $subCourseId = isset($_POST['sub_course_id']) ? intval($_POST['sub_course_id']) : 0;
    $userId = 1; // Gantilah ini dengan ID pengguna yang sesungguhnya dari sesi

    // Simpan data ke database
    $stmt = $pdo->prepare("INSERT INTO user_courses (user_id, course_id, course_title, sub_course_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$userId, $courseId, $courseTitle, $subCourseId]);

    // Redirect ke halaman untuk menampilkan video dan deskripsi
    header("Location: course_details.php?course_id=$courseId&sub_course_id=$subCourseId");
    exit();
}
?>
