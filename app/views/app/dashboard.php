<?php // login.php

session_start();
require_once ABSPATH . "/app/functions.php";
if (!Functions::CheckUserLoggedIn()) {
    header("Location: /");
    exit();
}

require_once __DIR__ . "/partials/inc_partials.php";
Partials::Open();
Partials::Header(false, false);
Partials::Close();