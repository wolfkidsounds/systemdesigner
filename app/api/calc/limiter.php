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

// Get the variables from the request
$processor_id = $request_data->processor_id;
$amplifier_id = $request_data->amplifier_id;
$speaker_id = $request_data->speaker_id;
$bridge_mode_enabled = $request_data->bridge_mode;

// get all the databse information
$processor = Functions::Processors()->get($processor_id);
$amplifier = Functions::Amplifiers()->get($amplifier_id);
$speaker = Functions::Speakers()->get($speaker_id);

// CONFIG INFORMATION

// Speaker Data
$speaker_power_peak = $speaker["power_peak"]; // speaker_power_peak
$speaker_power_program = $speaker["power_program"]; // speaker_power_program
$speaker_power_rms = $speaker["power_rms"]; // speaker_power_rms
$speaker_impedance = $speaker["impedance"]; // speaker_impedance
$speaker_max_spl = $speaker["max_spl"]; // speaker_max_spl
$speaker_spl = $speaker["sensitivity"]; // speaker_spl

// Amplifier Data
$amplifier_height = $amplifier["rack_units"]; // amplifier_height
$amplifier_outputs = $amplifier["ch_outputs"]; // amplifier_outputs

$amplifier_power_16 = $amplifier["amp_power_16"]; // amplifier_power_16
$amplifier_power_8 = $amplifier["amp_power_8"]; // amplifier_power_8
$amplifier_power_4 = $amplifier["amp_power_4"]; // amplifier_power_4
$amplifier_power_2 = $amplifier["amp_power_2"]; // amplifier_power_2
$amplifier_power_bridge_8 = $amplifier["amp_power_bridge_8"]; // amplifier_power_bridge_8
$amplifier_power_bridge_4 = $amplifier["amp_power_bridge_4"]; // amplifier_power_bridge_4

// Processor Data
$processor_inputs = $processor["ch_inputs"]; // processor_inputs
$processor_outputs = $processor["ch_outputs"]; // processor_outputs
$processor_offset = $processor["proc_offset"]; // processor_offsets

// SETTINGS & SETUP FOR CALCUALTIONS

$setup_speakers_parallel = $request_data->speakers_in_parallel; // setup_speakers_parallel
$setup_speakers_series = 1; // setup_speakers_series
$speaker_bandwidth = $speaker["bandwidth"]; // speaker_bandwidth
$setup_scaling = $request_data->scaling; // setup_scaling
$setup_bridge_mode = $request_data->bridge_mode; // setup_bridge_mode


// ----------------------------------------------------------------

$lim_rms_releases = array(
    "SUB" => "4000-8000",
    "LF" => "2000-4000",
    "MF" => "500-2000",
    "FR" => "500-2000",
    "HF" => "300-800",
);
$lim_rms_release = '';
if (array_key_exists($speaker_bandwidth, $lim_rms_releases)) {
    $lim_rms_release = $lim_rms_releases[$speaker_bandwidth];
}

$lim_rms_attacks = array(
    "SUB" => "2000-4000",
    "LF" => "1000-2000",
    "MF" => "300-800",
    "FR" => "300-800",
    "HF" => "150-300",
);
$lim_rms_attack = '';
if (array_key_exists($speaker_bandwidth, $lim_rms_attacks)) {
    $lim_rms_attack = $lim_rms_attacks[$speaker_bandwidth];
}

$lim_peak_releases = array(
    "SUB" => "128-384",
    "LF" => "64-256",
    "MF" => "16-64",
    "FR" => "16-64",
    "HF" => "8-32",
);
$peak_release_time = '';
if (array_key_exists($speaker_bandwidth, $lim_peak_releases)) {
    $peak_release_time = $lim_peak_releases[$speaker_bandwidth];
}

$lim_peak_attacks = array(
    "SUB" => "16-32",
    "LF" => "8-16",
    "MF" => "2-8",
    "FR" => "2-8",
    "HF" => "0.5-2",
);
$peak_attack_time = '';
if (array_key_exists($speaker_bandwidth, $lim_peak_attacks)) {
    $peak_attack_time = $lim_peak_attacks[$speaker_bandwidth];
}

$rms_scaling = array(
    'SUB' => 0.7,
    'LF' =>	0.65,
    'MF' => 0.6,
    'HF' => 0.55,
    'FR' => 0.6,
);
$rms_limit_correction = '';
if (array_key_exists($speaker_bandwidth, $rms_scaling)) {
    $rms_limit_correction = $rms_scaling[$speaker_bandwidth];
}

// Select the right impedance
// $speaker_impedance from database
$calc_impedance = $speaker_impedance / $setup_speakers_parallel; // calculated impedance
$closest_impedance = getClosestImpedance($calc_impedance);

// 1 * 400W * (75/100) = 300W;
$calc_peak_power = $setup_speakers_parallel * $speaker_power_peak * ( $setup_scaling / 100 ); // calc_peak_power
$power_request_peak = $calc_peak_power;

// 1 * 200W * (75/100) = 150W;
$calc_program_power = $setup_speakers_parallel * $speaker_power_program * ($setup_scaling / 100 ); // calc_program_power
$power_request_program = $calc_program_power;

// 1 * 100W * (75/100) = 75W;
$calc_rms_power = $setup_speakers_parallel * $speaker_power_rms * ($setup_scaling / 100);
$power_request_rms = $calc_rms_power;

$actual_power_request = getActualPower($calc_peak_power, $closest_impedance, $calc_impedance);
$amplifier_output_peak_single = getAmplifierOutput($amplifier, $closest_impedance);
$amplifier_peak_power_request_single = ( $actual_power_request / $amplifier_output_peak_single ) * 100;

$amplifier_output_peak_bridge = getAmplifierOutputBridge($amplifier, $closest_impedance);
$amplifier_peak_power_request_bridge = ( $actual_power_request / $amplifier_output_peak_bridge ) * 100;

$loudspeaker_usage_potential_single = min(100, 100 / $amplifier_peak_power_request_single) * 100;
$loudspeaker_usage_potential_headroom_single = (-10 * log10($amplifier_peak_power_request_single / 100));

$loudspeaker_usage_potential_bridge = min(100, 100 / $amplifier_peak_power_request_bridge) * 100;
$loudspeaker_usage_potential_headroom_bridge = -10 * log10($amplifier_peak_power_request_bridge / 100);

$calc_Vpeak = sqrt( $calc_peak_power * $calc_impedance ); // calc_Vpeak
$calc_Vrms = sqrt( $calc_rms_power * $calc_impedance); // calc_Vrms
$calc_Apeak = SQRT( $calc_peak_power / $calc_impedance ); // calc_Apeak
$calc_Arms = SQRT( $calc_rms_power / $calc_impedance); // calc_Arms

$limiting_factor = defineLimitingFactor( $amplifier_output_peak_single, $actual_power_request );



if ($bridge_mode_enabled) {
    $lim_clip_Vclip = $calc_Vpeak * 1.05 / 1; // clip voltage

    $max_output_voltage = sqrt($amplifier_output_peak_bridge * $closest_impedance);
    $lim_peak_Vpeak = sqrt($power_request_peak * $calc_impedance) / 1; // peak voltage

    $lim_rms_Vrms = sqrt( $power_request_rms * $calc_impedance ) / 1 * $rms_limit_correction; // rms voltage

    $bridge_mode_enabled_2 = 0;
} else {
    $lim_clip_Vclip = $calc_Vpeak * 1.05 / 2; // clip voltage

    $max_output_voltage = sqrt($amplifier_output_peak_single * $closest_impedance);
    $lim_peak_Vpeak = sqrt($power_request_peak * $calc_impedance) / 2; // peak voltage

    $lim_rms_Vrms = sqrt( $power_request_rms * $calc_impedance ) / 2 * $rms_limit_correction; // rms voltage

    $bridge_mode_enabled_2 = 1;
}

$input_sens = $request_data->input_sensitivity;

$lim_clip_value = calculateLimiter($power_request_peak, $calc_impedance, $input_sens, $processor_offset);
$lim_peak_value = calculateLimiter($power_request_program, $calc_impedance, $input_sens, $processor_offset);
$lim_rms_value = calculateLimiter($power_request_rms, $calc_impedance, $input_sens, $processor_offset);


// Zuweisung
$apr_single = $amplifier_peak_power_request_single;
$apr_bridge = $amplifier_peak_power_request_bridge;
$lup_single = $loudspeaker_usage_potential_single;
$lup_bridge = $loudspeaker_usage_potential_bridge;
$lup_headroom_single = $loudspeaker_usage_potential_headroom_single;
$lup_headroom_bridge = $loudspeaker_usage_potential_headroom_bridge;
$apr_power_peak = $power_request_peak;
$apr_power_program = $power_request_program;
$apr_power_rms = $power_request_rms;
$apr_impedance = $calc_impedance;
$apr_vpeak = $calc_Vpeak;
$apr_vrms = $calc_Vrms;
$apr_apeak = $calc_Apeak;
$apr_arms = $calc_Arms;
$lim_clip_volts = $lim_clip_Vclip;
$lim_peak_volts = $lim_peak_Vpeak;
$lim_rms_volts = $lim_rms_Vrms;


// Functions
function getClosestImpedance ($calc_impedance) {
    if ($calc_impedance < 2) {
        $closest_impedance = 0;
    }
    
    if ( ($calc_impedance >= 2) && !($calc_impedance >= 3) ) {
        $closest_impedance = 2;
    }
    
    if ( ($calc_impedance >= 3) && !($calc_impedance >= 6) ) {
        $closest_impedance = 4;
    }
    
    if ( ($calc_impedance >= 6) && !($calc_impedance >= 12) ) {
        $closest_impedance = 8;
    }
    
    if ( ($calc_impedance >= 12) && !($calc_impedance >= 17) ) {
        $closest_impedance = 16;
    }

    return $closest_impedance;
}

function getAmplifierOutput($amplifier, $closest_impedance) {
    return $amplifier["amp_power_" . $closest_impedance];
}

function getAmplifierOutputBridge($amplifier, $closest_impedance) {
    return $amplifier["amp_power_bridge_" . $closest_impedance];
}

function getActualPower($peak_power, $closest_impedance, $real_impedance) {
    return $peak_power * $real_impedance / $closest_impedance / 2;
}

function calculateLimiter($power, $impedance, $sens, $offset) {
    $amplification_volts = SQRT( $power * $impedance);
    $amplification_dbu = 20 * LOG10( $amplification_volts / 0.775 );
    $input_sens_dbu = 20 * log10($sens / 0.775);
    $vgain = $amplification_dbu - $input_sens_dbu;
    $limiter_dbu = $amplification_dbu - $vgain;
    return $limiter = $limiter_dbu - $offset;
}

function defineLimitingFactor($amplifier_power, $speaker_power) {
    if ($amplifier_power >= $speaker_power) {
        $limiting_factor = "Speaker";
    } if ($speaker_power >= $amplifier_power) {
        $limiting_factor = "Amplifier";
    }
    return $limiting_factor;
}

// RETURN DATA
$return_data = array(
    'apr_single' => $apr_single,
    'apr_bridge' => $apr_bridge,
    'lup_single' => round($lup_single, 2),
    'lup_bridge' => round($lup_bridge, 2),
    'lup_headroom_single' => round($lup_headroom_single, 2),
    'lup_headroom_bridge' => round($lup_headroom_bridge, 2),
    'apr_power_peak' => round($apr_power_peak, 2),
    'apr_power_program' => round($apr_power_program, 2),
    'apr_power_rms' => round($apr_power_rms, 2),
    'apr_impedance' => round($apr_impedance, 2),
    'apr_vpeak' => round($apr_vpeak, 2),
    'apr_vrms' => round($apr_vrms, 2),
    'apr_apeak' => round($apr_apeak, 2),
    'apr_arms' => round($apr_arms, 2),
    'lim_clip_v' => round($lim_clip_volts, 2),
    'lim_clip_value' => round($lim_clip_value, 2),
    'lim_peak_v' => round($lim_peak_volts, 2),
    'lim_peak_value' => round($lim_peak_value, 2),
    'lim_peak_attack' => $peak_attack_time,
    'lim_peak_release' => $peak_release_time,
    'lim_rms_v' => round($lim_rms_volts, 2),
    'lim_rms_value' => round($lim_rms_value, 2),
    'lim_rms_attack' => $lim_rms_attack,
    'lim_rms_release' => $lim_rms_release,
    'limiting_factor' => $limiting_factor,
);


header('Content-Type: json');
echo json_encode($return_data);