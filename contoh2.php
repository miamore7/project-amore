<?php
// session_start(); // Memulai sesi di awal skrip

// Memeriksa apakah pengguna sudah login
if (isset($_SESSION['email'])) {
    header("Location: login.php");
    exit(); // Menghentikan eksekusi skrip lebih lanjut
}

$servername = "localhost";
$username = "root"; // Ubah sesuai kebutuhan
$password = ""; // Ubah sesuai kebutuhan
$dbname = "amoredb"; // Ubah sesuai kebutuhan

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['jenis_course'])) {
        $jenis_course = $_GET['jenis_course'];

        // Ambil data dari database berdasarkan jenis_course
        $stmt = $conn->prepare("SELECT * FROM pasar WHERE jenis_course = :jenis_course");
        $stmt->bindParam(':jenis_course', $jenis_course);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            $id = $_POST['id'];

            if ($action == 'delete') {
                // Kode untuk delete
                $stmt = $conn->prepare("DELETE FROM pasar WHERE id=:id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                header("Location: " . $_SERVER['PHP_SELF'] . "?jenis_course=" . $jenis_course);
                exit();
            } elseif ($action == 'update') {
                // Kode untuk update
                $nama_barang = $_POST['nama_barang'];
                $harga = $_POST['harga'];
                $gambar_lama = $_POST['gambar_lama'];

                // Handle file upload
                if (isset($_FILES['gambar']['name']) && $_FILES['gambar']['name'] != '') {
                    $target_dir = "uploads/";
                    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
                    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                        $gambar = $target_file;
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                        $gambar = $gambar_lama; // Use the old image if upload fails
                    }
                } else {
                    $gambar = $gambar_lama; // Use the old image if no new file is uploaded
                }

                $stmt = $conn->prepare("UPDATE pasar SET nama_barang=:nama_barang, harga=:harga, gambar=:gambar WHERE id=:id");
                $stmt->bindParam(':nama_barang', $nama_barang);
                $stmt->bindParam(':harga', $harga);
                $stmt->bindParam(':gambar', $gambar);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                header("Location: " . $_SERVER['PHP_SELF'] . "?jenis_course=" . $jenis_course);
                exit();
            }
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<?php include('sidebarAdmin.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pasar</title>
    <link rel="stylesheet" href="css/contoh2.css">
</head>
<body>
    <?php if (!empty($result)) : ?>
        <table class="course-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) : ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                        <td><?= htmlspecialchars($row['harga']) ?></td>
                        <td><img src="<?= htmlspecialchars($row['gambar']) ?>" style="width:100px;height:100px;"></td>
                        <td>
                            <button type="button" class="update-btn" onclick="showUpdateForm(<?= $row['id'] ?>)">Update</button>
                        </td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <tr id="update-form-<?= $row['id'] ?>" class="update-form" style="display: none;">
                        <td colspan="6">
                            <form method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="gambar_lama" value="<?= htmlspecialchars($row['gambar']) ?>">
                                <label for="nama_barang"> Nama Barang:</label>
                                <input type="text" name="nama_barang" value="<?= htmlspecialchars($row['nama_barang']) ?>" required>
                                <label for="harga">Harga:</label>
                                <input type="number" name="harga" value="<?= htmlspecialchars($row['harga']) ?>" required>
                                <label for="gambar">Image:</label>
                                <input type="file" name="gambar">
                                <button type="submit" class="update-btn">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>belum ada barang wkwkw</p>
    <?php endif; ?>
    <script>
        function showUpdateForm(id) {
            var form = document.getElementById('update-form-' + id);
            if (form.style.display === 'none') {
                form.style.display = 'table-row';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
</body>
</html>
