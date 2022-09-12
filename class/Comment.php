<?php

class Comment {
    public int $id;
    public int $user_id;
    public string $text;
    public string $date;

    public function create(object $db, int $uid, string $text) {
        $stmt = $db->prepare("INSERT INTO comments(`user_id`, `comment`) VALUES(:user_id, :comment)");
        $stmt->execute(array('user_id' => $uid, 'comment' => $text));
        $this->id = $db->lastInsertId();
        return $this->id;
    }

    public function allPosts(object $db) {
        $stmt = $db->prepare("SELECT comments.*, users.username FROM `comments` INNER JOIN `users` ON comments.user_id = users.id ORDER BY id DESC;");
        $stmt->execute();
        $comments = [];
        while ($row = $stmt->fetch(PDO::FETCH_LAZY))
        {
            $comments[] = ['id' => $row->id, 'username' => $row->username, 'comment' => $row->comment, 'date' => $row->date];
        }
        return $comments;
    }
}