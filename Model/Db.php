<?php

class Db
{
    private string $host = "localhost";
    private string $user = "root";
    private string $pass = "1234";
    private string $dbname = "postsDb";
    private string $charset = "utf8";
    private static $instance = null;
    private $conn;

    public function __construct()
    {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=" . $this->charset;
        $this->conn = new PDO($dsn, $this->user, $this->pass);
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Db();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}