<?php
session_start(); // Memulai sesi di awal skrip

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Menghentikan eksekusi skrip lebih lanjut
}

include('sidebar.php');
?>

<div>
    <h1 style="padding: 10px 10px 10px 50px">
        Learn from experts
    </h1>
    <h1 style="padding: 10px 10px 10px 50px">
        Grow your hobby
    </h1>
    <h3 style="padding: 10px 10px 10px 50px">Free accses to all course</h3>
    <div class="subsBtn">
        <a href="bayar.php">Subscribe</a>
    </div>
    <h4 style="padding: 10px 10px 0px 30px">About Us</h4>
    <p style="padding: 0px 10px 10px 30px; margin: 0px 150px 0px 0px;">Vue (pronounced /vjuː/, like view) is a progressive framework for building user interfaces. Unlike other monolithic frameworks, Vue is designed from the ground up to be incrementally adoptable. The core library is focused on the view layer only, and is easy to pick up and integrate with other libraries or existing projects. On the other hand, Vue is also perfectly capable of powering sophisticated Single-Page Applications when used in combination with modern tooling and supporting libraries.</p>
</div>

<div>
    <img class="recomImg" src="img/Code.jpeg">
    <h4 style="margin: 0px 0px 0px 100px;">Python For Beginners - Learn Programming</h5>
</div>