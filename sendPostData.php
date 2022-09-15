<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "Comment.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "Post.php";

$uid = json_decode(json_encode(unserialize($_SESSION['user'])), true);

if (!empty($_POST['text']))
{
    $post = new Post();
    $post->create($uid['id'], $_POST['text']);
    $post->allPosts();
    $id = 0;
    foreach ($post as $postVal) {
        $id = $postVal;
        break;
    }
    $uName = $post->getAuthor($uid['id']);
    $date = $post->getDate($id);
    echo json_encode(array("id" => $id, "uName" => $uName, "pDate" => $date));
}