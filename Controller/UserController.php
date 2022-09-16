<?php

require_once DIRECTORY_SEPARATOR . MODEL_PATH . DIRECTORY_SEPARATOR . "Db.php";
class UserController
{
    public static $errors = [];

    public static function checkForRegistration(array $data): array
    {
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key === "email") {
                    if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                        $errors[$key] = ucfirst($key) . ' is invalid';
                        continue;
                    }

                    $stmt = Db::getInstance()->getConnection()->prepare("SELECT id FROM `users` WHERE `email` = :email");
                    $stmt->execute(["email" => $val]);
                    if (!empty($stmt->fetchColumn())) {
                        $errors[$key] = ucfirst($key) . " " . $val . " is already used";
                    }
                }

                if ($key === 'password') {
                    if (mb_strlen($val) < 6) {
                        $errors[$key] = ucfirst($key) . ' must be 6 or more symbols';
                        continue;
                    }
                }
            }

            if ($data['password'] !== $data['confirm_password']) {
                $errors['password'] = "Password was not confirmed";
            }
        }
        return self::$errors;
    }

    public static function login(array $data)
    {
        if (!empty($data['email']) && !empty($data['password'])) {
            foreach ($data as $key => $val) {
                if ($key === "email") {
                    if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                        $errors[$key] = ucfirst($key) . ' is invalid';
                        continue;
                    }
                }
            }
            $email = $data['email'];
            $password = $data['password'];
            $user = User::login($email, $password);
            if (!empty($user)) {
                $_SESSION['user'] = serialize($user);
                if (!empty($data['remember'])) {
                    setcookie("id", 243434, time() + (3600 * 24 * 30));
                }
                header("Location: /index.php");
            } else {
                $isError = 1;
                $errors[] = "Please enter valid credentials.";
            }
        }
    }

    public static function logout()
    {
        session_destroy();
        unset($_COOKIE['id']);
        setcookie('id', '', -1, '/');
    }

}