<?php

class Limiter_Functions {
    /**
     * RMS Release Time
     *
     * @param string $bandwidth Bandwidth as string ("SUB", "LF", "MF", "HF", "FR")
     * @return string $release_time
     */
    public static function getRMSReleaseTime(string $bandwidth) {
        $lim_rms_release = '';

        $lim_rms_releases = array(
            "SUB" => "4000-8000",
            "LF" => "2000-4000",
            "MF" => "500-2000",
            "FR" => "500-2000",
            "HF" => "300-800",
        );

        if (array_key_exists($bandwidth, $lim_rms_releases)) {
            $lim_rms_release = $lim_rms_releases[$bandwidth];
        }
        
        return $lim_rms_release;
    }

    /**
     * RMS Attack Time
     *
     * @param string $bandwidth Bandwidth as string ("SUB", "LF", "MF", "HF", "FR")
     * @return string $attack_time
     */
    public static function getRMSAttackTime($bandwidth) {
        $lim_rms_attack = '';

        $lim_rms_attacks = array(
            "SUB" => "2000-4000",
            "LF" => "1000-2000",
            "MF" => "300-800",
            "FR" => "300-800",
            "HF" => "150-300",
        );
        
        if (array_key_exists($bandwidth, $lim_rms_attacks)) {
            $lim_rms_attack = $lim_rms_attacks[$bandwidth];
        }

        return $lim_rms_attack;
    }

    /**
     * Peak Release Time
     *
     * @param string $bandwidth Bandwidth as string ("SUB", "LF", "MF", "HF", "FR")
     * @return string $release_time
     */
    public static function getPeakReleaseTime ($bandwidth) {
        $peak_release_time = '';

        $lim_peak_releases = array(
            "SUB" => "128-384",
            "LF" => "64-256",
            "MF" => "16-64",
            "FR" => "16-64",
            "HF" => "8-32",
        );
        
        if (array_key_exists($bandwidth, $lim_peak_releases)) {
            $peak_release_time = $lim_peak_releases[$bandwidth];
        }

        return $peak_release_time;
    }

    /**
     * Peak Attack Time
     *
     * @param string $bandwidth Bandwidth as string ("SUB", "LF", "MF", "HF", "FR")
     * @return string $attack_time
     */
    public static function getPeakAttackTime ($bandwidth) {
        $peak_attack_time = '';

        $lim_peak_attacks = array(
            "SUB" => "16-32",
            "LF" => "8-16",
            "MF" => "2-8",
            "FR" => "2-8",
            "HF" => "0.5-2",
        );
        
        if (array_key_exists($bandwidth, $lim_peak_attacks)) {
            $peak_attack_time = $lim_peak_attacks[$bandwidth];
        }

        return $peak_attack_time;
    }

    /**
     * Scaling RMS Limiter Correction
     *
     * @param string $bandwidth Bandwidth as string ("SUB", "LF", "MF", "HF", "FR")
     * @return string $rms_limit_correction
     */
    public static function getRMSScaling ($bandwidth) {
        $rms_limit_correction = '';

        $rms_scaling = array(
            'SUB' => 0.7,
            'LF' =>	0.65,
            'MF' => 0.6,
            'HF' => 0.55,
            'FR' => 0.6,
        );
        
        if (array_key_exists($bandwidth, $rms_scaling)) {
            $rms_limit_correction = $rms_scaling[$bandwidth];
        }

        return $rms_limit_correction;
    }

    /**
     * Returns Closest Matching Impedance
     *
     * @param float $request_impedance
     * @return int $matching_impedance
     */
    public static function getImpedanceMatch ($request_impedance) {
        if ($request_impedance < 2) {
            $matching_impedance = 0;
        }
        
        if ( ($request_impedance >= 2) && !($request_impedance >= 3) ) {
            $matching_impedance = 2;
        }
        
        if ( ($request_impedance >= 3) && !($request_impedance >= 6) ) {
            $matching_impedance = 4;
        }
        
        if ( ($request_impedance >= 6) && !($request_impedance >= 12) ) {
            $matching_impedance = 8;
        }
        
        if ( ($request_impedance >= 12) && !($request_impedance >= 17) ) {
            $matching_impedance = 16;
        }

        return $matching_impedance;
    }

    /**
     * Returns Volts (Vrms, Vpeak)
     *
     * @param int $power
     * @param int $impedance
     * @return float $volts
     */
    public static function getVolts ($power, $impedance) {
        $volts = SQRT($power * $impedance);
        return $volts;
    }

    /**
     * Returns Current (Vrms, Vpeak)
     *
     * @param int $power
     * @param int $impedance
     * @return float $current
     */
    public static function getCurrent ($power, $impedance) {
        $current = SQRT($power / $impedance);
        return $current;
    }

    /**
     * Convert Volts to dBu
     *
     * @param float $volts
     * @return float $dBu
     */
    public static function todBu ($volts) {
        $dBu = 20 * log10( $volts / 0.775);
        return $dBu;
    }

    /**
     * Convert dBu to Volts
     *
     * @param float $volts
     * @return float $dBu
     */
    public static function toVolts ($dBu) {
        $volts = 0.775 * pow( 10, ( $dBu / 20 ) );
        return $volts;
    }

    /**
     * Returns the Vgain in dBu
     *
     * @param float $amp_vrms
     * @param float $sensitivity
     * @return float $vgain
     */
    public static function getVgain ($amp_vrms, $sensitivity) {
        $vgain = Limiter_Functions::todBu($amp_vrms) - Limiter_Functions::todBu($sensitivity);
        return $vgain;
    }

    /**
     * Returns the Limiter value in dBu
     *
     * @param float $amplifier_volts_dBu
     * @param float $vgain
     * @param int $offset
     * @return float $limiter value in dBu
     */
    public static function getLimiter ($volts, $vgain, $offset) {
        $limiter = Limiter_Functions::todBu($volts) - $vgain - $offset;
        return $limiter;
    }

    /**
     * Returns the Amplifier Output in Watts
     *
     * @param array $amplifier
     * @param int $impedance
     * @param bool $bridge_mode
     * @return int $power
     */
    public static function getAmplifierOutput($amplifier, $impedance, $bridge_mode) {
        if ($bridge_mode == 'true') {
            $power = $amplifier["amp_power_bridge_" . $impedance];

        } else {
            $power = $amplifier["amp_power_" . $impedance];
        }

        return $power;
    }
}