<?php
define('DB_HOST', 'localhost'); // Alamat server MySQL/MariaDB
define('DB_USER', 'root'); // Username database
define('DB_PWD', ''); // Password database (kosongkan jika tidak ada)
define('DB_NAME', 'amoreDB'); // Nama database (schema)

class DbConnection
{
    public $database;
    public function __construct()
    {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=UTF8"; // Perintah koneksi dengan MySQL
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PWD);
            if ($pdo) {
                $this->database = $pdo;
                // echo "Database telah tersambung.";
            }
        } catch (PDOException $e) {
            echo "Koneksi database gagal: " . $e->getMessage();
            // Atau bisa juga di-handle secara berbeda, seperti die() atau exit() untuk menghentikan eksekusi script
            // die("Koneksi database gagal: " . $e->getMessage());
        }
    }
}

// Buat instance objek DbConnection
$dbConnection = new DbConnection();
// Dapatkan koneksi database
$conn = $dbConnection->database;

// Periksa koneksi

?>
