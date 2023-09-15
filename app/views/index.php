<?php // index.php

require_once ABSPATH . "/app/functions.php";
if (Functions::checkLogin()) {
    header("Location: /app/dashboard");
    exit();
}

header("Location: /login");