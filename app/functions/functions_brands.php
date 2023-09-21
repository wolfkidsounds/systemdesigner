<?php //functions_brands.php

class Brands {
    public static function getAll() {

        $load_all = filter_var(Functions::Users()->getSetting("show_registered_brands"), FILTER_VALIDATE_BOOLEAN);
        $main_user = 1;
        $current_user = Functions::Users()->getUserID();
        $db = new Database();

        if ($load_all === true) { $brands = $db->query("SELECT * FROM brand WHERE user_id = ? OR user_id = ?", array($main_user, $current_user))->fetchAll(); }
        else { $brands = $db->query("SELECT * FROM brand WHERE user_id = ?", array($current_user))->fetchAll(); }
        return $brands;
    }

    public static function count() {
        $current_user = Functions::Users()->getUserID();
        $db = new Database();
        $brands = $db->query("SELECT * FROM brand WHERE user_id = ?", array($current_user));
        return $brands->numRows();
    }

    public static function get($id) {
        $db = new Database();
        $query = "SELECT * FROM brand WHERE id = ?";
        $brand = $db->query($query, $id)->fetchArray();
        return $brand;
    }

    public static function check($name) {
        $user_id = Functions::Users()->getUserID();
        $db = new Database();
        $query = "SELECT COUNT(*) AS count FROM brand WHERE name = ? AND user_id =?";
        $count = $db->query($query, $name, $user_id)->fetchArray()['count'] > 0;
        return $count;
    }

    public static function set($name) {

        if (Functions::Brands()->check($name)) {
            header("Location: /app/brands");
            exit();
        }

        $db = new Database();
        $query = "INSERT INTO brand (name, user_id) VALUES (?, ?)";
        $result = $db->query($query, $name, $_SESSION["user_id"]);
        return $result;
    }

    public static function update($brand_id, $name) {
        $db = new Database();
        $query = "UPDATE brand SET name = ? WHERE id = ?";
        $db->query($query, $name, $brand_id);
    }

    public static function delete($brand_id) {
        $db = new Database();
        $query = "DELETE FROM brand WHERE id = ?";
        $result = $db->query($query, $brand_id);
        if ($result) {
            return json_encode(["success" => true]);
        } else {
            return json_encode(["success" => false]);
        }
    }
}