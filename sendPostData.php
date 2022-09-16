<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
require_once CONTROLLER_PATH . DIRECTORY_SEPARATOR . "PostController.php";

$uid = json_decode(json_encode(unserialize($_SESSION['user'])), true);

if (!empty($_POST['text']))
{
    PostController::add($uid['id'], $_POST);
}