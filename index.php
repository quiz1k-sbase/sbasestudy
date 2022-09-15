<!-- Index page. Here will be displayed all posts from db. --> 

<?php



require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "User.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "Comment.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "Post.php";



$comment = new Comment();
$comments = $comment->allPosts();

$post = new Post();
$posts = $post->allPosts();


if (empty($_SESSION['user']))
{
    header("Location: /login.php");
    die();
}

$uid = json_decode(json_encode(unserialize($_SESSION['user'])), true);

if (!empty($_POST['id']))
{
    $delPost = new Post();
    $delPost->deletePost($_POST['id']);
}

if (!empty($_POST['comm_id']))
{
    $delComm = new Comment();
    $delComm->deleteComment($_POST['comm_id']);
}

require_once ROOT_PATH . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "index.php";