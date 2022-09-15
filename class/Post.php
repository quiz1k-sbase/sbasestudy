<?php

require_once CLASS_PATH . DIRECTORY_SEPARATOR . "Db.php";

class Post extends Db {
    public int $id;
    public int $user_id;
    public string $text;
    public string $date;

    public function create(int $uid, string $text) {
        $db = new Db();
        $stmt = $db->getConnection()->prepare("INSERT INTO posts(`user_id`, `text`) VALUES(:user_id, :text)");
        $stmt->execute(array('user_id' => $uid, 'text' => $text));
        $this->id = $db->getConnection()->lastInsertId();
        return $this->id;
    }

    public function allPosts() {
        $db = new Db();
        $stmt = $db->getConnection()->prepare("SELECT posts.*, users.username FROM `posts` INNER JOIN `users` 
                                                    ON posts.user_id = users.id ORDER BY id DESC;");
        $stmt->execute();
        $posts = [];
        while ($row = $stmt->fetch(PDO::FETCH_LAZY))
        {
            $posts[] = ['id' => $row->id, 'username' => $row->username, 'text' => $row->text,
                'date' => $row->date, 'user_id' => $row->user_id];
        }
        return $posts;
    }

    public function deletePost($id) {
        $db = new Db();
        $stmt = $db->getConnection()->prepare("DELETE FROM posts WHERE `id` = :id;");
        $stmt->execute(['id' => $id]);
    }

    public static function getAuthor($id) {
        $db = new Db();
        $stmt = $db->getConnection()->prepare("SELECT users.username FROM `users` WHERE `id` = :id;");
        $stmt->execute(['id' => $id]);
        $author = $stmt->fetchColumn();
        return $author;
    }

    public function getComments() {
        $db = new Db();
        $stmt = $db->getConnection()->prepare("SELECT * FROM comments ORDER BY id DESC;");
        $stmt->execute();
        $posts = $stmt->fetchObject();
        return $posts;
    }

    public static function getDate($id) {
        $db = new Db();
        $stmt = $db->getConnection()->prepare("SELECT posts.date FROM `posts` WHERE `id` = :id;");
        $stmt->execute(['id' => $id]);
        $date = $stmt->fetchColumn();
        return date('d F Y G:i', strtotime($date));
    }

    public function editPost($id, $text) {
        $db = new Db();
        $stmt = $db->getConnection()->prepare("UPDATE `posts` SET `text` = :text WHERE `id` = :id;");
        $stmt->execute(['id' => $id, 'text' => $text]);
    }
}