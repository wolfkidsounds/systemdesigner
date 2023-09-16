<?php //functions.php

require_once ABSPATH . "database/database.php";

class Functions {
    /**
     * Checks if a user is logged in
     *
     * @return true if the user is logged in, false otherwise.
     */
    public static function checkLogin() {
        Functions::startSession();

        if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_mail'])) {
            return true;
        }   

        if (!empty($_SESSION['user_id']) || !empty($_SESSION['user_name']) || !empty($_SESSION['user_mail'])) {
            return true;
        }

        return false;
    }

    /**
     * Regisers a user into the database
     *
     * @param [string] $name
     * @param [string] $mail
     * @param [string] $password
     * @return true if the user is registered successfully, false otherwise
     */
    public static function registerUser($name, $mail, $password) {
        Functions::startSession();
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $db = new Database();
        $query = "INSERT INTO user (user_name, user_mail, user_pass) VALUES (?, ?, ?)";
        $result = $db->query($query, $name, $mail, $hashed_password);
        
        if ($result) {
            $db->close();
            return true;
        }
        
        $db->close();
        return false;
    }

    /**
     * Checks if a user already exists
     *
     * @param [type] $mail
     * @return true if a user exists, false otherwise
     */
    public static function checkUser($mail) {
        Functions::startSession();
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

    /**
     * Logs in a user
     *
     * @param [type] $mail
     * @param [type] $password
     * @return boolean if the user was logged in succesfully, false otherwise
     */
    public static function loginUser($mail, $password, $remember_me) {
        Functions::startSession();
       
        $db = new Database();
        $query = "SELECT user, user_name, user_mail, user_pass FROM user WHERE user_mail = ?";
        $user = $db->query($query, $mail)->fetchArray();

        if ($user && password_verify($password, $user['user_pass'])) {
            session_regenerate_id(true);
            $user_id = $user['user'];
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['user_mail'] = $user['user_mail'];

            if ($remember_me) {
                Functions::setRememberMe($user_id);
            }

            $db->close();
            header("Location: /dashboard");
            exit();
        }
    
        $db->close();
        return false;        
    }

    /**
     * Starts a session safely
     *
     * @return void
     */
    public static function startSession() {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Logs out the user
     *
     * @return void
     */
    public static function logoutUser() {
        Functions::startSession();
        $_SESSION = [];
        session_destroy();
        session_regenerate_id(true);
        header("Location: /login");
        exit();
    }

    /**
     * Checks if fields are empty
     *
     * @param [type] $key
     * @return true if fields are set, false otherwise
     */
    public static function checkEmptyFields($key) {
        if (isset($key)) {
            return true;
        }   

        if (!empty($key)) {
            return true;
        }

        return false;
    }

    /**
     * Checks if a Brand Name already exists
     *
     * @param [type] $brand_name
     * @return true if already exists, false otherwise
     */
    public static function checkBrand($brand_name) {
        $db = new Database();
        $query = "SELECT COUNT(*) AS count FROM brand WHERE brand_name = ?";
        $exists = $db->query($query, $brand_name)->fetchArray()['count'] > 0;
        
        if ($exists) {
            $db->close();
            return true;
        }
        $db->close();
        return false;
    }
    /**
     * Registers a new brand
     *
     * @param [type] $brand_name
     * @return true if successfully registered, false otherwise
     */
    public static function registerBrand($brand_name) {
        Functions::startSession();

        if (Functions::checkBrand($brand_name)) {
            header("Location: /app/brands");
            exit();
        }

        $db = new Database();
        $query = "INSERT INTO brand (brand_name, user_id) VALUES (?, ?)";
        $result = $db->query($query, $brand_name, $_SESSION["user_id"]);
        
        if ($result) {
            $db->close();
            return true;
        }
        
        $db->close();
        return false;
    }

    /**
     * Returns all brands for admin_user and current_user
     *
     * @return $brands
     */
    public static function getAllBrands() {
        Functions::startSession();

        $main_user = 1;
        $current_user = $_SESSION["user_id"];

        $db = new Database();
        $brands = $db->query("SELECT * FROM brand WHERE user_id = ? OR user_id = ?", array($main_user, $current_user))->fetchAll();
        return $brands;
    }
    public static function checkRememberMe() {
        Functions::startSession();

        if (isset($_COOKIE['remember_me'])) {
            $token = $_COOKIE['remember_me'];

            $db = new Database();
            $token_query = "SELECT user_id FROM remember_me_tokens WHERE token = '$token' AND expires_at >= NOW()";
            $result = $db->query($token_query);

            if ($result && $row = $result->fetchArray()) {
                $user_id = $row["user_id"];
                $user_query = "SELECT user, user_name, user_mail FROM user WHERE user_id = ?";
                $user = $db->query($user_query, $user_id)->fetchArray();
                
                $_SESSION['user_id'] = $user["user_id"];
                $_SESSION['user_name'] = $user["user_name"];
                $_SESSION['user_mail'] = $user["user_mail"];
                
                $new_expires_at = date('Y-m-d H:i:s', strtotime('+30 days'));
                $update_query = "UPDATE remember_me_tokens SET expires_at = '$new_expires_at' WHERE token = '$token'";
                $db->query($update_query);

                setcookie('remember_me', $token, strtotime('+30 days'), '/');

                header('Location: dashboard.php');
                exit();
            }
        }
    }
    public static function setRememberMe($user_id) {

        if (isset($_COOKIE['remember_me'])) {
            Functions::checkRememberMe();
            
        } else {
            $token = bin2hex(random_bytes(32));
            $expires_at = date('Y-m-d H:i:s', strtotime('+30 days'));
            $db = new Database();
            $query = "INSERT INTO remember_me_tokens (user_id, token, expires_at) VALUES ($user_id, '$token', '$expires_at')";
            $db->query($query);
            setcookie('remember_me', $token, strtotime('+30 days'), '/');
        }
    }
}