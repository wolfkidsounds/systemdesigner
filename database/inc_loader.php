<?php // inc_loader.php

$loader = false;

if (DB_CONFIG == true) {
    require_once __DIR__ . '/database.php';
    $database = new Database();

    if (!isset($database)) {
        exit();
    }

    $loader = true;
}