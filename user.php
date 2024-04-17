<?php
require('dbConnection.php');

class User
{
    public $fullName;
    public $phoneNumber;
    public $email;
    public $password;
    public $database;

    public function __construct($fullName, $phoneNumber, $email, $password)
    {
        $this->fullName = $fullName;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->password = $password;
        $this->database = new DbConnection();
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->fullName = $phoneNumber;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function tambah()
    {
        $sql = 'insert into user (fullName, phoneNumber, email, password) values (?,?,?,?)';
        $statement = $this->database->database->prepare($sql);
        if ($statement->execute(
            [$this->fullName, $this->phoneNumber, $this->email, $this->password]
        )) {
            // echo 'data berhasil ditambah';
        } else {
            echo 'data tidak berhasil';
        }
    }
    
    public function auth($email, $password)
    {
        $sql = 'select * from user where email=:email and password=:password limit 1';
        $statement = $this->database->database->prepare($sql);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->execute();
        $data = $statement->fetch();
        return $data;
    }
}
