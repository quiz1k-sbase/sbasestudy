<!-- Registration page. -->

<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "User.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "Db.php";
$dbConn = new Db();

if (!empty($_SESSION['user'])) {
    header("Location: /index.php");
    die();
}

$errors = [];
if (!empty($_POST)) {
    foreach ($_POST as $key => $val) {
        if ($key === "email") {
            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $errors[$key] = ucfirst($key) . ' is invalid';
                continue;
            }

            $stmt = $dbConn->getConnection()->prepare("SELECT id FROM `users` WHERE `email` = :email");
            $stmt->execute(["email" => $val]);
            if (!empty($stmt->fetchColumn())) {
                $errors[$key] = ucfirst($key) . " " . $val . " is already used";
            }
        }
    }

    if ($_POST['password'] !== $_POST['confirm_password']) {
        $error['password'] = "Password was not confirmed";
    }
    
    if (empty($errors)) {
        $user = User::create($_POST);
        $_SESSION['user'] = serialize($user);
        header("Location: /index.php");
    }
}

require_once ROOT_PATH . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "registration.php";