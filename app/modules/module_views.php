<?php //module_views.php

if (!defined("VIEWSPATH")) {
	define("VIEWSPATH", ABSPATH . "app/views/");
}
class Views {
    
    public function Index() {
        //out("found index in views");
        require_once(VIEWSPATH . "index.php");
    }
    public function Login() {
        //out("found login in views");
        require_once(VIEWSPATH . "login.php");
    }
    public function Logout() {
        //out("found login in views");
        require_once(VIEWSPATH . "logout.php");
    }
    public function App_Dashboard() {
        //out("found login in views");
        require_once(VIEWSPATH . "/app/dashboard.php");
    }
}