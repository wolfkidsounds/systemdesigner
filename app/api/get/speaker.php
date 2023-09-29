<?php // api/get/speaker.php

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

$speaker_id = $request_data->speaker_id;
$speaker = Functions::Speakers()->get($speaker_id);

$speaker_data = array();

foreach ($speaker as $key => $value) {
    $speaker_data[$key] = $value;
}

header('Content-Type: json');
echo json_encode($speaker_data);

// Example Response
// {
//     "id":4,
//     "user_id":1,
//     "brand_id":14,
//     "name":"1331",
//     "power_rms":"500",
//     "power_program":"1000",
//     "power_peak":"2000",
//     "impedance":"8",
//     "vpeak":"89.44",
//     "vrms":"63.25",
//     "sensitivity":"105",
//     "max_spl":"131.99",
//     "date_created":null,
//     "date_edited":null,
//     "bandwidth":"FR"
// }