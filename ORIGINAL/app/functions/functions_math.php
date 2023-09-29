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

    public static function Vclip() {

    }

    public static function Vpeak() {

    }

    public static function Vrms() {

    }

    public static function Vgain() {
        

    }

    public static function Lim_Clip($v_clip, $v_input, $v_gain) {
        20*LOG10($v_clip/$v_input)-$v_gain;

    }

    public static function Lim_Peak($v_peak, $v_input, $v_gain) {
        20*LOG10($v_peak/$v_input)-$v_gain;
        
    }

    public static function Lim_Rms($v_rms, $v_input, $v_gain) {
        20*LOG10($v_rms/$v_input)-$v_gain;
        
    }
}