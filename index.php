<!-- Index page. Here will be displayed all posts from db. --> 

<?php



require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
require_once MODEL_PATH . DIRECTORY_SEPARATOR . "User.php";
require_once MODEL_PATH . DIRECTORY_SEPARATOR . "Comment.php";
require_once MODEL_PATH . DIRECTORY_SEPARATOR . "Post.php";
require_once CONTROLLER_PATH . DIRECTORY_SEPARATOR . "CommentController.php";
require_once CONTROLLER_PATH . DIRECTORY_SEPARATOR . "PostController.php";



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

if (!empty($_POST['deletePostId']))
{
    PostController::delete($_POST['deletePostId']);
}

if (!empty($_POST['commentDeleteId']))
{
    CommentController::delete($_POST['commentDeleteId']);
}

require_once ROOT_PATH . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "index.php";