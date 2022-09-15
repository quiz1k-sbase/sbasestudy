<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "Comment.php";

$uid = json_decode(json_encode(unserialize($_SESSION['user'])), true);

if ($_POST['edit'])
{
    $comment = new Comment();
    $comment->editComment($_POST['editId'], $_POST['editText']);
}