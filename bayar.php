<?php
// Include sidebar and initialize session
include('sidebar.php');

// Check if the user is not logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to login page
    header("Location: login.php");
    exit();
}

// Initialize message variable
$message = "";

// Check if the "Start" button has been pressed
if (isset($_POST['start_subscribe'])) {
    // Connect to the database
    
    require('dbConnection.php');

    // Get the user ID from the session
    $user_id = $_SESSION['user']['idUser'];

    // Update the user's status
    $sql = "UPDATE user SET status = 1 WHERE idUser = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    if ($stmt->execute()) {
        // Save success message
        $message = "Status berhasil diubah.";
    } else {
        // Save error message
        $message = "Terjadi kesalahan saat mengubah status.";
    }

    // Redirect to prevent form resubmission
    $_SESSION['message'] = $message;
    header("Location: bayar.php");
    exit();
}

// Check if the "Cancel" button has been pressed
if (isset($_POST['cancel_subscribe'])) {
    // Perform cancel subscription logic here
    // For example, redirect to a different page or show a message
    $message = "Subscription has been cancelled.";

    // Redirect to prevent form resubmission
    $_SESSION['message'] = $message;
    header("Location: bayar.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Subscription Page</title>
    <link rel="stylesheet" href="css/bayar.css">
</head>
<body>
    <div class="container">
        <h2>Start Subscribe</h2>
        <?php
        // Display notification message if exists
        if (isset($_SESSION['message'])) {
            echo "<p>{$_SESSION['message']}</p>";
            // Remove message from session after displaying
            unset($_SESSION['message']);
        }
        ?>
        <p>Billed</p>
        <p>Payment Information</p>
        <div class="subscribe-section">
            <h3>Subscribe</h3>
            <div class="date-range">
                <span class="date">04 December 2024</span>
                <span class="arrow">→</span>
                <span class="date">04 December 2025</span>
            </div>
            <div class="product-info">
                <span>Rincian Harga</span>
            </div>
            <div class="total">
                <span>Total</span>
                <span class="total-price">$49.99</span>
            </div>
            <div class="button-group">
                <form method="post" action="bayar.php">
                    <button type="submit" class="cancel-btn" name="cancel_subscribe">Cancel</button>
                    <button type="submit" class="subsBtn" name="start_subscribe">Start</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
