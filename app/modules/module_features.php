<?php

class Features {
    public static function getSpeakerFeature() {
        //out("Speakers are currently a disabled feature");
        return true;
    }
    public static function getAmplifierFeature() {
        //out("Amplifiers are currently a disabled feature");
        return true;
    }
    public static function getLimiterFeature() {
        //out("Amplifiers are currently a disabled feature");
        return true;
    }
    public static function getProcessorFeature() {
        //out("Processors are currently a disabled feature");
        return true;
    }
    public static function getBrandFeature() {
        //out("Brands are currently a disabled feature");
        return true;
    }
    public static function getChassisFeature() {
        //out("Chassis are currently a disabled feature");
        return false;
    }
    public static function getRackFeature() {
        //out("Racks are currently a disabled feature");
        return false;
    }
    public static function getConfigurationFeature() {
        //out("Configurations are currently a disabled feature");
        return false;
    }
    public static function getManagementFeature() {
        //out("Managements are currently a disabled feature");
        return false;
    }
    public static function getDownloadsFeature() {
        //out("Downloads are currently a disabled feature");
        return false;
    }
    public static function getUserAccountFeature() {
        //out("User Accounts are currently a disabled feature");
        return true;
    }
    public static function getUserRegisterFeature() {
        //out("User Registration are currently a disabled feature");
        return true;
    }
    public static function getAPIFeature() {
        //out("User API requests are currently a disabled feature");
        return true;
    }

}