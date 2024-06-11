<?php
session_start();
$idUser = ($_SESSION['user']['idUser']);
$fullName = ($_SESSION['user']['fullName']);
?>
    <link rel="stylesheet" href="css/sidebar.css">
<div class="sidebar">
 <div class="brand">
   <a href="index.php">Amore</a>
 </div>
 <nav>
   <ul>
     <li><a href="dashboardMentor.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
     <li><a href="courseMentor.php"><i class="fas fa-book"></i> Course</a></li>
   </ul>
 </nav>
 <div class="others">
   <ul>
     <li><a href="logout.php"><i class="fas fa-user"></i> Log Out</a></li>
   </ul>
 </div>
</div>