<?php //class.php

class Math {
    public static function bandwidthScaling($bandwidth) {
        $sub = 0.7;
        $lf = 0.65;
        $mf = 0.6;
        $hf = 0.55;
        $fr = 0.6;

        if ($bandwidth == "sub") { return $sub; }
        if ($bandwidth == "lf") { return $lf; }
        if ($bandwidth == "mf") { return $mf; }
        if ($bandwidth == "hf") { return $hf; }
        if ($bandwidth == "fr") { return $fr; }
    }
}