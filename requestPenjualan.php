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
    if (isset($_POST['update_status']) && isset($_POST['id'])) {
        $id = $_POST['id'];
        $status = $_POST['status'];

        // Update query to change the status
        $sql = "UPDATE pasar SET status = :status WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $message = "Status updated successfully.";
        } else {
            $message = "Failed to update status.";
        }
    }

    // Query to retrieve data from `pasar` table
    $stmt = $conn->prepare("SELECT id, nama_barang, harga, gambar, jenis_course, idUser, status FROM pasar");
    $stmt->execute();
    $pasarData = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Request Penjualan</title>
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
        .container {
            display: flex;
            width: 100%;
        }
        .main-content {
            margin: 0 auto;
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
        .message {
            text-align: center;
            margin-bottom: 20px;
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-content">
            <h2>Request Penjualan</h2>
            <?php if (isset($message)) : ?>
                <div class="message"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>
            <div class="table-container">
                <?php if (!empty($pasarData)) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Jenis Course</th>
                            <th>ID User</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pasarData as $item) : ?>
                        <tr>
                            <td><?= htmlspecialchars($item['id']) ?></td>
                            <td><?= htmlspecialchars($item['nama_barang']) ?></td>
                            <td><?= number_format($item['harga'], 0, ',', '.') ?></td>
                            <td>
                                <?php if (!empty($item['gambar'])) : ?>
                                    <img src="<?= htmlspecialchars($item['gambar']) ?>" alt="<?= htmlspecialchars($item['nama_barang']) ?>">
                                <?php else : ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($item['jenis_course']) ?></td>
                            <td><?= htmlspecialchars($item['idUser']) ?></td>
                            <td>
                                <?php if ($item['status'] == 'Accepted') : ?>
                                    <span class="status-accepted">Accepted</span>
                                <?php elseif ($item['status'] == 'Rejected') : ?>
                                    <span class="status-rejected">Rejected</span>
                                <?php else : ?>
                                    <span class="status-pending">Pending</span>
                                <?php endif; ?> 
                            </td>
                            <td>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <select name="status" class="status-dropdown">
                                        <option value="Rejected"<?= $item['status'] == 'Rejected' ? ' selected' : '' ?>>Rejected</option>
                                        <option value="Accepted"<?= $item['status'] == 'Accepted' ? ' selected' : '' ?>>Accepted</option>
                                    </select>
                                    <button type="submit" name="update_status" class="btn-update">Update</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else : ?>
                <p>Belum ada request penjualan</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php
$conn = null;
?>
