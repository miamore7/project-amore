<?php
include('user.php');

if ($_POST['submitRegister'] == 'Register') {
    $user = new User($_POST['fullName'], $_POST['phoneNumber'], $_POST['email'], $_POST['password']);
    if ($user != null) {
        $user->tambah();
        header('Location:registrasi.php?pesan=Registrasi Telah Berhasil!');
    } else {
        header('Location:register.php?pesan=Nama Lengkap atau Email Sudah Ada!');
    }
}