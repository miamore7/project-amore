<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Directory for file uploads
    $target_dir = "uploads/";

    // Check if the directory exists, if not, create it
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); // Create the directory recursively
    }

    // Database connection
    $servername = "localhost";
    $username = "root"; // Change as necessary
    $password = ""; // Change as necessary
    $dbname = "amoredb";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Handle file upload
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO pasar (nama_barang, harga, gambar, jenis_course) VALUES (:nama_barang, :harga, :gambar, :jenis_course)");
            $stmt->bindParam(':nama_barang', $nama_barang);
            $stmt->bindParam(':harga', $harga);
            $stmt->bindParam(':gambar', $gambar);
            $stmt->bindParam(':jenis_course', $jenis_course);

            // Set parameters and execute
            $nama_barang = $_POST['nama_barang'];
            $harga = $_POST['harga'];
            $gambar = $target_file; // Save file path to database
            $jenis_course = $_POST['jenis_course'];

            if ($stmt->execute()) {
                // Redirect to pasarAdmin.php after successful insertion
                header("Location: pasarAdmin.php");
                exit(); // Ensure no further code is executed
            } else {
                echo "Error: " . $stmt->errorInfo()[2];
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

        // Close the connection
        $conn = null;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

?>
<?php include('sidebarAdmin.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="css/tambahBarang.css">
</head>
<body>
    <div class="form-container">
        <h2>Tambah Barang</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" id="nama_barang" name="nama_barang" required>

            <label for="harga">Harga:</label>
            <input type="number" step="0.01" id="harga" name="harga" required>

            <label for="gambar">Gambar:</label>
            <input type="file" id="gambar" name="gambar" required>

            <label for="jenis_course">Jenis Course:</label>
            <input type="text" id="jenis_course" name="jenis_course" value="<?php echo $_GET['jenis_course']; ?>" readonly>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
