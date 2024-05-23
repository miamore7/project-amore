<?php
require_once('dbConnection.php');

// Periksa apakah pengguna telah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Ambil data dari form
$idUser = $_POST['idUser'];
$fullName = $_POST['fullName'];
$phoneNumber = $_POST['phoneNumber'];
$email = $_POST['email'];
$password = $_POST['password'];

try {
    // Siapkan statement untuk memperbarui informasi pengguna
    $stmt = $conn->prepare("UPDATE user SET fullName = :fullName, phoneNumber = :phoneNumber, email = :email, password = :password WHERE idUser = :idUser");
    $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
    $stmt->bindParam(':fullName', $fullName, PDO::PARAM_STR);
    $stmt->bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();

    // Perbarui data di session
    $_SESSION['user']['fullName'] = $fullName;
    $_SESSION['user']['email'] = $email;

    header("Location: profileManagement.php");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
