<?php // inc_loader.php

$loader = false;

require_once ABSPATH . 'database/db_config.php';

if (DB_CONFIG == true) {
    require_once ABSPATH . 'database/database.php';
    $database = new Database();

    if (!isset($database)) {
        exit();
    }

    $loader = true;
}