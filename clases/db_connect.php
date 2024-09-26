<?php

class db_connect
{
    private $severAddress;
    private $dbname;
    private $userName;
    private $password;
    private $charset;

    protected function connect()
    {
        $this->severAddress = "localhost";
        $this->dbname = "u278791254_lottery";
        $this->userName = "root";
        $this->password = 'root1234';
        $this->charset = "utf8mb4";
        try {
            $dsn = "mysql:host=$this->severAddress;dbname=$this->dbname;charset=$this->charset";
            $pdo = new PDO($dsn, $this->userName, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (Exception $ex) {
            echo $ex;
        }
    }
}