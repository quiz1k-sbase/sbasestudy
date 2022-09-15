<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "Comment.php";

$uid = json_decode(json_encode(unserialize($_SESSION['user'])), true);
if (!empty($_POST['comment']))
{
    $comment = new Comment();
    $comment->create($uid['id'], $_POST['post_id'], $_POST['comment']);
    $comment->allPosts();
    $id = 0;
    foreach ($comment as $com)
    {
        $id = $com;
        break;
    }

    echo json_encode(array('id' => $id, 'username' => Comment::getAuthor($uid['id'])));
}