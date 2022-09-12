<!-- Page where any user can add post. -->
<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "User.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "Comment.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "Db.php";

$uid = json_decode(json_encode(unserialize($_SESSION['user'])), true);

if (!empty($_POST['text']))
{
    $comment = new Comment();
    $comment->create($uid['id'], $_POST['text']);
}

require_once ROOT_PATH . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "addPost.php";