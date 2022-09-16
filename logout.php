<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
require_once CONTROLLER_PATH . DIRECTORY_SEPARATOR . "UserController.php";

UserController::logout();

header("Location: /login.php");
die();