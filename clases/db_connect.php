<?php

class db_connect
{
    private $severAddress;
    private $dbname;
    private $userName;
    private $password;
    private $charset;

    private $port;
    protected function connect()
    {
        $this->severAddress = "localhost";
        $this->dbname = "u278791254_lottery";
        $this->userName = "root";
        $this->password = 'root1234';
        $this->charset = "utf8mb4";
        $this->port = "3008";

        try {
            $dsn = "mysql:host=$this->severAddress;port=$this->port;dbname=$this->dbname;charset=$this->charset";
            $pdo = new PDO($dsn, username: $this->userName, password: $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (Exception $ex) {
            echo $ex;
        }
    }
}