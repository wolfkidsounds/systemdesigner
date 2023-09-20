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
    public function Register() {
        require_once(VIEWSPATH . "register.php");
    }
    public function App_Dashboard() {
        require_once(VIEWSPATH . "app/dashboard.php");
    }
    public function App_Amplifiers() {
        require_once(VIEWSPATH . "app/amplifiers.php");
    }
    public function App_New_Amplifier() {
        require_once(VIEWSPATH . "app/new/amplifier.php");
    }
    public function App_Edit_Amplifier($amplifier_id) {
        $amplifier_id = trim($amplifier_id);
        require_once(VIEWSPATH . "app/edit/amplifier.php");
    }
    public function App_Speakers() {
        require_once(VIEWSPATH . "app/speakers.php");
    }
    public function App_Processors() {
        require_once(VIEWSPATH . "app/processors.php");
    }
    public function App_New_Processor() {
        require_once(VIEWSPATH . "app/new/processor.php");
    }
    public function App_Edit_Processor($processor_id) {
        $processor_id = trim($processor_id);
        require_once(VIEWSPATH . "app/edit/processor.php");
    }
    public function App_Brands() {
        require_once(VIEWSPATH . "app/brands.php");
    }
    public function App_New_Brand() {
        require_once(VIEWSPATH . "app/new/brand.php");
    }
    public function App_Edit_Brand($brand_id) {
        $brand_id = trim($brand_id);
        require_once(VIEWSPATH . "app/edit/brand.php");
    }
    public function App_Setups() {
        require_once(VIEWSPATH . "app/setups.php");
    }
    public function App_New_Setup() {
        require_once(VIEWSPATH . "app/new/setup.php");
    }
    public function App_Edit_Setup($amplifier_id) {
        $amplifier_id = trim($amplifier_id);
        require_once(VIEWSPATH . "app/edit/setup.php");
    }
    public function User_Account() {
        require_once(VIEWSPATH . "user/account.php");
    }
    public function User_Settings() {
        require_once(VIEWSPATH . "user/settings.php");
    }
    public function App_Version() {
        require_once(VIEWSPATH . "app/version.php");
    }
    public function Not_Found() {
        require_once(VIEWSPATH . "404.php");
    }
}