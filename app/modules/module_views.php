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
    public function Register() {
        //out("found login in views");
        require_once(VIEWSPATH . "register.php");
    }
    public function App_Dashboard() {
        //out("found App_Dashboard in views");
        require_once(VIEWSPATH . "app/dashboard.php");
    }
    public function App_Amplifiers() {
        //out("found App_Amplifiers in views");
        require_once(VIEWSPATH . "app/amplifiers.php");
    }
    public function Not_Found() {
        //out("found login in views");
        require_once(VIEWSPATH . "404.php");
    }
}