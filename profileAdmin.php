<?php
// Include the sidebar which starts the session and fetch user data
include 'sidebarAdmin.php';

// Connect to the database
include('dbConnection.php');

// Fetch user data based on session
$fullName = $_SESSION['user']['fullName'];
$query = "SELECT idUser, fullName, phoneNumber, email, password, status FROM user WHERE fullName = :fullName";
$stmt = $conn->prepare($query);
$stmt->bindParam(":fullName", $fullName);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle form submission to update profile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newFullName = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $updateQuery = "UPDATE user SET fullName = :newFullName, phoneNumber = :phone, email = :email, password = :password WHERE idUser = :idUser";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bindParam(":newFullName", $newFullName);
    $updateStmt->bindParam(":phone", $phone);
    $updateStmt->bindParam(":email", $email);
    $updateStmt->bindParam(":password", $password);
    $updateStmt->bindParam(":idUser", $user['idUser']);
    $updateStmt->execute();

    // Update session data
    $_SESSION['user']['fullName'] = $newFullName;

    // Send response
    echo json_encode(['success' => true, 'message' => 'Data berhasil diperbarui.']);
    exit();
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
    <div class="main-content">
        <div class="profile-container">
            <div class="profile-menu">
                <h3>Profile</h3>
            </div>
            <div class="form-container">
                <form id="profile-form" method="POST" action="">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['fullName']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phoneNumber']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>">
                    </div>
                    <button type="submit" id="save-button">Save</button>
                </form>
            </div>
        </div>
    </div>
    <div class="notification" id="notification" style="display: none;">
        <p id="notification-message"></p>
    </div>
    <script>
        document.getElementById('profile-form').addEventListener('submit', function(e) {
            e.preventDefault();

            if (!confirm('Are you sure you want to update your profile?')) {
                return;
            }

            const formData = new FormData(this);
            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('notification-message').innerText = data.message;
                    document.getElementById('notification').style.display = 'block';
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
