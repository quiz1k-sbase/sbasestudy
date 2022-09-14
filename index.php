<!-- Index page. Here will be displayed all posts from db. --> 

<?php



require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "User.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "Comment.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "Post.php";



if (empty($_SESSION['user']))
{
    header("Location: /login.php");
    die();
}

$uid = json_decode(json_encode(unserialize($_SESSION['user'])), true);
if (!empty($_POST['text']))
{
    $post = new Post();
    $post->create($uid['id'], $_POST['text']);
}

foreach ($_POST as $postval => $val)
{
    if (!empty($val['comment']))
    {
        $comment = new Comment();
        $comment->create($uid['id'], $val['post_id'], $val['comment']);
        echo "success";
    }
}

/*if (!empty($_POST['comment']))
{
    $comment = new Comment();
    $comment->create($uid['id'], $_POST['post_id'], $_POST['comment']);
}*/

$comment = new Comment();
$comments = $comment->allPosts();

$post = new Post();
$posts = $post->allPosts();

if (!empty($_POST['id']))
{
    $delPost = new Post();
    $delPost->deletePost($_POST['id']);
}

require_once ROOT_PATH . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "index.php";