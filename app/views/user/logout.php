<link rel="stylesheet" href="includes/assets/css/dashboard.css">
<?php //dashboard.php

require_once ABSPATH . "/app/functions.php";
if (!Functions::checkLogin()) {
    header("Location: /login");
    exit();
}

Functions::logoutUser();