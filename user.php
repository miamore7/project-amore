<?php
class User
{
    public $fullName;
    public $phoneNumber;
    public $email;
    public $password;

    public function __construct($fullName, $phoneNumber, $email, $password)
    {
        $this->fullName = $fullName;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->password = $password;
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
}
