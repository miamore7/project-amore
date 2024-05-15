<?php
session_start(); // Memulai sesi di awal skrip

// Memeriksa apakah pengguna sudah login
if (isset($_SESSION['email'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Menghentikan eksekusi skrip lebih lanjut
}

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
            // Handle request to retrieve forum data based on name
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
    // Handle request to retrieve forum data based on name
    $nama = $_GET["nama"];

    // Execute query to retrieve forum data based on name
    $sql = "SELECT * FROM forum WHERE nama = :nama";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nama', $nama);
    $stmt->execute();
    $forums = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display forum data
    if (count($forums) > 0) {
        echo "<table>";
        foreach ($forums as $forum) {
            echo "<tr>";
            echo "<td>" . $forum["daftar_chat"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}
?>

<!-- Form to submit chat messages -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?nama=" . $_GET["nama"]; ?>">
    <label for="chat_message">Chat Message:</label><br>
    <textarea id="chat_message" name="chat_message" rows="4" cols="50"></textarea><br>
    <input type="submit" value="Send Chat">
</form>
<!DOCTYPE html>
<html>
<head>
  <title>Your Page Title</title>
  <link rel="stylesheet" href="css/forum.css">  </head>
<body>

</body>
</html>