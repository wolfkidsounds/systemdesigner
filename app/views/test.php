<?php // api/get/processor.php

// Processor Data
$processor_id = 19;
$processor = Functions::Processors()->get($processor_id);
$processor_offset = $processor["proc_offset"]; // processor_offsets

// Speaker Data
$speaker_id = 7;
$speaker = Functions::Speakers()->get($speaker_id);
$speaker_power_peak = $speaker["power_peak"]; // speaker_power_peak
$speaker_power_program = $speaker["power_program"]; // speaker_power_program
$speaker_power_rms = $speaker["power_rms"]; // speaker_power_rms
$speaker_impedance = $speaker["impedance"]; // speaker_impedance
$speaker_bandwidth = $speaker["bandwidth"]; // speaker_bandwidth

// Amplifier Data
$amplifier_id = 29;
$amplifier = Functions::Amplifiers()->get($amplifier_id);

$bridge_mode_enabled = filter_var("false", FILTER_VALIDATE_BOOLEAN);
$speakers_in_parallel = "1";
$scaling = "75";
$input_sensitivity = "0.775";

// ----------------------------------------------------------------
require_once ABSPATH . 'app/api/calc/func_limitier.php';

$lim_rms_attack = Limiter_Functions::getRMSAttackTime($speaker_bandwidth);
$lim_rms_release = Limiter_Functions::getRMSReleaseTime($speaker_bandwidth);
$lim_peak_attack = Limiter_Functions::getPeakAttackTime($speaker_bandwidth);
$lim_peak_release = Limiter_Functions::getPeakReleaseTime($speaker_bandwidth);

$impedance_request = Limiter_Functions::getRequestImpedance($speaker_impedance, $speakers_in_parallel);
$impedance_match = Limiter_Functions::getImpedanceMatch($impedance_request);

$amp_output_power = Limiter_Functions::getAmplifierOutput($amplifier, $impedance_match, $bridge_mode_enabled);
$amp_vrms = Limiter_Functions::getVolts($amp_output_power, $impedance_match);
$amp_vpeak = SQRT( 2 ) * $amp_vrms;

$amp_vrms_dBu = Limiter_Functions::getdBu($amp_vrms);
$input_sens_dBu = Limiter_Functions::getdBu($input_sensitivity);
$amp_vgain = Limiter_Functions::getVgain($amp_vrms_dBu, $input_sens_dBu);

$peak_power_request = Limiter_Functions::getPowerRequest($speaker_power_peak, $speakers_in_parallel);

if ($amp_output_power > $peak_power_request) {
    // speaker must be protected
    $lim_vpeak = Limiter_Functions::getVolts($peak_power_request, $impedance_request);
}

if ($amp_output_power < $peak_power_request) {
    // amplifier must be protected
    $lim_vpeak = Limiter_Functions::getVolts($amp_output_power, $impedance_request);
}

$lim_vpeak = $lim_vpeak * ($scaling / 100);
$lim_peak_value = Limiter_Functions::getLimiter($lim_vpeak, $vgain, $processor_offset);


$rms_power_request = Limiter_Functions::getPowerRequest($speaker_power_rms, $speakers_in_parallel);

if ($amp_output_power > $rms_power_request) {
    // speaker must be protected
    $lim_vrms = Limiter_Functions::getVolts($rms_power_request, $impedance_request);
}

if ($amp_output_power < $rms_power_request) {
    // amplifier must be protected
    $lim_vrms = Limiter_Functions::getVolts($amp_output_power, $impedance_request);
}

$lim_vrms = $lim_vrms * ($scaling / 100);
$lim_rms_value = Limiter_Functions::getLimiter($lim_vrms, $vgain, $processor_offset);