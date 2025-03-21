<?php
// session_start(); // Memulai sesi di awal skrip

// Memeriksa apakah pengguna sudah login
if (isset($_SESSION['email'])) {
  // Jika pengguna belum login, arahkan ke halaman login
  header("Location: login.php");
  exit(); // Menghentikan eksekusi skrip lebih lanjut
}

include('sidebar.php');

// $fullName = ($_SESSION['user']['fullName']);
// var_dump($fullName);
?>
<link rel="stylesheet" href="css/dashboardM.css">
<div class="top-courses">
  <h2>TOP COURSES</h2>
  <div class="course-grid">
    <div class="course-item">
      <img src="img/ui.jpeg" alt="Learn Figma: UI/UX Design Essential Training">
      <h3>Learn Figma: UI/UX Design Essential Training</h3>
      <a href="course.php"><button>Start Course</button></a>
    </div>
    <div class="course-item">
      <img src="img/Code.jpeg" alt="Python For Beginners - Learn Programming">
      <h3>Python For Beginners - Learn Programming</h3>
      <a href="course.php"><button>Start Course</button></a>
    </div>
    <div class="course-item">
      <img src="img/Gitar.jpeg" alt="Acoustic Guitar And Electric Guitar Started">
      <h3>Acoustic Guitar And Electric Guitar Started</h3>
      <a href="course.php"><button>Start Course</button></a>
    </div>
  </div>
</div>