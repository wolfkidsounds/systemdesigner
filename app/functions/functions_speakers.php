<?php //functions_speakers.php

class Speakers {

    public static function getAllSpeakes() {
        Functions::startSession();

        $load_all = Functions::Users()->getSetting("show_registered_speakers");
        $main_user = 1;
        $current_user = Functions::Users()->getUserID();
        $db = new Database();

        if (isset($load_all) && $load_all == true) {
            $speakers = $db->query("SELECT * FROM speaker WHERE user_id = ? OR user_id = ?", array($main_user, $current_user))->fetchAll();
        } else {
            $speakers = $db->query("SELECT * FROM speaker WHERE user_id = ?", array($current_user))->fetchAll();
        }
        return $speakers;
    }

    public static function count() {
        Functions::startSession();
        $current_user = Functions::Users()->getUserID();
        $db = new Database();
        $speakers = $db->query("SELECT * FROM speaker WHERE user_id = ?", array($current_user));
        return $speakers->numRows();
    }
}