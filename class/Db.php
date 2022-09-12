<?php

class Db
{
    public string $host = "localhost";
    public string $user = "root";
    public string $pass = "1234";
    public string $dbname = "testBook";
    public string $charset = "utf8";
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