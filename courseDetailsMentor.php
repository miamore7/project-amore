<?php

include('sidebarM.php');

// Memeriksa apakah pengguna sudah login
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    // Lanjutkan dengan operasi lain yang menggunakan $email
} else {
    // Pengguna belum login, arahkan ke halaman login atau lakukan tindakan lain yang sesuai
    // header('Location: login.php');
    // exit();
}

// Sambungkan ke database
include('dbConnection.php');

// Tangkap nama dan sub course dari URL query string
$courseTitle = isset($_GET['title']) ? $_GET['title'] : '';
$subCourse = isset($_GET['sub_course']) ? $_GET['sub_course'] : '';

// Kueri untuk mengambil video dan deskripsi sub course dari tabel course berdasarkan nama dan sub course
$stmt = $conn->prepare("SELECT link_video, description, id FROM course WHERE nama_course = :courseTitle AND sub_course = :subCourse");
$stmt->bindValue(':courseTitle', $courseTitle);
$stmt->bindValue(':subCourse', $subCourse);
$stmt->execute();
$courseDetails = $stmt->fetch(PDO::FETCH_ASSOC);

if ($courseDetails) {
    $courseId = $courseDetails['id'];
}

// Kueri untuk mengambil komentar dan balasan mentor
$feedbackStmt = $conn->prepare("
    SELECT f.id AS feedbackId, f.komen, m.komenMentor 
    FROM feedback f 
    LEFT JOIN mentorFeedback m ON f.id = m.idFeedback 
    WHERE f.idCourse = :courseId
");
$feedbackStmt->bindValue(':courseId', $courseId);
$feedbackStmt->execute();
$feedbacks = $feedbackStmt->fetchAll(PDO::FETCH_ASSOC);

// Tangani pengiriman komentar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $comment = $_POST['comment'];
    $idUser = $_SESSION['userId'];

    $insertStmt = $conn->prepare("INSERT INTO feedback (komen, idUser, idCourse) VALUES (:komen, :idUser, :idCourse)");
    $insertStmt->bindValue(':komen', $comment);
    $insertStmt->bindValue(':idUser', $idUser);
    $insertStmt->bindValue(':idCourse', $courseId);

    if ($insertStmt->execute()) {
        // Refresh the page to show the new comment
        header("Location: courseDetailsMentor.php?title=" . urlencode($courseTitle) . "&sub_course=" . urlencode($subCourse));
        exit();
    } else {
        echo "Error: " . $insertStmt->errorInfo()[2];
    }
}

// Tangani pengiriman balasan mentor
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mentorReply'])) {
    $mentorReply = $_POST['mentorReply'];
    $feedbackId = $_POST['feedbackId'];
    $idUser = $_SESSION['userId'];

    $insertStmt = $conn->prepare("INSERT INTO mentorFeedback (komenMentor, idUser, idCourse, idFeedback) VALUES (:komenMentor, :idUser, :idCourse, :idFeedback)");
    $insertStmt->bindValue(':komenMentor', $mentorReply);
    $insertStmt->bindValue(':idUser', $idUser);
    $insertStmt->bindValue(':idCourse', $courseId);
    $insertStmt->bindValue(':idFeedback', $feedbackId);

    if ($insertStmt->execute()) {
        // Refresh the page to show the new mentor reply
        header("Location: courseDetailsMentor.php?title=" . urlencode($courseTitle) . "&sub_course=" . urlencode($subCourse));
        exit();
    } else {
        echo "Error: " . $insertStmt->errorInfo()[2];
    }
}

$conn = null; // Tutup koneksi
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .course-details {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .course-details h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .course-details .video {
            margin-bottom: 20px;
        }

        .course-details .description {
            font-size: 16px;
            color: #555;
            margin-bottom: 30px;
        }

        .comments {
            margin-top: 30px;
        }

        .comments h3 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .comments form {
            margin-bottom: 20px;
        }

        .comments textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .comments button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .comments button:hover {
            background-color: #0056b3;
        }

        .user-comment, .mentor-reply {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .mentor-reply {
            background-color: #eef;
        }

        .mentor-reply p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="course-details">
        <h2><?php echo htmlspecialchars($courseTitle); ?> - <?php echo htmlspecialchars($subCourse); ?></h2>
        <div class="video">
            <iframe width="560" height="315" src="<?php echo $courseDetails['link_video']; ?>" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="description">
            <p><?php echo $courseDetails['description']; ?></p>
        </div>

        <!-- Comment Section -->
        <div class="comments">
            <h3>Comments</h3>
            <!-- Display comments and mentor feedback -->
            <?php foreach ($feedbacks as $feedback): ?>
                <div class="user-comment">
                    <p><strong>User comment:</strong> <?php echo htmlspecialchars($feedback['komen']); ?></p>
                    <?php if (!empty($feedback['komenMentor'])): ?>
                        <div class="mentor-reply">
                            <p><strong>Mentor's reply:</strong> <?php echo htmlspecialchars($feedback['komenMentor']); ?></p>
                        </div>
                    <?php else: ?>
                        <!-- Mentor reply form -->
                        <form method="post" action="">
                            <textarea name="mentorReply" placeholder="Reply to this comment..." required></textarea>
                            <input type="hidden" name="feedbackId" value="<?php echo $feedback['feedbackId']; ?>">
                            <button type="submit">Reply</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
