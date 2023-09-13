<?php
class Modules {

    public static function Views() {
        require_once __DIR__ . '/module_views.php';
        return new Views();
    }

}