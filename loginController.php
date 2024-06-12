<?php
session_start();
require_once('User.php');

if (isset($_POST['submitLogin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User(null, null, null, null);

    if ($email != null && $password != null) {
        $data = $user->auth($email, $password);

        if ($data != null) {
            // Autentikasi berhasil, simpan data pengguna ke dalam sesi
            $_SESSION['user'] = $data;
        
            // Cek email pengguna untuk menentukan halaman dashboard yang sesuai
            if ($data['email'] == 'admin@admin') {
                header('Location: dashboardA.php');
                exit(); // Pastikan menghentikan eksekusi skrip setelah header redirection
            } elseif ($data['email'] == 'mentor@mentor') {
                header('Location: dashboardMentor.php');
                exit(); // Pastikan menghentikan eksekusi skrip setelah header redirection
            } else {
                header('Location: dashboardM.php');
                exit(); // Pastikan menghentikan eksekusi skrip setelah header redirection
            }
        } else {
            header('Location: login.php?pesan=email atau password salah');
            exit(); // Pastikan menghentikan eksekusi skrip setelah header redirection
        }
        
    }
}

?>
