<?php // api/get/processor.php

if (!($_SERVER['REQUEST_METHOD'] === "POST")) {
    //echo "wrong request method";
    http_response_code(403);
    echo json_encode(array('error' => 'Unauthorized'));
}

$request_data = json_decode(file_get_contents('php://input'));
if (!(isset($request_data->http_user_token)) || !($request_data->http_user_token === $_SESSION["HTTP_USER_TOKEN"])) {
    //echo "wrong user token method";
    http_response_code(403);
    return json_encode(array('error' => 'Unauthorized'));
}

// Processor Data
$processor_id = $request_data->processor_id;
$processor = Functions::Processors()->get($processor_id);
$processor_offset = $processor["proc_offset"]; // processor_offsets

// Speaker Data
$speaker_id = $request_data->speaker_id;
$speaker = Functions::Speakers()->get($speaker_id);
$speaker_power_peak = $speaker["power_peak"]; // speaker_power_peak
$speaker_power_program = $speaker["power_program"]; // speaker_power_program
$speaker_power_rms = $speaker["power_rms"]; // speaker_power_rms
$speaker_impedance = $speaker["impedance"]; // speaker_impedance
$speaker_bandwidth = $speaker["bandwidth"]; // speaker_bandwidth

// Amplifier Data
$amplifier_id = $request_data->amplifier_id;
$amplifier = Functions::Amplifiers()->get($amplifier_id);

$bridge_mode_enabled = $request_data->bridge_mode;
$speakers_in_parallel = $request_data->speakers_in_parallel;
// $scaling = $request_data->scaling;
$input_sens = $request_data->input_sensitivity;

// ----------------------------------------------------------------
require_once ABSPATH . 'app/api/calc/func_limitier.php';

$impedance_request = $speaker_impedance / $speakers_in_parallel;
$impedance_match = Limiter_Functions::getImpedanceMatch($impedance_request);

$peak_power_request = $speaker_power_program * $speakers_in_parallel;
$rms_power_request = $speaker_power_rms * $speakers_in_parallel;

$amp_power = Limiter_Functions::getAmplifierOutput($amplifier, $impedance_match, $bridge_mode_enabled);
$amp_vrms = Limiter_Functions::getVolts($amp_power, $impedance_match);

$vgain = Limiter_Functions::getVgain($amp_vrms, $input_sens);

$vpeak = Limiter_Functions::getVolts($peak_power_request, $impedance_request);
$vrms = Limiter_Functions::getVolts($rms_power_request, $impedance_request);

$vpeak_value = Limiter_Functions::getLimiter($vpeak, $vgain, $processor_offset);
$vrms_value = Limiter_Functions::getLimiter($vrms, $vgain, $processor_offset);

// ----------------------------------------------------------------
$return_data = array(
    'apr_power_peak' => round($peak_power_request, 2),
    'apr_power_rms' => round($rms_power_request, 2),
    'apr_impedance' => round($impedance_request, 2),
    // 'apr_vpeak' => round($apr_vpeak, 2),
    // 'apr_vrms' => round($apr_vrms, 2),
    // 'apr_apeak' => round($apr_apeak, 2),
    // 'apr_arms' => round($apr_arms, 2),
    // 'lim_factor_peak' => $lim_factor_peak,
    // 'lim_factor_rms' => $lim_factor_rms,
    'lim_vpeak' => round($vpeak, 2),
    'lim_vrms' => round($vrms, 2),
    'lim_peak_value' => round($vpeak_value, 2),
    'lim_rms_value' => round($vrms_value, 2),
    // 'lim_peak_attack' => $lim_peak_attack,
    // 'lim_peak_release' => $lim_peak_release,
    // 'lim_rms_attack' => $lim_rms_attack,
    // 'lim_rms_release' => $lim_rms_release,
    // 'message' => $message,
);

header('Content-Type: json');
echo json_encode($return_data);


// Function One Calculations
// inputs
// $power = 100;
// $impedance = 8;
// $peak = 3;
// $vgain = 32;
// output
// $rms_lim = -0.8; // dBu
// $rms_lim = 28.28; // Volt
// $peak_lim = 2.2; // dBu
// $peak_lim = 39.95; // Volt

// Novacoustic
// $power = 100;
// $impedance = 8;
// $vgain = 32;
// $lim = -0.8;

// Brighton Sound TruePower
// $peak_power = 200;
// $rms_power = 100;
// $mode = 'TruePower';
// $peak_lim = 40; // Volts
// $rms_lim = 33; // Watts

// Brighton Sound Power vs Voltage
// $peak_power = 200;
// $rms_power = 100;
// $mode = 'Power vs. Voltage';
// $peak_lim = 40; // Volts
// $rms_lim = 100; // Watts

// Brighton Sound Power vs Current
// $peak_power = 200;
// $rms_power = 100;
// $mode = 'Power vs. Voltage';
// $peak_lim = 56; // Volts
// $rms_lim = 100; // Watts


// Cryshell Audio
// $rms_power = 100;
// $impedance = 8;
// $sens = 0.775;
// $power = $rms_power * 2;
// $vgain = 32; //dB
// $processor_offset = 22;
// $volts = sqrt($power * $impedance);
// $dBu = 20 * log($volts / $sens);
// $lim = $dBu - $vgain;
// $lim_offset = $lim - $processor_offset;

// Linea Research
// $

// Powersoft