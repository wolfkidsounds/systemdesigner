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
}