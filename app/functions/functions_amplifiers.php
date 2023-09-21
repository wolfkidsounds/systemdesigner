<?php //functions_amplifiers.php

class Amplifiers {

    public static function getAll() {
        $load_all = filter_var(Functions::Users()->getSetting("show_registered_amplifiers"), FILTER_VALIDATE_BOOLEAN);
        $main_user = 1;
        $current_user = Functions::Users()->getUserID();
        $db = new Database();

        if ($load_all === true) { 
            $amplifiers = $db->query("SELECT * FROM amplifier WHERE user_id = ? OR user_id = ?", array($main_user, $current_user))->fetchAll(); 
        } else { 
            $amplifiers = $db->query("SELECT * FROM amplifier WHERE user_id = ?", array($current_user))->fetchAll(); 
        }

        return $amplifiers;
    }

    public static function count() {
        $current_user = Functions::Users()->getUserID();
        $db = new Database();
        $amplifiers = $db->query("SELECT * FROM amplifier WHERE user_id = ?", array($current_user));
        return $amplifiers->numRows();
    }

    public static function check($brand_id, $name) {
        $user_id = Functions::Users()->getUserID();
        $db = new Database();
        $query = "SELECT COUNT(*) AS count FROM amplifier WHERE brand_id = ? AND name = ? AND user_id =?";
        $count = $db->query($query, $brand_id, $name, $user_id)->fetchArray()['count'] > 0;
        return $count;
    }

    public static function get($id) {
        $db = new Database();
        $query = "SELECT * FROM amplifier WHERE id = ?";
        $amplifier = $db->query($query, $id)->fetchArray();
        return $amplifier;
    }

    public static function set($user_id) {
        $db = new Database();
        $query = "INSERT INTO amplifier (user_id) VALUES (?)";
        $db->query($query, $user_id);
        return $db->lastInsertID();
    }

    public static function setBrand($id, $brand_id) {
        $db = new Database();
        $query = "UPDATE amplifier SET brand_id = ? WHERE id = ?";
        $db->query($query, $brand_id, $id);
    }

    public static function setName($id, $name) {
        $db = new Database();
        $query = "UPDATE amplifier SET name = ? WHERE id = ?";
        $db->query($query, $name, $id);
    }

    public static function setHeight($id, $rack_units) {
        $db = new Database();
        $query = "UPDATE amplifier SET rack_units = ? WHERE id = ?";
        $db->query($query, $rack_units, $id);
    }

    public static function setOutputs($id, $ch_outputs) {
        $db = new Database();
        $query = "UPDATE amplifier SET ch_outputs = ? WHERE id = ?";
        $db->query($query, $ch_outputs, $id);
    }

    public static function setFile($id, $file_attachment) {
        $db = new Database();
        $query = "UPDATE amplifier SET file_attachment = ? WHERE id = ?";
        $db->query($query, $file_attachment, $id);
    }

    public static function setPower($id, $amp_power, $amp_vpeak, $amp_vgain, $ohm, $bridge) {
        $db = new Database();
        if ($bridge) {
            $amp_power_column = "amp_power_bridge_" . $ohm;
            $amp_vpeak_column = "amp_vpeak_bridge_" . $ohm;
            $amp_vgain_column = "amp_vgain_bridge_" . $ohm;
        } else {
            $amp_power_column = "amp_power_" . $ohm;
            $amp_vpeak_column = "amp_vpeak_" . $ohm;
            $amp_vgain_column = "amp_vgain_" . $ohm;
        }
    
        $query = "UPDATE amplifier SET $amp_power_column = ?, $amp_vpeak_column = ?, $amp_vgain_column = ?, date_edited = NOW() WHERE id = ?";
        $db->query($query, $amp_power, $amp_vpeak, $amp_vgain, $id);
        $db->close();
    }

    public static function delete($id) {
        $db = new Database();
        $query = "DELETE FROM amplifier WHERE id = ?";
        $result = $db->query($query, $id);
        if ($result) {
            return json_encode(["success" => true]);
        } else {
            return json_encode(["success" => false]);
        }
    }
}