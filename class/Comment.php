<?php

require_once CLASS_PATH . DIRECTORY_SEPARATOR . "Db.php";

class Comment extends Db {
    public int $id;
    public int $user_id;
    public int $post_id;
    public string $text;
    public int $date;

    public function create(int $uid, int $post_id, string $text) {
        $db = new Db();
        $stmt = $db->getConnection()->prepare("INSERT INTO comments(`user_id`, `post_id`, `comment`) VALUES(:user_id, :post_id, :comment)");
        $stmt->execute(array('user_id' => $uid, 'post_id' => $post_id, 'comment' => $text));
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
            $comments[] = ['id' => $row->id, 'username' => $row->username, 'post_id' => $row->post_id, 'comment' => $row->comment,
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

    public static function getDate($id) {
        $db = new Db();
        $stmt = $db->getConnection()->prepare("SELECT comments.date FROM `comments` WHERE `id` = :id;");
        $stmt->execute(['id' => $id]);
        $date = $stmt->fetchColumn();
        return date('d F Y G:i', strtotime($date));
    }

    public function editComment($id) {

    }
}