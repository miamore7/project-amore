<?php
include('sidebar.php');
include('dbConnection.php');

// Ensure user ID is set in the session
if (!isset($_SESSION['user']['idUser'])) {
    die("User ID is not set in the session.");
}

$idUser = $_SESSION['user']['idUser'];

// Query to fetch data based on user ID
$sql = "SELECT t.id, t.status, p.nama_barang, p.harga, p.gambar, u.fullName, u.email 
        FROM transaksi t
        JOIN pasar p ON t.id_barang = p.id
        JOIN user u ON t.id_user = u.idUser
        WHERE t.id_user = :user_id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $idUser, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            text-align: left;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f5f5f5;
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
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Status</th>
        </tr>
        <?php
        if (count($result) > 0) {
            // Output data for each row
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["nama_barang"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["harga"]) . "</td>";
                echo "<td>";
                if (!empty($row["gambar"])) {
                    echo "<img src='" . htmlspecialchars($row["gambar"]) . "' alt='" . htmlspecialchars($row["nama_barang"]) . "'>";
                } else {
                    echo "-";
                }
                echo "</td>";
                echo "<td>";
                if ($row["status"] == 'accepted') {
                    echo "<span class='status-accepted'>Accepted</span>";
                } elseif ($row["status"] == 'rejected') {
                    echo "<span class='status-rejected'>Rejected</span>";
                } else {
                    echo "<span class='status-pending'>Pending</span>";
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn = null;
?>
