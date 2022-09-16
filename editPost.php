<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
require_once MODEL_PATH . DIRECTORY_SEPARATOR . "Post.php";
require_once CONTROLLER_PATH . DIRECTORY_SEPARATOR . "PostController.php";

if ($_POST['editPost']) {
    PostController::edit($_POST);
}