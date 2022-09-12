<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";

session_destroy();
unset($_COOKIE['id']);
setcookie('id', '', -1, '/');

header("Location: /login.php");
die();