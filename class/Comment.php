<?php

require_once CLASS_PATH . DIRECTORY_SEPARATOR . "Db.php";

class Comment extends Db {
    public int $id;
    public int $user_id;
    public string $text;
    public int $date;

    public function create(int $uid, string $text) {
        $db = new Db();
        $stmt = $db->getConnection()->prepare("INSERT INTO comments(`user_id`, `comment`) VALUES(:user_id, :comment)");
        $stmt->execute(array('user_id' => $uid, 'comment' => $text));
        $this->id = $db->getConnection()->lastInsertId();
        return $this->id;
    }

    public function allPosts() {
        $db = new Db();
        $stmt = $db->getConnection()->prepare("SELECT comments.*, users.username FROM `comments` INNER JOIN `users` ON comments.user_id = users.id ORDER BY id DESC;");
        $stmt->execute();
        $comments = [];
        while ($row = $stmt->fetch(PDO::FETCH_LAZY))
        {
            $comments[] = ['id' => $row->id, 'username' => $row->username, 'comment' => $row->comment,
                'date' => $row->date, 'user_id' => $row->user_id];
        }
        return $comments;
    }

    public function deleteComment($id) {
        $db = new Db();
        $stmt = $db->getConnection()->prepare("DELETE FROM comments WHERE `id` = :id;");
        $stmt->execute(['id' => $id]);
    }

    public static function getAuthor($id) {
        $db = new Db();
        $stmt = $db->getConnection()->prepare("SELECT users.username FROM `users` WHERE `id` = :id;");
        $stmt->execute(['id' => $id]);
        $author = $stmt->fetchColumn();
        return $author;
    }

    public function editComment($id) {

    }
}