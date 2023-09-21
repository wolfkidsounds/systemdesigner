<?php //functions_user.php

class Users {

    /**
     * Checks if a user is logged in
     *
     * @return true if the user is logged in, false otherwise.
     */
    public static function checkLogin() {
        if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_mail'])) {
            return true;
        }   

        if (!empty($_SESSION['user_id']) || !empty($_SESSION['user_name']) || !empty($_SESSION['user_mail'])) {
            return true;
        }

        return false;
    }

    /**
     * Checks if a user already exists
     *
     * @param [type] $mail
     * @return true if a user exists, false otherwise
     */
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

    public static function getUser($user_id) {
        $db = new Database();
        $query = "SELECT * FROM user WHERE id = ?";
        $user = $db->query($query, $user_id)->fetchArray();
        return $user;
    }

    /**
     * Logs in a user
     *
     * @param [type] $mail
     * @param [type] $password
     * @return boolean if the user was logged in succesfully, false otherwise
     */
    public static function loginUser($mail, $password, $remember_me) {       
        $db = new Database();
        $query = "SELECT id, user_name, user_mail, user_pass FROM user WHERE user_mail = ?";
        $user = $db->query($query, $mail)->fetchArray();

        if ($user && password_verify($password, $user['user_pass'])) {
            session_regenerate_id(true);
            $user_id = $user['id'];
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['user_mail'] = $user['user_mail'];

            // if ($remember_me) {
            //     Functions::Users()->setRememberMe($user_id);
            // }

            $db->close();
            header("Location: /dashboard");
            exit();
        }
    
        $db->close();
        return false;        
    }

    /**
     * Logs out the user
     *
     * @return void
     */
    public static function logoutUser() {
        $_SESSION = [];
        session_destroy();
        session_regenerate_id(true);
        header("Location: /login");
        exit();
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
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $db = new Database();
        $query = "INSERT INTO user (user_name, user_mail, user_pass) VALUES (?, ?, ?)";
        $result = $db->query($query, $name, $mail, $hashed_password);
        
        if ($result) {
            $user_id = $db->lastInsertID();
            Functions::Users()->createSettings($user_id);

            $db->close();
            return true;
        }
        
        $db->close();
        return false;
    }

    public static function getAllSettings($user_id) {
        $db = new Database();
        $query = "SELECT * FROM user_settings WHERE user_id = ?";
        $settings = $db->query($query, $user_id)->fetchAll();
        return $settings;
    }

    public static function getSetting($key) {
        $user_id = Functions::Users()->getUserID();
        $db = new Database();
        $query = "SELECT * FROM user_settings WHERE setting_key = ? AND user_id = ?";
        $setting = $db->query($query, $key, $user_id)->fetchArray();
        return $setting["setting_value"];
    }

    public static function setSetting() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = json_decode(file_get_contents("php://input"));
            $key = $data->optionName;
            $value = $data->isChecked;
            $user_id = Functions::Users()->getUserID();

            if (isset($value) && $value == "checked") {
                $value = "true";

            } else {
                $value = "false";
            }
            
            $db = new Database();
            $query = "UPDATE user_settings SET setting_value = ? WHERE user_id = ? AND setting_key = ?";
            $result = $db->query($query, $value, $user_id, $key);
            $db->close();

            return $result;
        }
    }

    public static function createSettings($user_id) {
        $db = new Database();
        $settings = array (
            'show_registered_amplifiers' => 'true',
            'show_registered_speakers' => 'true',
            'show_registered_chassis' => 'true',
            'show_registered_brands' => 'true',
            'show_registered_processors' => 'true',
            'show_registered_limiters' => 'true',
        );

        foreach ($settings as $setting_key => $setting_value) {
            $query = "INSERT INTO user_settings (user_id, setting_key, setting_value) VALUES (?, ?, ?)";
            $db->query($query, $user_id, $setting_key, $setting_value);
        }

        $db->close();
    }

    public static function getUserID() {
        return $_SESSION["user_id"];
    }

    // public static function checkRememberMe() {
    //     Functions::startSession();
    // 
    //     if (isset($_COOKIE['remember_me'])) {
    //         $token = $_COOKIE['remember_me'];
    // 
    //         $db = new Database();
    //         $token_query = "SELECT user_id FROM remember_me_tokens WHERE token = '$token' AND expires_at >= NOW()";
    //         $result = $db->query($token_query);
    // 
    //         if ($result && $row = $result->fetchArray()) {
    //             $user_id = $row["user_id"];
    //             $user_query = "SELECT id, user_name, user_mail FROM user WHERE user_id = ?";
    //             $user = $db->query($user_query, $user_id)->fetchArray();
    //             
    //             $_SESSION['user_id'] = $user["id"];
    //             $_SESSION['user_name'] = $user["user_name"];
    //             $_SESSION['user_mail'] = $user["user_mail"];
    //             
    //             $new_expires_at = date('Y-m-d H:i:s', strtotime('+30 days'));
    //             $update_query = "UPDATE remember_me_tokens SET expires_at = '$new_expires_at' WHERE token = '$token'";
    //             $db->query($update_query);
    // 
    //             setcookie('remember_me', $token, strtotime('+30 days'), '/');
    // 
    //             header('Location: dashboard.php');
    //             exit();
    //         }
    //     }
    // }

    // public static function setRememberMe($user_id) {
    // 
    //     if (isset($_COOKIE['remember_me'])) {
    //         Functions::Users()->checkRememberMe();
    //         
    //     } else {
    //         $token = bin2hex(random_bytes(32));
    //         $expires_at = date('Y-m-d H:i:s', strtotime('+30 days'));
    //         $db = new Database();
    //         $query = "INSERT INTO remember_me_tokens (user_id, token, expires_at) VALUES ($user_id, '$token', '$expires_at')";
    //         $db->query($query);
    //         setcookie('remember_me', $token, strtotime('+30 days'), '/');
    //     }
    // }
}