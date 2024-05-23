<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Management</title>
    <link rel="stylesheet" href="css/profileManagement.css">
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <div class="profile-container">
            <div class="profile-menu">
                <h3>Profile</h3>
                <ul>
                    <li>Name</li>
                    <li>Phone Number</li>
                    <li>Email</li>
                    <li>Password</li>
                    <li>Status</li>
                    <li>Role</li>
                </ul>
            </div>
            <div class="form-container">
                <input type="text" placeholder="Name">
                <input type="text" placeholder="Phone Number">
                <input type="email" placeholder="Email">
                <input type="password" placeholder="Password">
                <button>Update</button>
            </div>
        </div>
    </div>
</body>
</html>
