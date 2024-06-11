<?php
session_start();
include('dbConnection.php');

if (isset($_POST['comment'], $_POST['idCourse'], $_POST['idUser'])) {
    $comment = $_POST['comment'];
    $idCourse = $_POST['idCourse'];
    $idUser = $_POST['idUser'];

    $stmt = $conn->prepare("INSERT INTO feedback (komen, idUser, idCourse) VALUES (:komen, :idUser, :idCourse)");
    $stmt->bindValue(':komen', $comment);
    $stmt->bindValue(':idUser', $idUser);
    $stmt->bindValue(':idCourse', $idCourse);

    if ($stmt->execute()) {
        echo 'Success';
    } else {
        echo 'Error: ' . $stmt->errorInfo()[2];
    }
}

$conn = null; // Tutup koneksi
?>
