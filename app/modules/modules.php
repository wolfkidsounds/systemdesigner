<?php // modules.php
class Modules {
    public static function Views() {
        require_once __DIR__ . '/module_views.php';
        return new Views();
    }
    public static function Components() {
        require_once ABSPATH . "app/components/components.php";
        return new Components();
    }
    public static function Translator() {
        require_once __DIR__ . "/module_translator.php";
        return new Translator();
    }
}