<?php //functions_speakers.php

class Speakers {

    public static function getAll() {
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

    public static function check($brand_id, $name) {
        $db = new Database();
        $query = "SELECT COUNT(*) AS count FROM speaker WHERE brand_id = ? AND name = ?";
        $count = $db->query($query, $brand_id, $name)->fetchArray()['count'] > 0;
        return $count;
    }

    public static function get($id) {
        $db = new Database();
        $query = "SELECT * FROM speaker WHERE id = ?";
        $speaker = $db->query($query, $id)->fetchArray();
        return $speaker;
    }

    public static function set($user_id) {
        Functions::startSession();
        $db = new Database();
        $query = "INSERT INTO speaker (user_id) VALUES (?)";
        $db->query($query, $user_id);
        return $db->lastInsertID();
    }

    public static function setBrand($id, $brand_id) {
        Functions::startSession();
        $db = new Database();
        $query = "UPDATE speaker SET brand_id = ? WHERE id = ?";
        $db->query($query, $brand_id, $id);
    }

    public static function setName($id, $name) {
        Functions::startSession();
        $db = new Database();
        $query = "UPDATE speaker SET name = ? WHERE id = ?";
        $db->query($query, $name, $id);
    }

    public static function setType($id, $type) {
        Functions::startSession();
        $db = new Database();
        $query = "UPDATE speaker SET sp_type = ? WHERE id = ?";
        $db->query($query, $type, $id);
    }

    public static function setPower_RMS($id, $power_rms) {
        Functions::startSession();
        $db = new Database();
        $query = "UPDATE speaker SET power_rms = ? WHERE id = ?";
        $db->query($query, $power_rms, $id);
    }

    public static function setPower_Program($id, $power_program) {
        Functions::startSession();
        $db = new Database();
        $query = "UPDATE speaker SET power_program = ? WHERE id = ?";
        $db->query($query, $power_program, $id);
    }

    public static function setPower_Peak($id, $power_peak) {
        Functions::startSession();
        $db = new Database();
        $query = "UPDATE speaker SET power_peak = ? WHERE id = ?";
        $db->query($query, $power_peak, $id);
    }

    public static function setImpedance($id, $impedance) {
        Functions::startSession();
        $db = new Database();
        $query = "UPDATE speaker SET impedance = ? WHERE id = ?";
        $db->query($query, $impedance, $id);
    }

    public static function setVpeak($id, $vpeak) {
        Functions::startSession();
        $db = new Database();
        $query = "UPDATE speaker SET vpeak = ? WHERE id = ?";
        $db->query($query, $vpeak, $id);
    }

    public static function setVrms($id, $vrms) {
        Functions::startSession();
        $db = new Database();
        $query = "UPDATE speaker SET vrms = ? WHERE id = ?";
        $db->query($query, $vrms, $id);
    }

    public static function setSens($id, $sensitivity) {
        Functions::startSession();
        $db = new Database();
        $query = "UPDATE speaker SET sensitivity = ? WHERE id = ?";
        $db->query($query, $sensitivity, $id);
    }

    public static function setSPL($id, $max_spl) {
        Functions::startSession();
        $db = new Database();
        $query = "UPDATE speaker SET max_spl = ? WHERE id = ?";
        $db->query($query, $max_spl, $id);
    }

    public static function delete($id) {
        $db = new Database();
        $query = "DELETE FROM speaker WHERE id = ?";
        $result = $db->query($query, $id);
        if ($result) {
            return json_encode(["success" => true]);
        } else {
            return json_encode(["success" => false]);
        }
    }
}