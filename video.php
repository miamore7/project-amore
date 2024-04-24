<?php
require('DbConnection.php');

class Video
{
    private $dbConnection;

    public function __construct()
    {
        // Membuat objek DbConnection
        $this->dbConnection = new DbConnection();
    }

    // Fungsi untuk mengambil data video dari database
    public function getVideoData()
    {
        try {
            // Mendapatkan objek PDO dari DbConnection
            $pdo = $this->dbConnection->database;

            // Mengeksekusi query untuk mengambil data video
            $statement = $pdo->prepare("SELECT * FROM video_preview");
            $statement->execute();
            $videos = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $videos;
        } catch (PDOException $e) {
            die("Gagal mengambil data video: " . $e->getMessage());
        }
    }
}

?>
