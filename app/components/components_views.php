<?php //module_views.php

class ViewComponents {

    public static function Partials() {
        require_once __DIR__ . "/components_views/partials.php";
        return new ViewPartials();
    }
}