<?php
define('DB_HOST', 'localhost'); //alamat server mysql/mariadb
define('DB_USER', 'root'); //username database
define('DB_PWD', ''); //password database
define('DB_NAME', 'amore'); //nama database (schema)

class DbConnection
{
    public $database;
    public function __construct()
    {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=UTF8"; //perintah koneksi dengan mysql
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PWD);
            if ($pdo) {
                $this->database = $pdo;
                // echo "database telah tersambung.";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}