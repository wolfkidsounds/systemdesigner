<?php
class Components {

    public static function ViewComponents() {
        require_once __DIR__ . '/components_views.php';
        return new ViewComponents();
    }

}