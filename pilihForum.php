<?php
include('sidebar.php');
require('dbConnection.php'); // Include the database connection file

// Check if POST request has been sent
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nama"])) {
    // Handle request to retrieve forum data based on name
    $nama = $_POST["nama"];

    // Redirect to forum.php and pass the forum name as a parameter
    header("Location: forum.php?nama=" . urlencode($nama));
    exit();
}
?>

<link rel="stylesheet" href="css/dashboardM.css">
<div class="top-courses">
    <div class="course-grid">
        <div class="course-item">
            <img src="img/ui.jpeg" alt="Learn Figma: UI/UX Design Essential Training">
            <h3>Learn Figma: UI/UX Design Essential Training</h3>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="nama" value="Learn Figma: UI/UX Design Essential Training">
                <button type="submit">Start Forum</button>
            </form>
        </div>
        <div class="course-item">
            <img src="img/Code.jpeg" alt="Python For Beginners - Learn Programming">
            <h3>Python For Beginners - Learn Programming</h3>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="nama" value="Python For Beginners - Learn Programming">
                <button type="submit">Start Forum</button>
            </form>
        </div>
        <div class="course-item">
            <img src="img/Gitar.jpeg" alt="Acoustic Guitar And Electric Guitar Started">
            <h3>Acoustic Guitar And Electric Guitar Started</h3>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="nama" value="Acoustic Guitar And Electric Guitar Started">
                <button type="submit">Start Forum</button>
            </form>
        </div>
    </div>
</div>
