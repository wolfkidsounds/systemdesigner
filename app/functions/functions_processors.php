<?php //functions_processors.php

class Processors {
    public static function getAll() {

        $load_all = filter_var(Functions::Users()->getSetting("show_registered_processors"), FILTER_VALIDATE_BOOLEAN);
        $main_user = 1;
        $current_user = Functions::Users()->getUserID();
        $db = new Database();

        if ($load_all === true) { $processors = $db->query("SELECT * FROM processor WHERE user_id = ? OR user_id = ?", array($main_user, $current_user))->fetchAll(); }
        else { $processors = $db->query("SELECT * FROM processor WHERE user_id = ?", array($current_user))->fetchAll(); }
        return $processors;
    }

    public static function count() {
        $current_user = Functions::Users()->getUserID();
        $db = new Database();
        $processors = $db->query("SELECT * FROM processor WHERE user_id = ?", array($current_user));
        return $processors->numRows();
    }

    public static function get($id) {
        $db = new Database();
        $query = "SELECT * FROM processor WHERE id = ?";
        $processor = $db->query($query, $id)->fetchArray();
        return $processor;
    }

    public static function check($brand_id, $name) {
        $user_id = Functions::Users()->getUserID();
        $db = new Database();
        $query = "SELECT COUNT(*) AS count FROM processor WHERE brand_id = ? AND name = ? AND user_id =?";
        $count = $db->query($query, $brand_id, $name, $user_id)->fetchArray()['count'] > 0;
        return $count;
    }

    public static function set($user_id) {
        $db = new Database();
        $query = "INSERT INTO processor (user_id) VALUES (?)";
        $db->query($query, $user_id);
        return $db->lastInsertID();
    }

    public static function setBrand($id, $brand_id) {
        $db = new Database();
        $query = "UPDATE processor SET brand_id = ? WHERE id = ?";
        $db->query($query, $brand_id, $id);
    }

    public static function setName($id, $name) {
        $db = new Database();
        $query = "UPDATE processor SET name = ? WHERE id = ?";
        $db->query($query, $name, $id);
    }

    public static function setInputs($id, $ch_inputs) {
        $db = new Database();
        $query = "UPDATE processor SET ch_inputs = ? WHERE id = ?";
        $db->query($query, $ch_inputs, $id);
    }

    public static function setOutputs($id, $ch_outputs) {
        $db = new Database();
        $query = "UPDATE processor SET ch_outputs = ? WHERE id = ?";
        $db->query($query, $ch_outputs, $id);
    }

    public static function setOffset($id, $proc_offset) {
        $db = new Database();
        $query = "UPDATE processor SET proc_offset = ? WHERE id = ?";
        $db->query($query, $proc_offset, $id);
    }

    public static function setFile($id, $file_attachment) {
        $db = new Database();
        $query = "UPDATE processor SET file_attachment = ? WHERE id = ?";
        $db->query($query, $file_attachment, $id);
    }

    public static function delete($id) {
        $db = new Database();
        $query = "DELETE FROM processor WHERE id = ?";
        $result = $db->query($query, $id);
        if ($result) {
            return json_encode(["success" => true]);
        } else {
            return json_encode(["success" => false]);
        }
    }
}