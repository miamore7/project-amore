<?php
// session_start();

if (isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "amoredb";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['jenis_course'])) {
        $jenis_course = $_GET['jenis_course'];

        $stmt = $conn->prepare("SELECT * FROM pasar WHERE jenis_course = :jenis_course");
        $stmt->bindParam(':jenis_course', $jenis_course);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

include('sidebar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pasar</title>
    <!-- <link rel="stylesheet" href="css/contoh2.css"> -->
</head>
<body>
    <div class="product-container">
        <?php if (!empty($result)) : ?>
            <?php foreach ($result as $row) : ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama_barang']) ?>">
                    <h3><?= number_format(htmlspecialchars($row['harga']), 0, ',', '.') ?></h3>
                    <p><?= htmlspecialchars($row['nama_barang']) ?></p>
                    <form method="GET" action="confirmPurchase.php">
                        <input type="hidden" name="id_barang" value="<?= htmlspecialchars($row['id']) ?>">
                        <button type="submit" name="beli">Beli</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Belum ada barang</p>
        <?php endif; ?>
    </div>
</body>
<style>
        .product-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        .product-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            text-align: center;
            margin: 20px;
        }
        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .product-card h3, .product-card p {
            margin: 10px 0;
        }
        .product-card button {
            background-color: #28a745;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 0;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</html>
