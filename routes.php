<?php // routes.php

require_once __DIR__ . '../datbase/inc_loader.php';

if ($loader == false) {
  exit;
}

require_once __DIR__.'/router.php';
require_once __DIR__.'/app/modules/modules.php';

// DEFINE ROUTES

get('/', function () { Modules::Views()->Index(); });