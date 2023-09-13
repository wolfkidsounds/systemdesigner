<?php //functions.php

class Functions {
    public static function checkUserLoggedIn() {
        $user_loggedIn = $_SESSION["user_id"];
    
        if (isset($user_loggedIn)) {
            return true;
        }
    
        if (!empty($user_loggedIn)) {
            return true;
        }
        return false;
    }
}