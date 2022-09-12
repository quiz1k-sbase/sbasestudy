<?php

class Db
{
    private string $host = "localhost";
    private string $user = "root";
    private string $pass = "1234";
    private string $dbname = "testBook";
    private string $charset = "utf8";
    private $conn;

    public function __construct()
    {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=" . $this->charset;
        $this->conn = new PDO($dsn, $this->user, $this->pass);
    }

    public function getConnection()
    {
        return $this->conn;
    }
}