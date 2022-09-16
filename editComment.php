<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
require_once CONTROLLER_PATH . DIRECTORY_SEPARATOR . "CommentController.php";

if ($_POST['edit'])
{
    CommentController::edit($_POST);
}