<?php //module_views.php

if (!defined("VIEWSPATH")) {
	define("VIEWSPATH", ABSPATH . "app/views/");
}
class Modals {
    public static function OpenModal($type, $action, $rack_id) {
        if ($type == "rack") {
            Functions::Func_Modals()->Racks($action, $rack_id);            
        }

    }
}