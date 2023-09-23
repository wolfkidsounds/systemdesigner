<?php //module_api.php

if (!defined("API_PATH")) {
	define("API_PATH", ABSPATH . "app/api/");
}
class API {
    public static function getProcessor() {
        require_once(API_PATH . 'get/processor.php');
    }

    public static function getAmplifier() {
        require_once(API_PATH . 'get/amplifier.php');
    }

    public static function getSpeaker() {
        require_once(API_PATH . 'get/speaker.php');
    }

    public static function calcLimiter() {
        require_once(API_PATH . 'calc/limiter.php');
    }
}