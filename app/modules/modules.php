<?php // modules.php
class Modules {
    public static function Views() {
        //out("found views in modules");
        require_once __DIR__ . '/module_views.php';
        return new Views();
    }
    public static function Translator() {
        //out("found translator in modules");
        require_once __DIR__ . "/module_translator.php";
        return new Translator();
    }

    public static function Modals() {
        //out("found translator in modules");
        require_once __DIR__ . "/module_modal.php";
        return new Modals();
    }

    public static function Features() {
        require_once __DIR__ . "/module_features.php";
        return new Features();
    }

    public static function API() {
        require_once __DIR__ . "/module_api.php";
        return new API();
    }
}