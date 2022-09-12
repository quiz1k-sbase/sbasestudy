<!-- Login page. -->

<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "User.php";

if (!empty($_SESSION['user'])) {
    header("Location: /index.php");
    die();
}

$errors = [];

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    foreach ($_POST as $key => $val) {
        if ($key === "email") {
            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $errors[$key] = ucfirst($key) . ' is invalid';
                continue;
            }
        }
    }
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = User::login($email, $password);
    if (!empty($user)) {
        $_SESSION['user'] = serialize($user);
        if (!empty($_POST['remember'])) {
            setcookie("id", 243434, time() + (3600 * 24 * 30));
        }
        header("Location: /index.php");
    } else {
        $isError = 1;
        $errors[] = "Please enter valid credentials.";
    }
}

require_once ROOT_PATH . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "login.php";