<?php // index.php

session_start();
require_once ABSPATH . "/app/functions.php";
if (Functions::CheckUserLoggedIn()) {
    header("Location: /app/dashboard");    
}

header("Location: /login");