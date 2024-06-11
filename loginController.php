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
            // Autentikasi berhasil, simpan email ke dalam session
            // $_SESSION['email'] = $email;
            $_SESSION['user']=$data;
            if ($data['email'] == 'admin@admin') {
                header('Location: dashboardA.php');
             } if ($data['email'] == 'mentor@mentor') {
                    header('Location: dashboardMentor.php');
            } else {
                header('Location: dashboardM.php');
            }
        } else {
            header('Location: login.php?pesan=email atau password salah');
        }
    }
}

?>
