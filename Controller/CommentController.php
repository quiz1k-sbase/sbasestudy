<?php

require_once MODEL_PATH . DIRECTORY_SEPARATOR . "Comment.php";

class CommentController
{
    public static function add(int $uid, array $data)
    {

        $comment = new Comment();
        $comment->create($uid, $_POST['post_id'], $_POST['comment']);
        $comment->allPosts();
        $id = 0;
        foreach ($comment as $com)
        {
            $id = $com;
            break;
        }

        echo json_encode(array('id' => $id, 'username' => Comment::getAuthor($uid)));
    }

    public static function edit(array $data)
    {
        if ($data['edit'])
        {
            $comment = new Comment();
            $comment->editComment($_POST['editId'], $_POST['editText']);
        }
    }

    public static function delete(int $id)
    {
        $delComm = new Comment();
        $delComm->deleteComment($id);
    }
}