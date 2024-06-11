<?php
 // Ensure session is started

include('sidebar.php');
require('dbConnection.php'); // Include the database connection file

// Check if the user is logged in

$idUser = $_SESSION['user']['idUser'];

// Get user data
$sqlUser = "SELECT fullName, profilePhoto FROM user WHERE idUser = :idUser";
$stmtUser = $conn->prepare($sqlUser);
$stmtUser->bindParam(':idUser', $idUser);
$stmtUser->execute();
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);

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
            $sql = "INSERT INTO forum (nama, daftar_chat, idUser) VALUES (:nama, :chat_message, :idUser)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':chat_message', $chat_message);
            $stmt->bindParam(':idUser', $idUser);
            $stmt->execute();
        }
    }
}

// Check if nama parameter is set in the URL
if (isset($_GET["nama"])) {
    // Handle request to retrieve forum data based on nama
    $nama = $_GET["nama"];

    // Execute query to retrieve forum data based on name
    $sql = "SELECT f.id, f.daftar_chat, u.fullName, u.profilePhoto FROM forum f JOIN user u ON f.idUser = u.idUser WHERE f.nama = :nama";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nama', $nama);
    $stmt->execute();
    $forums = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display forum data
    // if (count($forums) > 0) {
    //     echo "<div class='forum'>";
    //     foreach ($forums as $forum) {
    //         echo "<div class='chat-message'>";
    //         echo "<img src='" . $forum["profilePhoto"] . "' alt='Profile Photo' class='profile-photo'>";
    //         echo "<div class='message-content'>";
    //         echo "<span class='full-name'>" . $forum["fullName"] . "</span>";
    //         echo "<p>" . $forum["daftar_chat"] . "</p>";
    //         echo "<a href='komen.php?idForum=" . $forum["id"] . "' class='comment-link'><img src='path/to/comment-icon.png' alt='Comment' class='comment-icon'></a>"; // Replace 'path/to/comment-icon.png' with the actual path to your comment icon image
    //         echo "</div>";
    //         echo "</div>";
    //     }
    //     echo "</div>";
    // } else {
    //     echo "<p class='no-results'>No messages found</p>";
    // }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Your Page Title</title>
  <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
    }

    .forum {
        width: 60%;
        margin: 20px auto;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .chat-message {
        display: flex;
        align-items: flex-start;
        margin-bottom: 20px;
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 10px;
    }

    .profile-photo {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .message-content {
        flex-grow: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .full-name {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    .chat-form {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
    }

    #chat_message {
        width: 80%;
        padding: 10px;
        border: 1px solid #cccccc;
        border-radius: 5px;
        resize: none;
    }

    .send-button {
        width: 18%;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px;
        cursor: pointer;
    }

    .send-button:hover {
        background-color: #0056b3;
    }

    .comment-icon {
        width: 20px;
        height: 20px;
        margin-left: 10px;
        cursor: pointer;
    }
    .market-link {
    text-decoration: none; /* Remove underline from the link */
}

.market-button {
    background-color: #007bff; /* Match the button style */
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px; /* Adjust padding for better look */
    cursor: pointer;
    font-size: 16px; /* Adjust font size */
    margin: 10px 0; /* Add some margin for spacing */
}

.market-button:hover {
    background-color: #0056b3; /* Darken the button on hover */
}

  </style>
</head>
<body>

<div class="forum">
    <!-- Display forum data if available -->
    <?php if (isset($forums) && count($forums) > 0): ?>
        <?php foreach ($forums as $forum): ?>
            <div class='chat-message'>
                <img src='<?php echo $forum["profilePhoto"]; ?>' alt='Profile Photo' class='profile-photo'>
                <div class='message-content'>
                    <div>
                        <span class='full-name'><?php echo $forum["fullName"]; ?></span>
                        <p><?php echo $forum["daftar_chat"]; ?></p>
                    </div>
                    <a href='komen.php?idForum=<?php echo $forum["id"]; ?>' class='comment-link'><img src='img/comments.png' alt='Comment' class='comment-icon'></a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class='no-results'>No messages found</p>
    <?php endif; ?>

    <!-- Form to submit chat messages -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?nama=" . urlencode($nama); ?>" class="chat-form">
        <textarea id="chat_message" name="chat_message" rows="2" placeholder="Ketikkan sesuatu..."></textarea>
        <button type="submit" class="send-button">Send</button>
    </form>
    <a href='pasarUser.php' class='market-link'>
    <button class='market-button'>Pasar</button>
</a>

</a>

</a>


</a>

</a>

</a>
</div>

</body>
</html>
