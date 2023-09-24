<?php //functions_limters.php

class Limiters {
    public static function getAll() {

        $load_all = filter_var(Functions::Users()->getSetting("show_registered_limiters"), FILTER_VALIDATE_BOOLEAN);
        $main_user = 1;
        $current_user = Functions::Users()->getUserID();
        $db = new Database();

        if ($load_all === true) { $limiters = $db->query("SELECT * FROM limiter WHERE user_id = ? OR user_id = ?", array($main_user, $current_user))->fetchAll(); }
        else { $limiters = $db->query("SELECT * FROM limiter WHERE user_id = ?", array($current_user))->fetchAll(); }
        return $limiters;
    }

    public static function count() {
        $current_user = Functions::Users()->getUserID();
        $db = new Database();
        $limiters = $db->query("SELECT * FROM limiter WHERE user_id = ?", array($current_user));
        return $limiters->numRows();
    }

    public static function get($id) {
        $db = new Database();
        $query = "SELECT * FROM limiter WHERE id = ?";
        $limiter = $db->query($query, $id)->fetchArray();
        return $limiter;
    }

    public static function check($name) {
        $user_id = Functions::Users()->getUserID();
        $db = new Database();
        $query = "SELECT COUNT(*) AS count FROM limiter WHERE name = ? AND user_id =?";
        $count = $db->query($query, $name, $user_id)->fetchArray()['count'] > 0;
        return $count;
    }

    public static function set($name) {
        if (Functions::Limiters()->check($name)) {
            header("Location: /app/limiter");
            exit();
        }

        $db = new Database();
        $query = "INSERT INTO limiter (name, user_id) VALUES (?, ?)";
        $result = $db->query($query, $name, $_SESSION["user_id"]);
        return $result;
    }

    public static function setProcessor($id, $processor_id) {
        $db = new Database();
        $query = "UPDATE limiter SET processor_id = ? WHERE id = ?";
        $db->query($query, $processor_id, $id);
    }

    public static function setAmplifier($id, $amplifier_id) {
        $db = new Database();
        $query = "UPDATE limiter SET amplifier_id = ? WHERE id = ?";
        $db->query($query, $amplifier_id, $id);
    }

    public static function setSpeaker($id, $speaker_id) {
        $db = new Database();
        $query = "UPDATE limiter SET speaker_id = ? WHERE id = ?";
        $db->query($query, $speaker_id, $id);
    }

    public static function setValue($id, $lim_value) {
        $db = new Database();
        $query = "UPDATE limiter SET lim_value = ? WHERE id = ?";
        $db->query($query, $lim_value, $id);
    }

    public static function delete($limiter_id) {
        $db = new Database();
        $query = "DELETE FROM limiter WHERE id = ?";
        $result = $db->query($query, $limiter_id);
        if ($result) {
            return json_encode(["success" => true]);
        } else {
            return json_encode(["success" => false]);
        }
    }
}