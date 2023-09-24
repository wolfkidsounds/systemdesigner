<?php //functions_speakers.php

class Speakers {

    public static function getAll() {

        $load_all = filter_var(Functions::Users()->getSetting("show_registered_speakers"), FILTER_VALIDATE_BOOLEAN);
        $main_user = 1;
        $current_user = Functions::Users()->getUserID();
        $db = new Database();

        if ($load_all === true) { 
            $speakers = $db->query("SELECT * FROM speaker WHERE user_id = ? OR user_id = ?", array($main_user, $current_user))->fetchAll(); 
        } else { 
            $speakers = $db->query("SELECT * FROM speaker WHERE user_id = ?", array($current_user))->fetchAll(); 
        }

        return $speakers;
    }

    public static function count() {
        $current_user = Functions::Users()->getUserID();
        $db = new Database();
        $speakers = $db->query("SELECT * FROM speaker WHERE user_id = ?", array($current_user));
        return $speakers->numRows();
    }

    public static function check($brand_id, $name) {
        $user_id = Functions::Users()->getUserID();
        $db = new Database();
        $query = "SELECT COUNT(*) AS count FROM speaker WHERE brand_id = ? AND name = ? AND user_id =?";
        $count = $db->query($query, $brand_id, $name, $user_id)->fetchArray()['count'] > 0;
        return $count;
    }

    public static function get($id) {
        $db = new Database();
        $query = "SELECT * FROM speaker WHERE id = ?";
        $speaker = $db->query($query, $id)->fetchArray();
        return $speaker;
    }

    public static function set($user_id) {
        $db = new Database();
        $query = "INSERT INTO speaker (user_id) VALUES (?)";
        $db->query($query, $user_id);
        return $db->lastInsertID();
    }

    public static function setBrand($id, $brand_id) {
        $db = new Database();
        $query = "UPDATE speaker SET brand_id = ? WHERE id = ?";
        $db->query($query, $brand_id, $id);
    }

    public static function setName($id, $name) {
        $db = new Database();
        $query = "UPDATE speaker SET name = ? WHERE id = ?";
        $db->query($query, $name, $id);
    }

    public static function setBandwidth($id, $bandwith) {
        $db = new Database();
        $query = "UPDATE speaker SET bandwidth = ? WHERE id = ?";
        $db->query($query, $bandwith, $id);
    }

    public static function setPower_RMS($id, $power_rms) {
        $db = new Database();
        $query = "UPDATE speaker SET power_rms = ? WHERE id = ?";
        $db->query($query, $power_rms, $id);
    }

    public static function setPower_Program($id, $power_program) {
        $db = new Database();
        $query = "UPDATE speaker SET power_program = ? WHERE id = ?";
        $db->query($query, $power_program, $id);
    }

    public static function setPower_Peak($id, $power_peak) {
        $db = new Database();
        $query = "UPDATE speaker SET power_peak = ? WHERE id = ?";
        $db->query($query, $power_peak, $id);
    }

    public static function setImpedance($id, $impedance) {
        $db = new Database();
        $query = "UPDATE speaker SET impedance = ? WHERE id = ?";
        $db->query($query, $impedance, $id);
    }

    public static function setVpeak($id, $vpeak) {
        $db = new Database();
        $query = "UPDATE speaker SET vpeak = ? WHERE id = ?";
        $db->query($query, $vpeak, $id);
    }

    public static function setVrms($id, $vrms) {
        $db = new Database();
        $query = "UPDATE speaker SET vrms = ? WHERE id = ?";
        $db->query($query, $vrms, $id);
    }

    public static function setSens($id, $sensitivity) {
        $db = new Database();
        $query = "UPDATE speaker SET sensitivity = ? WHERE id = ?";
        $db->query($query, $sensitivity, $id);
    }

    public static function setSPL($id, $max_spl) {
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