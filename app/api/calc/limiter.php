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
$scaling = $request_data->scaling;
$bridge_mode_enabled = $request_data->bridge_mode;

// get all the databse information
$processor = Functions::Processors()->get($processor_id);
$amplifier = Functions::Amplifiers()->get($amplifier_id);
$speaker = Functions::Speakers()->get($speaker_id);

$speaker_bandwidth = $speaker["bandwidth"];
$processor_offset = $processor["proc_offset"];

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

$peak_release_times = array(
    "SUB" => "128-384",
    "LF" => "64-256",
    "MF" => "16-64",
    "FR" => "16-64",
    "HF" => "8-32",
);
$peak_release_time = '';
if (array_key_exists($speaker_bandwidth, $peak_release_times)) {
    $peak_release_time = $peak_release_times[$speaker_bandwidth];
}

$peak_attack_times = array(
    "SUB" => "16-32",
    "LF" => "8-16",
    "MF" => "2-8",
    "FR" => "2-8",
    "HF" => "0.5-2",
);
$peak_attack_time = '';
if (array_key_exists($speaker_bandwidth, $peak_attack_times)) {
    $peak_attack_time = $peak_attack_times[$speaker_bandwidth];
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

// get speaker information
// speaker.impedance
// speaker.impedance / speaker_amount_parallel (8/1 = 8) -> $impedance_requested
// $impedance_requested = speaker.impedance / speaker_amount_parallel
// $speaker_requested_power = speaker.power * speaker_amount_parallel

// get amplifier information
// $amplifier_impedance = round($impedance_requested);
// $amplifier_power = amplifer.power_impedance

// compare $amplifier_power with $speaker_request_power
// if speaker request power is larger than amplifier power -> Amplifier is limiting factor. Calculate Limiter values for Amplifier.
// if speaker request power is smaller than Amplifier power -> Speaker is limiting factor. Calculate Limiter values for Speaker

// limiter value = $dbu - $vgain - $processor_offset
// limiter value =( 20 * LOG10( SQRT( $power * $impedance) / 0,775 ) - $vgain ) - $processor_offset
// $power -> Database
// $impedance -> Database
// $processor_offset -> Database
// $vrms = SQRT( $power * $impedance )
// $dbu = 20 * LOG10( $vrms / 0,775 )
// $vgain = ( $vrms ) - ( 20 * LOG10( $input_sensitivity / 0,775 ) )
// $vpeak = SQRT( 2 ) * $vrms

if ($bridge_mode_enabled) {
    $bridge_mode = true;

} else {
    $bridge_mode = false;
}

$vgain_correction = ''; //value comes from the form

$impedance = ( Config!B10 / Output!B3 );

$peak_power = ( Output!B3 * Output!B4 * Config!B7 * ( Output!B6 / 100 ) * 100 );
$peak_voltage = ( SQRT( $peak_power * $impedance ) );

$lim_clip_volts = ( IF( AND( $peak_voltage > 0; $peak_voltage < > 0 ); $peak_voltage * 1,05 / CALC!B5; "Missing MaxOutVoltage" ) );
$lim_peak_volts = ( IF( AND( Config!E18 > 0; Config!E18 < > 0 ); MIN( 0,8 *SQRT( $peak_power * $impedance ) / CALC!B5; Config!E18 ); "Missing MaxOutVoltage" ) );
$lim_rms_volts = ( SQRT( Output!H6 * $impedance ) / CALC!B5 * CALC!E1 );

$input_sensitivity = $request_data->input_sensitivity; // this is 0.775 as default
$input_level = ( 20 * LOG10( $input_sensitivity / 0,775 ) ); // this is in dBu
$vgain = 20 * LOG10( SQRT( $power_request * $impedance ) / 0,775 ) - $input_level; // this is in dBu

$lim_clip_value = ( 20 * LOG10( $lim_clip_volts / 0,775 ) - $vgain - $processor_offset ); 
$lim_peak_value = ( 20 * LOG10( $lim_peak_volts / 0,775 ) - $vgain - $processor_offset );
$lim_rms_value = ( 20 * LOG10( $lim_rms_volts / 0,775 ) - $vgain - $processor_offset );

$return_data = array(
    'apr_single' => '',
    'apr_bridge' => '',
    'lup_single' => '',
    'lup_bridge' => '',
    'lup_headroom_single' => '',
    'lup_headroom_bridge' => '',
    'apr_power_peak' => '',
    'apr_power_program' => '',
    'apr_power_rms' => '',
    'apr_impedance' => '',
    'apr_vpeak' => '',
    'apr_vrms' => '',
    'apr_apeak' => '',
    'apr_arms' => '',
    'lim_clip_v' => $lim_clip_volts,
    'lim_clip_value' => $lim_clip_value,
    'lim_peak_v' => $lim_peak_volts,
    'lim_peak_value' => $lim_peak_value,
    'lim_peak_attack' => $peak_attack_time,
    'lim_peak_release' => $peak_release_time,
    'lim_rms_v' => $lim_rms_volts,
    'lim_rms_value' => $lim_rms_value,
    'lim_rms_attack' => $lim_rms_attack,
    'lim_rms_release' => $lim_rms_release,
);


header('Content-Type: json');
echo json_encode($return_data);
