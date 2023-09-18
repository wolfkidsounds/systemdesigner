<?php //functions_brands.php

class Brands {

    /**
     * Returns all brands for admin_user and current_user
     *
     * @return $brands
     */
    public static function getAllBrands() {
        Functions::startSession();

        $main_user = 1;
        $current_user = $_SESSION["user_id"];

        $db = new Database();
        $brands = $db->query("SELECT * FROM brand WHERE user_id = ? OR user_id = ?", array($main_user, $current_user))->fetchAll();
        return $brands;
    }

    public static function getBrand($brand_id) {
        $db = new Database();
        $query = "SELECT * FROM brand WHERE id = ?";
        $brand = $db->query($query, $brand_id)->fetchArray();
        return $brand;
    }

    /**
     * Checks if a Brand Name already exists
     *
     * @param [type] $brand_name
     * @return true if already exists, false otherwise
     */
    public static function checkBrand($brand_name) {
        $db = new Database();
        $query = "SELECT COUNT(*) AS count FROM brand WHERE brand_name = ?";
        $exists = $db->query($query, $brand_name)->fetchArray()['count'] > 0;
        
        if ($exists) {
            $db->close();
            return true;
        }
        $db->close();
        return false;
    }

    /**
     * Registers a new brand
     *
     * @param [type] $brand_name
     * @return true if successfully registered, false otherwise
     */
    public static function registerBrand($brand_name) {
        Functions::startSession();

        if (Functions::Brands()->checkBrand($brand_name)) {
            header("Location: /app/brands");
            exit();
        }

        $db = new Database();
        $query = "INSERT INTO brand (brand_name, user_id) VALUES (?, ?)";
        $result = $db->query($query, $brand_name, $_SESSION["user_id"]);
        
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
    public static function updateBrand($brand_id, $brand_name) {
        $db = new Database();
        $query = "UPDATE brand SET brand_name = ? WHERE id = ?";
        $db->query($query, $brand_name, $brand_id);
    }
}