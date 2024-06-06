<?php
// session_start();

// // Memeriksa apakah pengguna sudah login
// if (!isset($_SESSION['email'])) {
//     // Jika pengguna belum login, arahkan ke halaman login
//     header("Location: login.php");
//     exit(); // Menghentikan eksekusi skrip lebih lanjut
// }

include('sidebar.php');
require('dbConnection.php'); // Include the database connection file

// Function to handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the chat message is set
    if (isset($_POST["chat_message"])) {
        // Sanitize and get the chat message
        $chat_message = htmlspecialchars($_POST["chat_message"]);

        // Check if nama parameter is set in the URL
        if (isset($_GET["nama"])) {
            // Handle request to retrieve forum data based on nama
            $nama = $_GET["nama"];

            // Insert the chat message into the database
            $sql = "INSERT INTO forum (nama, daftar_chat) VALUES (:nama, :chat_message)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':chat_message', $chat_message);
            $stmt->execute();
        }
    }
}

// Check if nama parameter is set in the URL
if (isset($_GET["nama"])) {
    // Handle request to retrieve forum data based on nama
    $nama = $_GET["nama"];

    // Execute query to retrieve forum data based on nama
    $sql = "SELECT * FROM forum WHERE nama = :nama";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nama', $nama);
    $stmt->execute();
    $forums = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Diskusi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            padding: 20px;
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .forum-post {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .forum-post:last-child {
            border-bottom: none;
        }

        .forum-post .meta {
            color: #666;
            font-size: 0.9em;
            margin-bottom: 5px;
        }

        .forum-post .message {
            font-size: 1em;
            line-height: 1.5em;
        }

        form {
            margin-top: 20px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 1em;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Forum Diskusi: <?php echo htmlspecialchars($nama); ?></h1>

        <?php
        if (isset($forums) && count($forums) > 0) {
            foreach ($forums as $forum) {
                echo "<div class='forum-post'>";
                echo "<div class='meta'>Posted by: " . htmlspecialchars($forum['nama']) . "</div>";
                echo "<div class='message'>" . htmlspecialchars($forum['daftar_chat']) . "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No posts found.</p>";
        }
        ?>

        <!-- Form to submit chat messages -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?nama=" . urlencode($nama); ?>">
            <label for="chat_message">Chat Message:</label><br>
            <textarea id="chat_message" name="chat_message" rows="4"></textarea><br>
            <input type="submit" value="Send Chat">
        </form>
    </div>
</body>
</html>
