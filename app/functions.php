<?php //functions.php
class Functions {
    public static function checkUserLoggedIn() {
        if (isset($_SESSION["user_id"])) {
            return true;
        }   
        if (!empty($_SESSION["user_id"])) {
            return true;
        }
        return false;
    }
}