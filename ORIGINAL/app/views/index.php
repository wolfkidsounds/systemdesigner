<?php // index.php

require_once ABSPATH . "app/functions/functions.php";
if (Functions::Users()->checkLogin()) {
    header("Location: /app/dashboard");
    exit();
}

header("Location: /login");