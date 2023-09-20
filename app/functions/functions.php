<?php //functions.php

require_once ABSPATH . "database/database.php";

class Functions {
    public static function Users() {
        require_once __DIR__ . "/functions_users.php";
        return new Users();
    }
    public static function Forms() {
        require_once __DIR__ . "/functions_forms.php";
        return new Forms();
    }
    public static function Amplifiers() {
        require_once __DIR__ . "/functions_amplifiers.php";
        return new Amplifiers();
    }
    public static function Speakers() {
        require_once __DIR__ . "/functions_speakers.php";
        return new Speakers();
    }
    public static function Brands() {
        require_once __DIR__ . "/functions_brands.php";
        return new Brands();
    }
    public static function Processors() {
        require_once __DIR__ . "/functions_processors.php";
        return new Processors();
    }
    public static function Func_Modals() {
        require_once __DIR__ . "/functions_modals.php";
        return new Func_Modals();
    }
    public static function Toasts() {
        require_once __DIR__ . "/functions_toasts.php";
        return new Toasts();
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
    
}