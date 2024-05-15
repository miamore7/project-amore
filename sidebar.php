<?php
// Mulai sesi di awal file
session_start();
include('user.php'); // Pastikan ini adalah file yang benar dan diperlukan
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar</title>
  <link rel="stylesheet" href="css/sidebar.css">
</head>

<body>
  <div class="sidebar">
    <div class="brand">
      <a href="index.php">Amore</a>
      <h4>Halo, <strong></strong></h4>
    </div>
    <nav>
      <ul>
        <li><a href="dashboardM.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="#"><i class="fas fa-shopping-cart"></i> Pasar</a></li>
        <li><a href="course.php"><i class="fas fa-book"></i> Course</a></li>
        <li><a href="#"><i class="fas fa-comments"></i> Forum</a></li>
      </ul>
    </nav>
    <div class="others">
      <ul>
        <li><a href="subscribe.php"><i class="fas fa-user-plus"></i> Subscribe</a></li>
        <li><a href="#"><i class="fas fa-user"></i> Profile</a></li>
        <li><a href="logout.php"><i class="fas fa-user"></i> Log Out</a></li>
      </ul>
    </div>
  </div>
</body>

</html>
