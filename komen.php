<?php
include('sidebar.php');// Ensure session is started

// Database connection parameters
$dsn = 'mysql:host=localhost;dbname=amoredb';
$username = 'root';
$password = '';

try {
    // Create a PDO instance
    $conn = new PDO($dsn, $username, $password);
    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If connection fails, display an error message
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

// Continue with your existing code...

// Function to handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the comment message is set
    if (isset($_POST["comment_message"])) {
        // Sanitize and get the comment message
        $comment_message = htmlspecialchars($_POST["comment_message"]);
        $idForum = $_POST["idForum"];

        // Insert the comment into the database
        $sql = "INSERT INTO komen (idForum, komen, idUser) VALUES (:idForum, :comment_message, :idUser)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idForum', $idForum);
        $stmt->bindParam(':comment_message', $comment_message);
        $stmt->bindParam(':idUser', $idUser);
        $stmt->execute();
    }
}

// Check if idForum parameter is set in the URL
if (isset($_GET["idForum"])) {
    $idForum = $_GET["idForum"];

    // Execute query to retrieve forum data
    $sqlForum = "SELECT f.daftar_chat, u.fullName, u.profilePhoto FROM forum f JOIN user u ON f.idUser = u.idUser WHERE f.id = :idForum";
    $stmtForum = $conn->prepare($sqlForum);
    $stmtForum->bindParam(':idForum', $idForum);
    $stmtForum->execute();
    $forum = $stmtForum->fetch(PDO::FETCH_ASSOC);

    // Execute query to retrieve comments data
    $sqlComments = "SELECT c.komen,  u.fullName, u.profilePhoto FROM komen c JOIN user u ON c.idUser = u.idUser WHERE c.idForum = :idForum";
    $stmtComments = $conn->prepare($sqlComments);
    $stmtComments->bindParam(':idForum', $idForum);
    $stmtComments->execute();
    $comments = $stmtComments->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Comments</title>
  <style>
   body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

.comments-container {
    width: 60%;
    margin: 20px auto;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.comments {
    margin-bottom: 20px;
}

.comment-message {
    margin-bottom: 20px;
    border-bottom: 1px solid #e0e0e0;
    padding-bottom: 10px;
}

.profile-photo {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
    float: left;
}

.message-content {
    margin-left: 50px;
    overflow: hidden;
}

.full-name {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

.chat-form {
    clear: both;
    margin-top: 20px;
}

#comment_message {
    width: calc(100% - 90px); /* Adjusting width to account for button width and margins */
    padding: 10px;
    border: 1px solid #cccccc;
    border-radius: 5px;
    resize: none;
    float: left;
}

.send-button {
    width: 80px;
    margin-left: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px;
    cursor: pointer;
    float: left;
}

.send-button:hover {
    background-color: #0056b3;
}

  </style>
</head>
<body>



<div class="comments-container">
<div class="forum">
    <?php if (isset($forum)): ?>
        <div class='chat-message'>
            <img src='<?php echo $forum["profilePhoto"]; ?>' alt='Profile Photo' class='profile-photo'>
            <div class='message-content'>
                <span class='full-name'><?php echo $forum["fullName"]; ?></span>
                <p><?php echo $forum["daftar_chat"]; ?></p>
            </div>
        </div>
    <?php else: ?>
        <p class='no-results'>No forum found</p>
    <?php endif; ?>
</div>
    <div class="comments">
        <?php if (isset($comments) && count($comments) > 0): ?>
            <?php foreach ($comments as $comment): ?>
                <div class='comment-message'>
                    <img src='<?php echo $comment["profilePhoto"]; ?>' alt='Profile Photo' class='profile-photo'>
                    <div class='message-content'>
                        <span class='full-name'><?php echo $comment["fullName"]; ?></span>
                        <p><?php echo $comment["komen"]; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class='no-results'>No comments found</p>
        <?php endif; ?>
    </div>

    <!-- Form to submit comments -->
    <form method="post" action="komen.php?idForum=<?php echo $idForum; ?>" class="chat-form">
        <textarea id="comment_message" name="comment_message" rows="2" placeholder="Ketikkan sesuatu..."></textarea>
        <input type="hidden" name="idForum" value="<?php echo $idForum; ?>">
        <button type="submit" class="send-button">Send</button>
    </form>
</div>



</body>
</html>
