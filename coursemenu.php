<?php 
include('sidebar.php'); 

// Memeriksa apakah pengguna sudah login

if (isset($_SESSION['email'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Menghentikan eksekusi skrip lebih lanjut
}

// Memeriksa status pengguna
$userStatus = $_SESSION['user']['status']; // Gantilah 'user_status' dengan nama variabel status pengguna Anda
if ($userStatus != 1) {
    // Jika status pengguna bukan 1, arahkan kembali ke halaman kursus
    header("Location: course.php");
    exit();
}

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
<link rel="stylesheet" href="css/coursemenu.css">
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
          <a href="courseDetailsUser.php?title=<?php echo urlencode($courseTitle); ?>&sub_course=<?php echo urlencode($subCourse); ?>"> 
    <button type="button">Start Course</button>
</a>

        </form>
      </div>
      <div class="course-divider-horizontal"></div>
      <?php endforeach; ?>
    </div>
  </div>

</div>
