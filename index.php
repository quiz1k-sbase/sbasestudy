<!-- Index page. Here will be displayed all posts from db. --> 

<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "User.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "Comment.php";

if (empty($_SESSION['user']))
{
    header("Location: /login.php");
    die();
}

$uid = json_decode(json_encode(unserialize($_SESSION['user'])), true);
if (!empty($_POST['text']))
{
    $comment = new Comment();
    $comment->create($uid['id'], $_POST['text']);
}
$comment = new Comment();
$comments = $comment->allPosts();

if (!empty($_POST['id']))
{
    $comment = new Comment();
    $comment->deleteComment($_POST['id']);
}

require_once ROOT_PATH . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "index.php";