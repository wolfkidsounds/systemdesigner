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

$processor_id = $request_data->processor_id;
$processor = Functions::Processors()->get($processor_id);

$processor_data = array();

foreach ($processor as $key => $value) {
    $processor_data[$key] = $value;
}

header('Content-Type: json');
echo json_encode($processor_data);

// Example Response
//{
//     "id":11,
//     "user_id":1,
//     "brand_id":31,
//     "name":"DS 2\/4",
//     "ch_inputs":"2",
//     "ch_outputs":"4",
//     "proc_offset":"0",
//     "date_created":null,
//     "date_edited":null,
//     "file_attachment":null
// }