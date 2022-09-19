<?php

require_once MODEL_PATH . DIRECTORY_SEPARATOR . "Comment.php";
require_once MODEL_PATH . DIRECTORY_SEPARATOR . "Post.php";

class View
{

    public function execute(): void
    {
        $comment = new Comment();
        $comments = $comment->allPosts();

        $post = new Post();
        $posts = $post->allPosts();
        $uid = json_decode(json_encode(unserialize($_SESSION['user'])), true);
        require_once ROOT_PATH . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "index.php";
    }

}