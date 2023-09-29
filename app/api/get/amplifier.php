<?php // api/get/amplifier.php

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

$amplifier_id = $request_data->amplifier_id;
$amplifier = Functions::Amplifiers()->get($amplifier_id);

$amplifier_data = array();

foreach ($amplifier as $key => $value) {
    $amplifier_data[$key] = $value;
}

header('Content-Type: json');
echo json_encode($amplifier_data);

// Example Response
// {
//     "id":6,
//     "user_id":1,
//     "brand_id":5,
//     "name":"Quadro 500 DSP",
//     "rack_units":"1",
//     "ch_outputs":"4",
//     "amp_power_16":"0",
//     "amp_vpeak_16":"0",
//     "amp_vgain_16":"0",
//     "amp_power_8":"250",
//     "amp_vpeak_8":"44.72",
//     "amp_vgain_8":"33.01",
//     "amp_power_4":"500",
//     "amp_vpeak_4":"44.72",
//     "amp_vgain_4":"33.01",
//     "amp_power_2":"0",
//     "amp_vpeak_2":"0",
//     "amp_vgain_2":"0",
//     "amp_power_bridge_8":"500",
//     "amp_vpeak_bridge_8":"63.25",
//     "amp_vgain_bridge_8":"36.02",
//     "amp_power_bridge_4":"1000",
//     "amp_vpeak_bridge_4":"63.25",
//     "amp_vgain_bridge_4":"36.02",
//     "date_created":"2023-09-16 20:15:39",
//     "file_attachment":"the t.amp_-_Quadro 500 DSP.pdf",
//     "date_edited":"2023-09-21 16:04:35"
// }