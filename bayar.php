<?php
// Mulai sesi
session_start();

// Memeriksa apakah pengguna sudah login
if (isset($_SESSION['user_id'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Menghentikan eksekusi skrip lebih lanjut
}

// Proses login pengguna
if (isset($_POST['login'])) {
    // Di sini Anda dapat memeriksa kredensial pengguna dan mengambil ID pengguna dari database
    // Misalnya, jika proses login berhasil dan Anda memiliki ID pengguna, Anda dapat menetapkan ID pengguna ke dalam sesi
    $user_id = 123; // Ganti dengan ID pengguna yang sesuai setelah login berhasil
    $_SESSION['user_id'] = $user_id;
}

include('sidebar.php');

// Memeriksa apakah tombol "Start" telah ditekan
if (isset($_POST['start_subscribe'])) {
    // Pastikan Anda telah login dan memiliki ID pengguna yang valid dalam sesi
    if (isset($_SESSION['user_id'])) {
        // Sambungkan ke database
        require('dbConnection.php');

        // Ambil ID pengguna dari session
        $user_id = $_SESSION['user_id'];

        // Perbarui status pengguna
        $sql = "UPDATE users SET status = 1 WHERE id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }
}
?>
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
