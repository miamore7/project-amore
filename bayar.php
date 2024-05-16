<?php
include('sidebar.php');
// Memeriksa apakah pengguna sudah login
if (isset($_SESSION['user_id'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Menghentikan eksekusi skrip lebih lanjut
}

// Memeriksa apakah tombol "Start" telah ditekan
if (isset($_POST['start_subscribe'])) {
    // Ensure you are logged in and have a valid user ID in the session
    if (isset($_SESSION['user_id'])) {
        // Connect to the database
        require('dbConnection.php');

        // Get the user ID from the session
        $user_id = $_SESSION['user_id'];

        // Update the user's status
        $sql = "UPDATE user SET status = 1 WHERE idUser = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        if ($stmt->execute()) {
            // Save success message in session
            $_SESSION['message'] = "Status berhasil diubah.";
        } else {
            // Save error message in session
            $_SESSION['message'] = "Terjadi kesalahan saat mengubah status.";
        }
    }
    // Redirect to prevent form resubmission
    header("Location: subscribe.php");
    exit();
}

// Check if the "Cancel" button has been pressed
if (isset($_POST['cancel_subscribe'])) {
    // Perform cancel subscription logic here
    // For example, redirect to a different page or show a message
    $_SESSION['message'] = "Subscription has been cancelled.";
    header("Location: subscribe.php");
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
                <form method="post">
                    <button class="cancel-btn" name="cancel_subscribe">Cancel</button>
                    <div class="subsBtn">
    <a href="subsController.php">Start</a>
</div>

                </form>
            </div>
        </div>
    </div>
</body>
