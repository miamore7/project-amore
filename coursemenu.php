<?php 
session_start(); // Memulai sesi di awal skrip

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Menghentikan eksekusi skrip lebih lanjut
}

include('sidebar.php'); 

// Tangkap judul dari URL query string
$courseTitle = isset($_GET['title']) ? $_GET['title'] : '';
$courseId = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
?>
<link rel="stylesheet" href="css/coursemenu.css">
<div class="top-courses">
  <div class="course-content">
    <h2><?php echo htmlspecialchars($courseTitle); ?></h2>
    <div class="course-grid">
      <div class="course-item">
        <h3>Course 1</h3>
        <form method="post" action="save_course.php">
          <input type="hidden" name="course_id" value="<?php echo $courseId; ?>">
          <input type="hidden" name="course_title" value="<?php echo htmlspecialchars($courseTitle); ?>">
          <input type="hidden" name="sub_course" value="1">
          <button type="submit">Start Course</button>
        </form>
      </div>
      <div class="course-divider-horizontal"></div>
      <div class="course-item">
        <h3>Course 2</h3>
        <form method="post" action="save_course.php">
          <input type="hidden" name="course_id" value="<?php echo $courseId; ?>">
          <input type="hidden" name="course_title" value="<?php echo htmlspecialchars($courseTitle); ?>">
          <input type="hidden" name="sub_course" value="2">
          <button type="submit">Start Course</button>
        </form>
      </div>
      <div class="course-divider-horizontal"></div>
      <div class="course-item">
        <h3>Course 3</h3>
        <form method="post" action="save_course.php">
          <input type="hidden" name="course_id" value="<?php echo $courseId; ?>">
          <input type="hidden" name="course_title" value="<?php echo htmlspecialchars($courseTitle); ?>">
          <input type="hidden" name="sub_course" value="3">
          <button type="submit">Start Course</button>
        </form>
      </div>
    </div>
  </div>
</div>
