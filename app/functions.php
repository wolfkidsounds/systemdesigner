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
     * @return void if the user was logged in succesfully, false otherwise
     */
    public static function loginUser($mail, $password) {
        Functions::startSession();
       
        $db = new Database();
        $query = "SELECT user, user_name, user_mail, user_pass FROM user WHERE user_mail = ?";
        $user = $db->query($query, $mail)->fetchArray();

        if ($user && password_verify($password, $user['user_pass'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['user'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['user_mail'] = $user['user_mail'];
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
        $query = "SELECT COUNT(*) AS count FROM brands WHERE brand_name = ?";
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

        $db = new Database();
        $query = "INSERT INTO brands (brand_name, user_id) VALUES (?, ?)";
        $result = $db->query($query, $brand_name, $_SESSION["user_id"]);
        
        if ($result) {
            $db->close();
            return true;
        }
        
        $db->close();
        return false;
    }
}