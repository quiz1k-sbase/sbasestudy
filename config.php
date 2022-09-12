<?php
session_start();
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "1234");
define("DBNAME", "testBook");
define("CHARSET", "utf8");

define('ROOT_PATH', dirname(__FILE__));
define('CLASS_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . "class");

$dsn = "mysql:host=".HOST.";dbname=".DBNAME.";charset=".CHARSET;
try {
    $dbConn = new PDO($dsn, USER, PASSWORD);
} catch (PDOException $e) {
    die("Подключение не удалось: " . $e->getMessage());
}


