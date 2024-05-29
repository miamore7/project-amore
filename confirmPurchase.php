<?php
// session_start();
include('sidebar.php');
if (isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id_barang'])) {
    echo "ID barang tidak ditemukan.";
    exit();
}

$id_barang = $_GET['id_barang'];
$id_user = $_SESSION['user']['idUser'];
$fullName = $_SESSION['user']['fullName'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "amoredb";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM pasar WHERE id = :id");
    $stmt->bindParam(':id', $id_barang);
    $stmt->execute();

    $barang = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$barang) {
        echo "Barang tidak ditemukan.";
        exit();
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Proses penyimpanan transaksi saat tombol konfirmasi ditekan
if (isset($_POST['konfirmasi'])) {
    try {
        // Lakukan penyimpanan transaksi
        // Misalnya:
        $stmt = $conn->prepare("INSERT INTO transaksi (id_barang, id_user) VALUES (:id_barang, :id_user)");
        $stmt->bindParam(':id_barang', $id_barang);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();

        // Notifikasi transaksi berhasil
        $message = "Transaksi berhasil!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembelian</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Gaya untuk body */
        body {
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            display: flex;
        }

        /* Gaya untuk sidebar */
        .sidebar {
            width: 200px;
            /* background-color: #e0e7ff; */
            padding: 20px;
            height: 100vh; /* Full height */
            position: fixed;
            top: 0;
            left: 0;
        }

        /* Gaya untuk container utama */
        .main-content {
            margin-left: 220px; /* Sesuaikan dengan lebar sidebar */
            padding: 20px;
            flex: 1;
        }

        /* Gaya untuk judul */
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Gaya untuk container konfirmasi pembelian */
        .receipt {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px; /* Sesuaikan lebar maksimal */
            margin: 20px auto;
            text-align: left;
        }

        /* Gaya untuk heading dalam receipt */
        .receipt h3 {
            margin-bottom: 10px;
            color: #333;
        }

        /* Gaya untuk paragraf dalam receipt */
        .receipt p {
            margin-bottom: 10px;
        }

        /* Gaya untuk tombol konfirmasi */
        button {
            display: block;
            width: 100%;
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <h3>Detail Barang</h3>
        <p>Nama Barang: <?= htmlspecialchars($barang['nama_barang']) ?></p>
        <p>Harga: <?= number_format(htmlspecialchars($barang['harga']), 0, ',', '.') ?></p>
        <h3>Detail Pembeli</h3>
        <p>Nama Pembeli: <?= htmlspecialchars($fullName) ?></p>
        <form method="POST">
            <input type="hidden" name="id_barang" value="<?= htmlspecialchars($barang['id']) ?>">
            <input type="hidden" name="id_user" value="<?= htmlspecialchars($id_user) ?>">
            <button type="submit" name="konfirmasi">Konfirmasi</button>
        </form>
    </div>

    <!-- Script untuk menampilkan notifikasi dan redirect ke pasarUser.php -->
    <script>
    // Ambil pesan notifikasi dari PHP jika ada
    var message = "<?php echo isset($message) ? $message : '' ?>";

    // Jika pesan notifikasi ada, tampilkan notifikasi
    if (message) {
        alert(message);
        // Redirect ke halaman pasarUser.php setelah menampilkan pesan
        window.location.href = 'pasarUser.php';
    }
    </script>
</body>
</html>
