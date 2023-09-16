<?php //functions_amplifiers.php

class Amplifiers {

    public static function getAllAmplifiers() {
        Functions::startSession();

        $main_user = 1;
        $current_user = $_SESSION["user_id"];

        $db = new Database();
        $amplifiers = $db->query("SELECT * FROM amplifier WHERE user_id = ? OR user_id = ?", array($main_user, $current_user))->fetchAll();
        return $amplifiers;
    }

    public static function checkAmplifier($brand_name, $model_name) {
        $db = new Database();
        $query = "SELECT COUNT(*) AS count FROM amplifier WHERE amp_brand = ? AND amp_model = ?";
        $exists = $db->query($query, $brand_name, $model_name)->fetchArray()['count'] > 0;
        
        if ($exists) {
            $db->close();
            return true;
        }
        $db->close();
        return false;
    }

    public static function registerAmplifierModel($brand_name, $model_name, $amp_height, $amp_channels) {
        Functions::startSession();

        if (Functions::Amplifiers()->checkAmplifier($brand_name, $model_name)) {
            header("Location: /app/amplifiers");
            exit();
        }

        $db = new Database();
        $query = "INSERT INTO amplifier (user_id, amp_brand, amp_model, amp_ru, amp_ch) VALUES (?, ?, ?, ?, ?)";
        $result = $db->query($query, $_SESSION["user_id"], $brand_name, $model_name, $amp_height, $amp_channels);

        if ($result) {
            $amplifier_id = $db->lastInsertID();
            $db->close();
            return $amplifier_id;
        }
        
        $db->close();
        return false;
    }

    public static function registerAmplifierPower($amplifier_id, $amp_power, $amp_vpeak, $amp_vgain, $ohm, $bridge) {
        Functions::startSession();
    
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
    
        $query = "UPDATE amplifier SET $amp_power_column = ?, $amp_vpeak_column = ?, $amp_vgain_column = ? WHERE id = ?";
        $db->query($query, $amp_power, $amp_vpeak, $amp_vgain, $amplifier_id);
        $db->close();
    }
}