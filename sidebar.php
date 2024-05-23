<?php
session_start();
$fullName = ($_SESSION['user']['fullName']);
?>
    <link rel="stylesheet" href="css/sidebar.css">
<div class="sidebar">
 <div class="brand">
   <a href="index.php">Amore</a>
   <h4>Halo, <?php echo htmlspecialchars($fullName); ?></h4>
 </div>
 <nav>
   <ul>
     <li><a href="dashboardM.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
     <li><a href="#"><i class="fas fa-shopping-cart"></i> Pasar</a></li>
     <li><a href="course.php"><i class="fas fa-book"></i> Course</a></li>
     <li><a href="pilihForum.php"><i class="fas fa-comments"></i> Forum</a></li>
   </ul>
 </nav>
 <div class="others">
   <ul>
     <li><a href="subscribe.php"><i class="fas fa-user-plus"></i> Subscribe</a></li>
     <li><a href="profileManagement.php"><i class="fas fa-user"></i> Profile</a></li>
     <li><a href="logout.php"><i class="fas fa-user"></i> Log Out</a></li>
   </ul>
 </div>
</div>