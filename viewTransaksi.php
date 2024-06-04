<?php
include('sidebarAdmin.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "amoredb";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if an update request has been made
    if (isset($_POST['update_status']) && isset($_POST['transaction_id'])) {
        $id = $_POST['transaction_id'];
        $status = $_POST['status'];

        // Update query to change the status
        $sql = "UPDATE transaksi SET status = :status WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Status updated successfully.";
        } else {
            echo "Failed to update status.";
        }
    }

    // Query untuk mengambil data transaksi dengan informasi pembeli dan barang
    $stmt = $conn->prepare("
        SELECT t.id, t.status, p.nama_barang, p.harga, p.gambar, u.fullName 
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manajemen Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: row;
            min-height: 100vh;
        }
        /* .sidebar {
            width: 250px; /* Adjust the width as needed */
            background-color: #2c3e50;
            padding: 20px;
            color: white;
            position: fixed;
            height: 100vh;
        } */
        .main-content {
            margin-left: 250px; /* This should be equal to the sidebar width */
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
            margin-bottom: 20px;
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
        .status-accepted {
            background-color: #8e44ad;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
        }
        .status-rejected {
            background-color: #e74c3c;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
        }
        .status-pending {
            background-color: #f39c12;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
        }
        img {
            max-width: 100px;
        }
        .btn-update {
            background-color: #3498db;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
            text-decoration: none;
            margin-top: 10px;
            border: none;
            cursor: pointer;
        }
        .status-dropdown {
            padding: 8px;
            border-radius: 5px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="main-content">
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
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transaksi as $trans) : ?>
                    <tr>
                        <td><?= htmlspecialchars($trans['id']) ?></td>
                        <td><?= htmlspecialchars($trans['nama_barang']) ?></td>
                        <td><?= number_format($trans['harga'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($trans['fullName']) ?></td>
                        <td>
                            <?php if ($trans['status'] == 'accepted') : ?>
                                <span class="status-accepted">Accepted</span>
                            <?php elseif ($trans['status'] == 'rejected') : ?>
                                <span class="status-rejected">Rejected</span>
                            <?php else : ?>
                                <span class="status-pending">Pending</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="transaction_id" value="<?= $trans['id'] ?>">
                                <select name="status" class="status-dropdown">
                                    <option value="Pending"<?= $trans['status'] == 'Pending' ? ' selected' : '' ?>>Pending</option>
                                    <option value="Accepted"<?= $trans['status'] == 'Accepted' ? ' selected' : '' ?>>Accepted</option>
                                </select>
                                <button type="submit" name="update_status" class="btn-update">Update</button>
                            </form>
                        </td>
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

<?php
$conn = null;
?>
