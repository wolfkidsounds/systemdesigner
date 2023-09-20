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
        require_once(VIEWSPATH . "user/logout.php");
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
    public function App_New_Amplifier() {
        //out("found App_Amplifiers in views");
        require_once(VIEWSPATH . "app/new/amplifier.php");
    }
    public function App_Edit_Amplifier($amplifier_id) {
        $amplifier_id = trim($amplifier_id);
        //out("found App_Amplifiers in views");
        require_once(VIEWSPATH . "app/edit/amplifier.php");
    }
    public function App_Speakers() {
        //out("found App_Amplifiers in views");
        require_once(VIEWSPATH . "app/speakers.php");
    }
    public function App_Processors() {
        //out("found App_Amplifiers in views");
        require_once(VIEWSPATH . "app/processors.php");
    }
    public function App_New_Processor() {
        //out("found App_Amplifiers in views");
        require_once(VIEWSPATH . "app/new/processor.php");
    }
    public function App_Edit_Processor($processor_id) {
        $processor_id = trim($processor_id);
        //out("found App_processors in views");
        require_once(VIEWSPATH . "app/edit/processor.php");
    }
    public function App_Brands() {
        //out("found App_Amplifiers in views");
        require_once(VIEWSPATH . "app/brands.php");
    }
    public function App_New_Brand() {
        //out("found App_Amplifiers in views");
        require_once(VIEWSPATH . "app/new/brand.php");
    }
    public function App_Edit_Brand($brand_id) {
        $brand_id = trim($brand_id);
        //out("found App Brand in views");
        require_once(VIEWSPATH . "app/edit/brand.php");
    }
    public function App_Setups() {
        //out("found App_Amplifiers in views");
        require_once(VIEWSPATH . "app/setups.php");
    }
    public function App_New_Setup() {
        //out("found App_Amplifiers in views");
        require_once(VIEWSPATH . "app/new/setup.php");
    }
    public function App_Edit_Setup($amplifier_id) {
        $amplifier_id = trim($amplifier_id);
        //out("found App_Amplifiers in views");
        require_once(VIEWSPATH . "app/edit/setup.php");
    }
    public function User_Account() {
        //out("found App_Amplifiers in views");
        require_once(VIEWSPATH . "user/account.php");
    }
    public function Not_Found() {
        //out("found login in views");
        require_once(VIEWSPATH . "404.php");
    }
}