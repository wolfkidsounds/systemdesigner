<link rel="stylesheet" href="includes/assets/css/dashboard.css">
<?php //dashboard.php


// session_start();
// require_once ABSPATH . "/app/functions.php";
// if (!Functions::CheckUserLoggedIn()) {
//     header("Location: /");
//     exit();
// }

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);


Partials::Close();