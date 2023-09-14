<?php //functions.php

require_once ABSPATH . "database/database.php";

class Functions {
    public static function checkLogin() {
        if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_mail'])) {
            return true;
        }   

        if (!empty($_SESSION['user_id']) || !empty($_SESSION['user_name']) || !empty($_SESSION['user_mail'])) {
            return true;
        }

        return false;
    }

    public static function registerUser($name, $mail, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $db = new Database();
        $query = "INSERT INTO user (user_name, user_mail, user_password) VALUES (?, ?, ?)";
        $result = $db->query($query, $name, $mail, $hashed_password);
        
        if ($result) {
            $db->close();
            return true;
        }
        
        $db->close();
        return false;
    }

    public static function checkUser($mail) {
        $db = new Database();
        $query = "SELECT COUNT(*) AS count FROM user WHERE user_mail = ?";
        $exists = $db->query($query, $mail)->fetchArray()['count'] > 0;
        
        if ($exists) {
            $db->close();
            return true;
        }
        $db->close();
        return false;
    }

    public static function loginUser($mail, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $db = new Database();
        $query = "SELECT user_id, user_name, password FROM user WHERE user_mail = ?";
        $user = $db->query($query, $mail)->fetchArray();

        if ($user) {
            if (password_verify($password, $user['user_password'])) {
                session_start();
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['user_name'];
                $_SESSION['user_mail'] = $mail['user_mail'];
                $db->close();
                return true;
            }
        }
        
        $db->close();
        return false;
    }
}