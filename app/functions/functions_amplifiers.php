<?php //functions_amplifiers.php

class Amplifiers {

    public static function getAll() {
        Functions::startSession();

        $load_all = Functions::Users()->getSetting("show_registered_amplifiers");
        $main_user = 1;
        $current_user = Functions::Users()->getUserID();
        $db = new Database();

        if (isset($load_all) && $load_all == true) { $amplifiers = $db->query("SELECT * FROM amplifier WHERE user_id = ? OR user_id = ?", array($main_user, $current_user))->fetchAll(); }
        else { $amplifiers = $db->query("SELECT * FROM amplifier WHERE user_id = ?", array($current_user))->fetchAll(); }
        return $amplifiers;
    }

    public static function count() {
        Functions::startSession();
        $current_user = Functions::Users()->getUserID();
        $db = new Database();
        $amplifiers = $db->query("SELECT * FROM amplifier WHERE user_id = ?", array($current_user));
        return $amplifiers->numRows();
    }

    public static function get($id) {
        $db = new Database();
        $query = "SELECT * FROM amplifier WHERE id = ?";
        $amplifier = $db->query($query, $id)->fetchArray();
        return $amplifier;
    }

    public static function register($brand_id, $name, $rack_units, $ch_outputs) {
        Functions::startSession();

        if (Functions::Amplifiers()->checkAmplifier($brand_id, $name)) {
            header("Location: /app/amplifiers");
            exit();
        }

        $db = new Database();
        $query = "INSERT INTO amplifier (user_id, brand_id, name, rack_units, ch_outputs) VALUES (?, ?, ?, ?, ?)";
        $result = $db->query($query, $_SESSION["user_id"], $brand_id, $name, $rack_units, $ch_outputs);

        if ($result) {
            $amplifier_id = $db->lastInsertID();
            $db->close();
            return $amplifier_id;
        }
        
        $db->close();
        return false;

    }

    public static function check($brand_id, $name) {
        $db = new Database();
        $query = "SELECT COUNT(*) AS count FROM amplifier WHERE brand_id = ? AND name = ?";
        $exists = $db->query($query, $brand_id, $name)->fetchArray()['count'] > 0;
        
        if ($exists) {
            $db->close();
            return true;
        }
        
        $db->close();
        return false;
    }

    public static function update($id, $brand_id, $name, $rack_units, $ch_outputs) {
        $db = new Database();
        $query = "UPDATE amplifier SET brand_id = ?, name = ?, rack_units = ?, ch_outputs = ?, date_edited = NOW() WHERE id = ?";
        $db->query($query, $brand_id, $name, $rack_units, $ch_outputs, $id);
        $db->close();        
    }

    public static function updatePower($id, $amp_power, $amp_vpeak, $amp_vgain, $ohm, $bridge) {
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
}