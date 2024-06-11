<?php 
// session_start(); // Memulai sesi di awal skrip

// Memeriksa apakah pengguna sudah login
if (isset($_SESSION['email'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Menghentikan eksekusi skrip lebih lanjut
}

include('sidebarM.php'); 

// Sambungkan ke database
include('dbConnection.php');

// Tangkap judul dari URL query string
$courseTitle = isset($_GET['title']) ? $_GET['title'] : '';
$courseId = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

// Kueri untuk mengambil sub course dari tabel course berdasarkan nama course
$stmt = $conn->prepare("SELECT sub_course FROM course WHERE nama_course = :courseTitle");
$stmt->bindValue(':courseTitle', $courseTitle);
$stmt->execute();
$subCourses = $stmt->fetchAll(PDO::FETCH_COLUMN);

$conn = null; // Tutup koneksi
?>
<link rel="stylesheet" href="css/courseMenu.css">
<div class="top-courses">
  <div class="course-content">
    <h2><?php echo htmlspecialchars($courseTitle); ?></h2>
    <div class="course-grid">
      <?php foreach ($subCourses as $subCourse): ?>
      <div class="course-item">
        <h3><?php echo " $subCourse"; ?></h3>
        <form method="post" action="saveCourse.php">
          <input type="hidden" name="course_id" value="<?php echo $courseId; ?>">
          <input type="hidden" name="course_title" value="<?php echo htmlspecialchars($courseTitle); ?>">
          <input type="hidden" name="sub_course" value="<?php echo $subCourse; ?>">
          <a href="CourseDetailsMentor.php?title=<?php echo urlencode($courseTitle); ?>&sub_course=<?php echo urlencode($subCourse); ?>"> 
            <button type="button">Start Course</button>
          </a>
        </form>
      </div>
      <div class="course-divider-horizontal"></div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
