<?php //module_views.php

if (!defined("VIEWSPATH")) {
	define("VIEWSPATH", ABSPATH . "app/views/");
}
class Views {
    
    //General
    public function Index() {
        //out("found index in views");
        require_once(VIEWSPATH . "index.php");
    }

    //User Related
    public function Login() {
        //out("found login in views");
        require_once(VIEWSPATH . "login.php");
    }
    public function Register() {
        require_once(VIEWSPATH . "register.php");
    }
    public function User_Account() {
        require_once(VIEWSPATH . "user/account.php");
    }
    public function User_Settings() {
        require_once(VIEWSPATH . "user/settings.php");
    }

    //App Related
    public function App_Dashboard() {
        require_once(VIEWSPATH . "app/dashboard.php");
    }
    public function App_Version() {
        require_once(VIEWSPATH . "app/version.php");
    }

    //Brands
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

    //Processors
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

    //Amplifiers
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

    //Speakers
    public function App_Speakers() {
        require_once(VIEWSPATH . "app/speakers.php");
    }
    public function App_New_Speaker() {
        require_once(VIEWSPATH . "app/new/speaker.php");
    }
    public function App_Edit_Speaker($speaker_id) {
        $speaker_id = trim($speaker_id);
        require_once(VIEWSPATH . "app/edit/speaker.php");
    }

    //Limiters
    public function App_Limiters() {
        require_once(VIEWSPATH . "app/limiters.php");
    }
    public function App_New_Limiter() {
        require_once(VIEWSPATH . "app/new/limiter.php");
    }
    public function App_Edit_Limiter($limiter_id) {
        $limiter_id = trim($limiter_id);
        require_once(VIEWSPATH . "app/edit/limiter.php");
    }
}