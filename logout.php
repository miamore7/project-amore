<?php
// Hapus semua variabel sesi
$_SESSION = array();

// Jika diinginkan untuk menghapus sesi, hapus juga cookie sesi
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Akhir sesi
session_destroy();

// Arahkan pengguna ke halaman login atau halaman lain
header("Location: login.php");
exit;
?>
