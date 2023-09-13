<?php //module_views.php

if (!defined("VIEWSPATH")) {
	define("VIEWSPATH", ABSPATH . "app/views/");
}

require_once(Modules::Components()->ViewComponents());

class Views {
    
    public function Index() {
        ViewComponents::Partials()->OpenHTML();
        ViewComponents::Partials()->Styles();
        ViewComponents::Partials()->Header();
        ViewComponents::Partials()->Navigation();
        ViewComponents::Partials()->Sidebar();
        require_once(VIEWSPATH . "index.php");
        ViewComponents::Partials()->Footer();
        ViewComponents::Partials()->Scripts();
        ViewComponents::Partials()->CloseHTML();
    }

}