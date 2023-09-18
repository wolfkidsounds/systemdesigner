<?php //functions_processors.php

class Processors {

    public static function getAllProcessors() {
        Functions::startSession();

        $main_user = 1;
        $current_user = $_SESSION["user_id"];

        $db = new Database();
        $brands = $db->query("SELECT * FROM processor WHERE user_id = ? OR user_id = ?", array($main_user, $current_user))->fetchAll();
        return $brands;
    }

    public static function getProcessor($processor_id) {
        $db = new Database();
        $query = "SELECT * FROM processor WHERE id = ?";
        $brand = $db->query($query, $processor_id)->fetchArray();
        return $brand;
    }

    public static function checkProcessor($brand_name) {
        $db = new Database();
        $query = "SELECT COUNT(*) AS count FROM processor WHERE brand_name = ?";
        $exists = $db->query($query, $brand_name)->fetchArray()['count'] > 0;
        
        if ($exists) {
            $db->close();
            return true;
        }

        $db->close();
        return false;
    }

    public static function registerProcessor($brand_name, $model_name, $inputs, $outputs, $offset) {
        Functions::startSession();

        $db = new Database();
        $query = "INSERT INTO processor (brand_name, user_id, model_name, inputs, outputs, offset) VALUES (?, ?, ?, ?, ?, ?)";
        $result = $db->query($query, $brand_name, $_SESSION["user_id"], $model_name, $inputs, $outputs, $offset);
        
        if ($result) {
            $db->close();
            return true;
        }
        
        $db->close();
        return false;
    }

    /**
     * Updates a brand
     *
     * @param [type] $brand_id
     * @param [type] $brand_name
     * @return void
     */
    public static function updateProcessor($processor_id, $brand_name, $model_name, $inputs, $outputs, $offset) {
        $db = new Database();
        $query = "UPDATE processor SET brand_name = ?, model_name = ?, inputs = ?, outputs = ?, offset = ? WHERE id = ?";
        $db->query($query, $brand_name, $model_name, $inputs, $outputs, $offset, $processor_id);
    }
}