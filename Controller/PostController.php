<?php

require_once MODEL_PATH . DIRECTORY_SEPARATOR . "Post.php";

class PostController
{
    public static function add(int $uid, array $data)
    {
        if (!empty($data['text']))
        {
            $post = new Post();
            $post->create($uid, $data['text']);
            $post->allPosts();
            $id = 0;
            foreach ($post as $postVal) {
                $id = $postVal;
                break;
            }
            $uName = $post->getAuthor($uid);
            $date = $post->getDate($id);
            echo json_encode(array("id" => $id, "uName" => $uName, "pDate" => $date));
        }
    }

    public static function edit(array $data)
    {
        if ($data['editPost']) {
            $post = new Post();
            $post->editPost($data['editPostId'], $data['editPostText']);
        }
    }
}