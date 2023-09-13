<?php //inc_partials.php

class Partials {
    public static function Open() {
        require_once __DIR__ . "/open.php";
    }
    public static function Header($navigation, $sidebar) {
        require_once __DIR__ . "/header.php";

        if ($navigation) {
            require_once __DIR__ . "/navigation.php";
        }

        if ($sidebar) {
            require_once __DIR__ . "/sidebar.php";
        }
    }
    public static function Footer() {
        require_once __DIR__ . "/footer.php";
    }
    public static function Close() {
        require_once __DIR__ . "/close.php";
    }
}