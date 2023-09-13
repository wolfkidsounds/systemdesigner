<?php // routes.php

require_once __DIR__ . '/app_config.php';
require_once ABSPATH . 'includes/inc_loader.php';

if ($loader == false) {
  exit;
}

require_once __DIR__ . '/router.php';
require_once ABSPATH . 'app/modules/modules.php';

// DEFINE ROUTES
get('/', function () { Modules::Views()->Index(); });

get('/login', function () { Modules::Views()->Login(); });
get('/logout', function () { Modules::Views()->Logout(); });

get('/app/dashboard', function () { Modules::Views()->App_Dashboard(); });