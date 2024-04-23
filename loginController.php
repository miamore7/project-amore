<?php
require_once('User.php');

if (isset($_POST['submitLogin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User(null, null, null,null);

    if ($email != null && $password != null) {
        $data = $user->auth($email, $password);

        if ($data != null) {
            if ($data['email'] == 'admin@admin') {
                header('Location: dashboardA.php');
            } else {
                header('Location: dashboardM.php');
            }
        } else {
            header('Location: login.php?pesan=email atau password salah');
        }
    }
}
?>
