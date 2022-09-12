<?php

require_once CLASS_PATH . DIRECTORY_SEPARATOR . "Db.php";

class User extends Db {
    public int $id;
    public string $username;
    public string $email;
    public string $firstName;
    public string $lastName;
    public int $phone;
    private string $password;
    private const SALT = "testBook123$434";

    public function __construct(
        int $id,
        string $username,
        string $email,
        string $firstName = null,
        string $lastName = null,
        int $phone = null,
        string $password
    )
    {
        $this->id = (int)$id;
        $this->username = $username;
        $this->email = $email;
        if (!empty($firstName)) {
            $this->firstName = $firstName;
        }
        if (!empty($lastName)) {
            $this->lastName = $lastName;
        }
        if (!empty($phone)) {
            $this->phone = $phone;
        }
        $this->password = $password;
    }

    private static function encryptPassword(string $password): string
    {
        return crypt($password, self::SALT);
    }

    public function __serialize(): array
    {
        return ["id" => $this->id, "username" => $this->username, 
        "email" => $this->email];
    }

    public static function create(array $userData): User
    {
        $db = new Db();
        $stmt = $db->getConnection()->prepare("INSERT INTO `users`(`username`, `email`, `first_name`,
        `last_name`, `phone`, `password`) VALUES(:username, :email, :firstName,
        :lastName, :phone, :password)");
        $user = [
            "username" => $userData['username'],
            "email" => $userData['email'],
            "firstName" => $userData['firstName'],
            "lastName" => $userData['lastName'],
            "phone" => $userData['phone'],
            "password" => self::encryptPassword($userData['password'])
        ];
        $stmt->execute($user);
        $id = $db->getConnection()->lastInsertId();
        $user = new User(
            $id, $userData["username"], $userData["email"],
            $userData["firstName"], $userData["lastName"], $userData["phone"],
            $userData["password"]
        );
        return $user;
    }

    public static function login(string $email, string $password): User|bool
    {
        $db = new Db();
        $stmt = $db->getConnection()->prepare("SELECT * FROM `users` WHERE `email` = :email and `password` = :password");
        $stmt->execute(["email" => $email, "password" => self::encryptPassword($password)]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($user)) {
            $user = new User($user['id'], $user['username'], $user['email'], 
                            $user['firstName'] ?? null, $user['lastName'] ?? null, 
                            $user['phone'] ?? null, $user['password']);
            return $user;
        }
        return false;
    }

    public function getId() {
        return $this->id;
    }
}