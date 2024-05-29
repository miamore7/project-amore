<?php
include('sidebarAdmin.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "amoredb";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query untuk mengambil data transaksi dengan informasi pembeli dan barang
    $stmt = $conn->prepare("
        SELECT t.id, p.nama_barang, p.harga, u.fullName
        FROM transaksi t
        JOIN pasar p ON t.id_barang = p.id
        JOIN user u ON t.id_user = u.idUser
    ");
    $stmt->execute();
    $transaksi = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
        }
        .main-content {
    margin: 0 auto; /* This centers the content horizontally */
    padding: 20px;
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        p {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Riwayat Transaksi</h2>
        <div class="table-container">
            <?php if (!empty($transaksi)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Nama Pembeli</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transaksi as $trans) : ?>
                    <tr>
                        <td><?= htmlspecialchars($trans['id']) ?></td>
                        <td><?= htmlspecialchars($trans['nama_barang']) ?></td>
                        <td><?= number_format($trans['harga'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($trans['fullName']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else : ?>
            <p>Belum ada transaksi</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>