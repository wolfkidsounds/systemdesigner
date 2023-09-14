<link rel="stylesheet" href="includes/assets/css/login.css">
<?php //login.php

session_start();
require_once ABSPATH . "/app/functions.php";
if (Functions::CheckUserLoggedIn()) {
    header("Location: /app/dashboard");
    exit();
}

require_once __DIR__ . "/partials/inc_partials.php";
Partials::Open();
Partials::Header(false, false);
Partials::Close();