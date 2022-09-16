<!-- Login page. -->

<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
require_once MODEL_PATH . DIRECTORY_SEPARATOR . "User.php";
require_once CONTROLLER_PATH . DIRECTORY_SEPARATOR . "UserController.php";

if (!empty($_SESSION['user'])) {
    header("Location: /index.php");
    die();
}

if (!empty($_POST)) {
    UserController::login($_POST);
}

require_once ROOT_PATH . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "login.php";