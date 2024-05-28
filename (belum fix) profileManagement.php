<?php
session_start();
require_once('dbConnection.php');

// Periksa apakah pengguna telah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

// Ambil informasi pengguna dari database
$idUser = $user['idUser'];

try {
    // Siapkan statement untuk mengambil informasi pengguna
    $stmt = $conn->prepare("SELECT * FROM user WHERE idUser = :idUser");
    $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
    $stmt->execute();

    // Ambil hasilnya
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Management</title>
    <link rel="stylesheet" href="css/profileManagement.css">
</head>
<body>
    <?php include('sidebar.php'); ?>
    <div class="main-content">
        <div class="profile-container">
            <div class="profile">
                <h2>Profile</h2>
                <p>Name: <?php echo htmlspecialchars($userData['fullName']); ?></p>
                <p>Phone Number: <?php echo htmlspecialchars($userData['phoneNumber']); ?></p>
                <p>Email: <?php echo htmlspecialchars($userData['email']); ?></p>
                <p>Password: <?php echo htmlspecialchars($userData['password']); ?></p>
                <p>Status: <?php echo htmlspecialchars($userData['status']); ?></p>
                <p>Role: <?php echo htmlspecialchars($userData['role']); ?></p>
            </div>
            <div class="profile-edit">
                <h2>Edit Profile</h2>
                <form action="profileManagementController.php" method="POST">
                    <input type="hidden" name="idUser" value="<?php echo htmlspecialchars($userData['idUser']); ?>">
                    <div>
                        <label for="fullName">Name</label>
                        <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($userData['fullName']); ?>" required>
                    </div>
                    <div>
                        <label for="phoneNumber">Phone Number</label>
                        <input type="text" id="phoneNumber" name="phoneNumber" value="<?php echo htmlspecialchars($userData['phoneNumber']); ?>" required>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($userData['password']); ?>" required>
                    </div>
                    <div>
                        <input type="submit" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
