<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
require_once CLASS_PATH . DIRECTORY_SEPARATOR . "Post.php";

$uid = json_decode(json_encode(unserialize($_SESSION['user'])), true);

if ($_POST['editPost']) {
    $post = new Post();
    $post->editPost($_POST['editPostId'], $_POST['editPostText']);
}