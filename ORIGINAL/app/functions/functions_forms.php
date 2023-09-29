<?php //functions_user.php

class Forms {

    /**
     * Checks if fields are empty
     *
     * @param [type] $key
     * @return true if fields are set, false otherwise
     */
    public static function checkEmptyFields($key) {
        if (isset($key)) {
            return true;
        }   

        if (!empty($key)) {
            return true;
        }

        return false;
    }
}